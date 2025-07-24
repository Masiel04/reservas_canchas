<?php

namespace App\Controllers;

use App\Models\CanchaModel;

class Cancha extends BaseController
{
    public function index()
    {
        $canchaModel = new CanchaModel();
        $data['canchas'] = $canchaModel->findAll();
        return view('canchas/listado', $data);
    }

    public function nuevo()
    {
        return view('canchas/nuevo');
    }

    public function guardar()
    {
        $canchaModel = new CanchaModel();

        $data = [
            'nombre_cancha' => $this->request->getPost('nombre_cancha'),
            'tipo' => $this->request->getPost('tipo'),
            'estado' => $this->request->getPost('estado'),
        ];

        if ($canchaModel->insert($data)) {
            return redirect()->to('/cancha')->with('mensaje', 'Cancha Creada con exito');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al crear la cancha');
        }
    }

    public function editar($id)
    {
        $canchaModel = new CanchaModel();
        $data['cancha'] = $canchaModel->find($id);
        return view('canchas/editar', $data);
    }

    public function actualizar($id)
    {
        $canchaModel = new CanchaModel();

        $data = [
            'nombre_cancha' => $this->request->getPost('nombre_cancha'),
            'tipo' => $this->request->getPost('tipo'),
            'estado' => $this->request->getPost('estado'),
        ];

        if ($canchaModel->update($id, $data)) {
            return redirect()->to('/cancha')->with('mensaje', 'Cancha actualizada exitosamente');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar la cancha');
        }
    }

    public function eliminar($id)
    {
        $canchaModel = new CanchaModel();
        if ($canchaModel->delete($id)) {
            return redirect()->to('/cancha')->with('mensaje', 'Cancha eliminada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar la cancha');
        }
    }
}
