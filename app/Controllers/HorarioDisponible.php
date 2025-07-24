<?php

namespace App\Controllers;

use App\Models\HorarioDisponibleModel;
use App\Models\CanchaModel;

class HorarioDisponible extends BaseController
{
    protected $horarioModel;
    protected $canchaModel;
    protected $validation;

    public function __construct()
    {
        $this->horarioModel = new HorarioDisponibleModel();
        $this->canchaModel = new CanchaModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $builder = $this->horarioModel->select('horarios_disponibles.*, canchas.nombre_cancha')
                                    ->join('canchas', 'canchas.id_cancha = horarios_disponibles.id_cancha');
        
        if (session('tipo') === 'cliente') {
            $builder->where('horarios_disponibles.disponible', 1);
        }

        $data = [
            'horarios' => $builder->orderBy('fecha', 'ASC')
                                 ->orderBy('hora_inicio', 'ASC')
                                 ->findAll(),
            'canchas' => $this->canchaModel->findAll()
        ];

        return view('horarios_disponibles/listado', $data);
    }

    public function nuevo()
    {
        $data = [
            'canchas' => $this->canchaModel->findAll(),
            'validation' => $this->validation
        ];
        
        return view('horarios_disponibles/nuevo', $data);
    }

    public function guardar()
    {
        // Reglas de validación
        $rules = [
            'id_cancha' => 'required|numeric',
            'fecha' => 'required|valid_date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|greater_than_field[hora_inicio]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Verificar solapamiento de horarios
        $existeHorario = $this->horarioModel->where('id_cancha', $this->request->getPost('id_cancha'))
                                          ->where('fecha', $this->request->getPost('fecha'))
                                          ->groupStart()
                                              ->where('hora_inicio <=', $this->request->getPost('hora_fin'))
                                              ->where('hora_fin >=', $this->request->getPost('hora_inicio'))
                                          ->groupEnd()
                                          ->first();

        if ($existeHorario) {
            return redirect()->back()->withInput()->with('error', 'El horario se solapa con otro ya existente');
        }

        $data = [
            'id_cancha' => $this->request->getPost('id_cancha'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'disponible' => $this->request->getPost('disponible') ? 1 : 0,
        ];

        $this->horarioModel->insert($data);

        return redirect()->to('/horario_disponible')->with('success', 'Horario creado exitosamente');
    }

    public function editar($id)
    {
        $horario = $this->horarioModel->find($id);
        
        if (!$horario) {
            return redirect()->to('/horario_disponible')->with('error', 'Horario no encontrado');
        }

        $data = [
            'horario' => $horario,
            'canchas' => $this->canchaModel->findAll(),
            'validation' => $this->validation
        ];

        return view('horarios_disponibles/editar', $data);
    }

    public function actualizar($id)
    {
        // Reglas de validación
        $rules = [
            'id_cancha' => 'required|numeric',
            'fecha' => 'required|valid_date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|greater_than_field[hora_inicio]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Verificar solapamiento de horarios (excluyendo el actual)
        $existeHorario = $this->horarioModel->where('id_cancha', $this->request->getPost('id_cancha'))
                                          ->where('fecha', $this->request->getPost('fecha'))
                                          ->where('id_horario !=', $id)
                                          ->groupStart()
                                              ->where('hora_inicio <=', $this->request->getPost('hora_fin'))
                                              ->where('hora_fin >=', $this->request->getPost('hora_inicio'))
                                          ->groupEnd()
                                          ->first();

        if ($existeHorario) {
            return redirect()->back()->withInput()->with('error', 'El horario se solapa con otro ya existente');
        }

        $data = [
            'id_cancha' => $this->request->getPost('id_cancha'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'disponible' => $this->request->getPost('disponible') ? 1 : 0,
        ];

        $this->horarioModel->update($id, $data);

        return redirect()->to('/horario_disponible')->with('success', 'Horario actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $horario = $this->horarioModel->find($id);
        
        if (!$horario) {
            return redirect()->to('/horario_disponible')->with('error', 'Horario no encontrado');
        }

        $this->horarioModel->delete($id);
        
        return redirect()->to('/horario_disponible')->with('success', 'Horario eliminado exitosamente');
    }

    // Método para API que verifica disponibilidad
    public function verificar($id_horario)
    {
        $horario = $this->horarioModel->find($id_horario);
        
        if (!$horario || $horario['disponible'] == 0) {
            return $this->response->setJSON(['disponible' => false]);
        }
        
        return $this->response->setJSON(['disponible' => true]);
    }
}