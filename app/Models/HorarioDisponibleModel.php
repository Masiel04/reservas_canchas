<?php

namespace App\Models;

use CodeIgniter\Model;

class HorarioDisponibleModel extends Model
{
    protected $table = 'horarios_disponibles';
    protected $primaryKey = 'id_horario';
    protected $allowedFields = ['id_cancha', 'fecha', 'hora_inicio', 'hora_fin', 'disponible'];
    protected $returnType = 'array';
    public $useTimestamps = false;
}
