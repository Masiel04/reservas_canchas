<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoModel extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    protected $allowedFields = ['id_reserva', 'monto', 'metodo_pago', 'fecha_pago'];

    // Método para traer pagos con detalle de la reserva y usuario (opcional)
    public function getPagosConDetalles()
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('p.*, r.fecha_reserva, r.estado as estado_reserva, u.nombre as nombre_usuario');
        $builder->join('reservas r', 'r.id_reserva = p.id_reserva');
        $builder->join('usuarios u', 'u.id_usuario = r.id_usuario');

        return $builder->get()->getResultArray();
    }

    public function getPagosConDetallesPorUsuario($idUsuario)
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('p.*, r.fecha_reserva, r.estado as estado_reserva, u.nombre as nombre_usuario');
        $builder->join('reservas r', 'r.id_reserva = p.id_reserva');
        $builder->join('usuarios u', 'u.id_usuario = r.id_usuario');
        $builder->where('u.id_usuario', $idUsuario);
        return $builder->get()->getResultArray();
    }
}
