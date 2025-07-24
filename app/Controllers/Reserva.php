<?php

namespace App\Controllers;

use App\Models\ReservaModel;
use App\Models\UsuarioModel;
use App\Models\CanchaModel;
use App\Models\HorarioDisponibleModel;

class Reserva extends BaseController
{
    protected $reservaModel;
    protected $usuarioModel;
    protected $canchaModel;
    protected $horarioModel;
    protected $validation;

    public function __construct()
    {
        $this->reservaModel = new ReservaModel();
        $this->usuarioModel = new UsuarioModel();
        $this->canchaModel = new CanchaModel();
        $this->horarioModel = new HorarioDisponibleModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $session = session();
        
        if ($session->get('tipo') === 'admin') {
            $data['reservas'] = $this->reservaModel->getReservasConDetalles();
        } else {
            $idUsuario = $session->get('id_usuario');
            $data['reservas'] = $this->reservaModel->getReservasConDetallesPorUsuario($idUsuario);
        }
        
        return view('reserva/listado', $data);
    }

    public function nuevo()
    {
        $session = session();
        if (!$session->has('logueado')) {
            return redirect()->to('/login');
        }

        // Obtener solo las canchas activas
        $canchas = $this->canchaModel->where('estado', 1)->findAll();
        
        // Obtener el usuario actual
        $usuarioActual = $this->usuarioModel->find($session->get('id_usuario'));
        
        // Si es admin, cargar todos los usuarios, de lo contrario solo el actual
        $usuarios = [];
        if ($session->get('tipo') === 'admin') {
            $usuarios = $this->usuarioModel->findAll();
        } else {
            $usuarios = [$usuarioActual];
        }
        
        $data = [
            'horarios' => [], // Ya no cargamos todos los horarios aquí, se cargarán por AJAX
            'usuarios' => $usuarios,
            'canchas' => $canchas,
            'usuario_actual' => $usuarioActual,
            'validation' => $this->validation
        ];

        return view('reserva/nuevo', $data);
    }

    public function guardar()
    {
        $rules = [
            'id_horario' => 'required|numeric',
            'estado' => 'permit_empty|in_list[pagada,pagada,cancelada]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', $this->validation->getErrors())
                ->withInput();
        }

        $idHorario = $this->request->getPost('id_horario');
        $estado = $this->request->getPost('estado') ?? 'pendiente';

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Primero intentar actualizar directamente la disponibilidad
            $actualizados = $db->table('horarios_disponibles')
                ->where('id_horario', $idHorario)
                ->where('disponible', 1)  // Solo actualizar si está disponible
                ->set('disponible', 0)    // Lo marcamos como no disponible
                ->update();

            if ($actualizados === 0) {
                // Si no se actualizó ninguna fila, es porque ya no está disponible
                throw new \Exception('El horario seleccionado ya no está disponible.');
            }

            // Crear la reserva
            $this->reservaModel->insert([
                'id_usuario' => session('id_usuario'),
                'id_horario' => $idHorario,
                'fecha_reserva' => date('Y-m-d H:i:s'),
                'estado' => $estado,
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Error al procesar la reserva');
            }

            return redirect()->to('/reserva')
                ->with('success', 'Reserva realizada con éxito');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error en reserva: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function editar($id)
    {
        $reserva = $this->reservaModel->find($id);
        
        if (!$reserva) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Reserva no encontrada: $id");
        }

        $horario = $this->horarioModel->find($reserva['id_horario']);
        $reserva['cancha_id'] = $horario ? $horario['id_cancha'] : null;

        $data = [
            'reserva' => $reserva,
            'usuarios' => $this->usuarioModel->findAll(),
            'canchas' => $this->canchaModel->findAll(),
            'horarios' => $this->horarioModel->findAll(),
            'validation' => $this->validation
        ];

        return view('reserva/editar', $data);
    }

    public function actualizar($id)
    {
        $rules = [
            'id_usuario' => 'required|numeric',
            'id_horario' => 'required|numeric',
            'fecha_reserva' => 'required|valid_date',
            'estado' => 'required|in_list[pagada,pagada,cancelada]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', $this->validation->getErrors())
                ->withInput();
        }

        try {
            $this->reservaModel->update($id, [
                'id_usuario' => $this->request->getPost('id_usuario'),
                'id_horario' => $this->request->getPost('id_horario'),
                'fecha_reserva' => $this->request->getPost('fecha_reserva'),
                'estado' => $this->request->getPost('estado'),
            ]);

            return redirect()->to('/reserva')
                ->with('success', 'Reserva actualizada correctamente');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la reserva: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function eliminar($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $reserva = $this->reservaModel->find($id);
            
            if (!$reserva) {
                throw new \Exception('No se encontró la reserva');
            }

            // Actualizar el horario a disponible
            $this->horarioModel->update($reserva['id_horario'], ['disponible' => 1]);
            
            // Eliminar la reserva
            $this->reservaModel->delete($id);
            
            $db->transComplete();

            return redirect()->to('/reserva')
                ->with('success', 'Reserva eliminada correctamente');
            
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()
                ->with('error', 'Error al eliminar la reserva: ' . $e->getMessage());
        }
    }
    
    public function horariosPorCancha($idCancha)
    {
        $hoy = date('Y-m-d');
        $horaActual = date('H:i:s');
        
        // Obtener horarios disponibles para la cancha seleccionada
        $horarios = $this->horarioModel
            ->select('hd.id_horario, hd.id_cancha, hd.fecha, hd.hora_inicio, hd.hora_fin, c.nombre_cancha, c.tipo')
            ->from('horarios_disponibles hd')
            ->join('canchas c', 'c.id_cancha = hd.id_cancha')
            ->where('hd.disponible', 1)
            ->where('hd.id_cancha', $idCancha)
            ->groupStart()
                ->where('hd.fecha >', $hoy)  // Fechas futuras
                ->orGroupStart()
                    ->where('hd.fecha', $hoy)  // Hoy pero horas futuras
                    ->where('hd.hora_inicio >', $horaActual)
                ->groupEnd()
            ->groupEnd()
            ->orderBy('hd.fecha', 'ASC')
            ->orderBy('hd.hora_inicio', 'ASC')
            ->findAll();

        // Formatear los datos para la respuesta JSON
        $resultado = array_map(function($horario) {
            return [
                'id_horario' => $horario['id_horario'],
                'id_cancha' => $horario['id_cancha'],
                'fecha' => $horario['fecha'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
                'nombre_cancha' => $horario['nombre_cancha'],
                'tipo' => $horario['tipo']
            ];
        }, $horarios);

        return $this->response->setJSON($resultado);
    }
}