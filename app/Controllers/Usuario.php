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

        $usuarioModel->insert([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'tipo' => 'cliente',  // para que el usuario que se registra sea directamente cliente
        ]);

        return redirect()->to('/login')->with('success', 'Usuario creado con éxito. Ahora puedes iniciar sesión.');
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

        $usuarioModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'tipo' => $this->request->getPost('tipo'),
        ]);

        return redirect()->to('/login')->with('success', 'Usuario creado con éxito. Ahora puedes iniciar sesión.');
    }

    public function eliminar($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);
        return redirect()->to('/login')->with('success', 'Usuario creado con éxito. Ahora puedes iniciar sesión.');
    }
}
