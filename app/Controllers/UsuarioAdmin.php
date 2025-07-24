<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioAdmin extends BaseController
{
    public function crearAdmin()
    {
        $model = new UsuarioModel();

        // Verificar si ya existe un admin para evitar duplicados
        $adminExistente = $model->where('tipo', 'admin')->first();
        if ($adminExistente) {
            return "Ya existe un administrador registrado.";
        }

        // Insertar nuevo usuario admin
        $model->insert([
            'nombre' => 'admin',
            'correo' => 'admin@fundeporte.com',
            'contrasena' => password_hash('admin123', PASSWORD_DEFAULT),
            'tipo' => 'admin',
        ]);

        return "Administrador creado correctamente.";
    }
}
