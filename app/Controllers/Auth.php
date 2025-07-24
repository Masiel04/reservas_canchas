<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function validar()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->where('correo', $email)->first();

        if ($usuario && password_verify($password, $usuario['contrasena'])) {
            $session = session();
            $session->set([
                'id_usuario' => $usuario['id_usuario'],
                'nombre'     => $usuario['nombre'],
                'tipo'       => $usuario['tipo'],
                'logueado'   => true
            ]);
            // Configurar mensaje de bienvenida en la sesión
            $session->setFlashdata('bienvenida', true);
            $session->setFlashdata('nombre_usuario', $usuario['nombre']);
            
            // Redirigir siempre a inicio, el menú y módulos se adaptan por rol
            return redirect()->to('/')->with('mensaje', '¡Bienvenido/a ' . $usuario['nombre'] . '!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
        }
    }
    public function loginForm()
    {
        return view('auth/login');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
