<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();
        return view('usuarios/listado', $data);
    }

    public function nuevo()
    {
        return view('usuarios/nuevo');
    }

    public function guardar()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'tipo' => 'cliente',  // para que el usuario que se registra sea directamente cliente
        ];

        if ($usuarioModel->insert($data)) {
            return redirect()->to('/login')->with('mensaje', 'Usuario creado con éxito. Inicia Sesion.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al crear el usuario');
        }
    }

    public function editar($id)
    {
        $usuarioModel = new UsuarioModel();
        $data['usuario'] = $usuarioModel->find($id);
        return view('usuarios/editar', $data);
    }

    public function actualizar($id)
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'tipo' => $this->request->getPost('tipo'),
        ];

        // Actualizar contraseña solo si se proporcionó una nueva
        if ($this->request->getPost('contrasena')) {
            $data['contrasena'] = password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT);
        }

        if ($usuarioModel->update($id, $data)) {
            return redirect()->to('/usuario')->with('mensaje', 'Usuario actualizado con exito');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el usuario');
        }
    }

    public function eliminar($id)
    {
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->delete($id)) {
            return redirect()->to('/usuario')->with('mensaje', 'Usuario eliminado con exito');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el usuario');
        }
    }
}
