<?php

namespace App\Controllers;

use App\Models\IncidenciaModel;
use App\Models\UsuarioModel;
use App\Models\CanchaModel;

class Incidencia extends BaseController
{
    public function index()
    {
        $incidenciaModel = new IncidenciaModel();
        $session = session();
        if ($session->get('tipo') === 'admin') {
            $data['incidencias'] = $incidenciaModel->getIncidenciasConDetalles();
        } else {
            $idUsuario = $session->get('id_usuario');
            $data['incidencias'] = $incidenciaModel->getIncidenciasConDetallesPorUsuario($idUsuario);
        }
        return view('incidencia/listado', $data);
    }

    public function nuevo()
    {
        $usuarioModel = new UsuarioModel();
        $canchaModel = new CanchaModel();

        $data['usuarios'] = $usuarioModel->findAll();
        $data['canchas'] = $canchaModel->findAll();

        return view('incidencia/nuevo', $data);
    }

    public function guardar()
    {
        $incidenciaModel = new IncidenciaModel();

        $incidenciaModel->insert([
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_cancha' => $this->request->getPost('id_cancha'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $this->request->getPost('estado'),
            // 'fecha_reporte' se auto llena por default en DB
        ]);

        return redirect()->to('/incidencia');
    }

    public function editar($id)
    {
        $incidenciaModel = new IncidenciaModel();
        $usuarioModel = new UsuarioModel();
        $canchaModel = new CanchaModel();

        $data['incidencia'] = $incidenciaModel->find($id);
        $data['usuarios'] = $usuarioModel->findAll();
        $data['canchas'] = $canchaModel->findAll();

        return view('incidencia/editar', $data);
    }

    public function actualizar($id)
    {
        $incidenciaModel = new IncidenciaModel();

        $incidenciaModel->update($id, [
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_cancha' => $this->request->getPost('id_cancha'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to('/incidencia');
    }

    public function eliminar($id)
    {
        $incidenciaModel = new IncidenciaModel();
        $incidenciaModel->delete($id);

        return redirect()->to('/incidencia');
    }
}
