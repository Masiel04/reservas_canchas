<?php
namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    protected $allowedFields = ['id_usuario', 'id_horario', 'fecha_reserva', 'estado'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function getReservasConDetalles()
    {
        $builder = $this->db->table($this->table . ' r');
        $builder->select('r.*, u.nombre as nombre_usuario, h.fecha, h.hora_inicio, h.hora_fin, c.nombre_cancha');
        $builder->join('usuarios u', 'u.id_usuario = r.id_usuario');
        $builder->join('horarios_disponibles h', 'h.id_horario = r.id_horario');
        $builder->join('canchas c', 'c.id_cancha = h.id_cancha');

        return $builder->get()->getResultArray();
    }

    public function getReservasConDetallesPorUsuario($idUsuario)
    {
        $builder = $this->db->table($this->table . ' r');
        $builder->select('r.*, u.nombre as nombre_usuario, h.fecha, h.hora_inicio, h.hora_fin, c.nombre_cancha');
        $builder->join('usuarios u', 'u.id_usuario = r.id_usuario');
        $builder->join('horarios_disponibles h', 'h.id_horario = r.id_horario');
        $builder->join('canchas c', 'c.id_cancha = h.id_cancha');
        $builder->where('r.id_usuario', $idUsuario);

        return $builder->get()->getResultArray();
    }
}
