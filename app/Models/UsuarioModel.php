<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'correo', 'contrasena', 'tipo'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
