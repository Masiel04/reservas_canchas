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

        $canchaModel->insert([
            'nombre_cancha' => $this->request->getPost('nombre_cancha'),
            'tipo' => $this->request->getPost('tipo'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to('/cancha');
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

        $canchaModel->update($id, [
            'nombre_cancha' => $this->request->getPost('nombre_cancha'),
            'tipo' => $this->request->getPost('tipo'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to('/cancha');
    }

    public function eliminar($id)
    {
        $canchaModel = new CanchaModel();
        $canchaModel->delete($id);
        return redirect()->to('/cancha');
    }
}
