<?php 
namespace App\Models;

use CodeIgniter\Model;

class CanchaModel extends Model
{
    protected $table = 'canchas';
    protected $primaryKey = 'id_cancha';
    protected $allowedFields = ['nombre_cancha', 'tipo', 'estado'];
    protected $returnType = 'array';
    public $useTimestamps = false;
}
