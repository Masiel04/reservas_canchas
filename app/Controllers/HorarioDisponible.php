<?php

namespace App\Controllers;

use App\Models\HorarioDisponibleModel;
use App\Models\CanchaModel;

class HorarioDisponible extends BaseController
{
    protected $horarioModel;
    protected $canchaModel;

    public function __construct()
    {
        $this->horarioModel = new HorarioDisponibleModel();
        $this->canchaModel = new CanchaModel();
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
            'validation' => \Config\Services::validation()
        ];
        
        return view('horarios_disponibles/nuevo', $data);
    }

    public function guardar()
{
    // Reglas de validación básicas
    $rules = [
        'id_cancha' => 'required|numeric',
        'fecha' => 'required|valid_date',
        'hora_inicio' => 'required',
        'hora_fin' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Validación manual del formato de hora (HH:MM)
    if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $this->request->getPost('hora_inicio'))) {
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'Formato de hora inicial inválido (use HH:MM)');
    }

    if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $this->request->getPost('hora_fin'))) {
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'Formato de hora final inválido (use HH:MM)');
    }

    // Validación de que hora_fin > hora_inicio
    if (strtotime($this->request->getPost('hora_fin')) <= strtotime($this->request->getPost('hora_inicio'))) {
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'La hora final debe ser posterior a la hora inicial');
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
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'El horario se solapa con otro ya existente');
        }

        // Preparar datos para guardar
        $data = [
            'id_cancha' => $this->request->getPost('id_cancha'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'disponible' => $this->request->getPost('disponible') ? 1 : 0,
        ];

        // Intentar guardar
        if ($this->horarioModel->insert($data)) {
            return redirect()->to('/horario_disponible')
                           ->with('success', 'Horario creado exitosamente');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al guardar el horario');
        }
    }

    public function editar($id)
    {
        $horario = $this->horarioModel->find($id);
        
        if (!$horario) {
            return redirect()->to('/horario_disponible')
                           ->with('error', 'Horario no encontrado');
        }

        $data = [
            'horario' => $horario,
            'canchas' => $this->canchaModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('horarios_disponibles/editar', $data);
    }

    public function actualizar($id)
    {
        // Reglas de validación
        $rules = [
            'id_cancha' => 'required|numeric',
            'fecha' => 'required|valid_date',
            'hora_inicio' => 'required|valid_time',
            'hora_fin' => 'required|valid_time'
        ];

        // Validación básica
        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Validación manual de horas
        $horaInicio = strtotime($this->request->getPost('hora_inicio'));
        $horaFin = strtotime($this->request->getPost('hora_fin'));
        
        if ($horaFin <= $horaInicio) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'La hora de fin debe ser posterior a la hora de inicio');
        }

        // Verificar solapamiento excluyendo el actual
        $existeHorario = $this->horarioModel->where('id_cancha', $this->request->getPost('id_cancha'))
                                          ->where('fecha', $this->request->getPost('fecha'))
                                          ->where('id_horario !=', $id)
                                          ->groupStart()
                                              ->where('hora_inicio <=', $this->request->getPost('hora_fin'))
                                              ->where('hora_fin >=', $this->request->getPost('hora_inicio'))
                                          ->groupEnd()
                                          ->first();

        if ($existeHorario) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'El horario se solapa con otro ya existente');
        }

        // Preparar datos para actualizar
        $data = [
            'id_cancha' => $this->request->getPost('id_cancha'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'disponible' => $this->request->getPost('disponible') ? 1 : 0,
        ];

        // Actualizar registro
        if ($this->horarioModel->update($id, $data)) {
            return redirect()->to('/horario_disponible')
                           ->with('success', 'Horario actualizado exitosamente');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error al actualizar el horario');
        }
    }

    public function eliminar($id)
    {
        $horario = $this->horarioModel->find($id);
        
        if (!$horario) {
            return redirect()->to('/horario_disponible')
                           ->with('error', 'Horario no encontrado');
        }

        if ($this->horarioModel->delete($id)) {
            return redirect()->to('/horario_disponible')
                           ->with('success', 'Horario eliminado exitosamente');
        } else {
            return redirect()->to('/horario_disponible')
                           ->with('error', 'Error al eliminar el horario');
        }
    }

    public function verificar($id_horario)
    {
        $horario = $this->horarioModel->find($id_horario);
        
        if (!$horario || $horario['disponible'] == 0) {
            return $this->response->setJSON(['disponible' => false]);
        }
        
        return $this->response->setJSON(['disponible' => true]);
    }
}