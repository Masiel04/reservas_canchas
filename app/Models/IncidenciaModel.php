<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidenciaModel extends Model
{
    protected $table = 'incidencias';
    protected $primaryKey = 'id_incidencia';
    protected $allowedFields = ['id_usuario', 'id_cancha', 'descripcion', 'estado', 'fecha_reporte'];

    // Opcional: método para traer incidencias con detalles de usuario y cancha
    public function getIncidenciasConDetalles()
    {
        $builder = $this->db->table($this->table . ' i');
        $builder->select('i.*, u.nombre as nombre_usuario, c.nombre_cancha');
        $builder->join('usuarios u', 'u.id_usuario = i.id_usuario');
        $builder->join('canchas c', 'c.id_cancha = i.id_cancha');
        $builder->orderBy('i.fecha_reporte', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getIncidenciasConDetallesPorUsuario($idUsuario)
    {
        $builder = $this->db->table($this->table . ' i');
        $builder->select('i.*, u.nombre as nombre_usuario, c.nombre_cancha');
        $builder->join('usuarios u', 'u.id_usuario = i.id_usuario');
        $builder->join('canchas c', 'c.id_cancha = i.id_cancha');
        $builder->where('i.id_usuario', $idUsuario);
        $builder->orderBy('i.fecha_reporte', 'DESC');
        return $builder->get()->getResultArray();
    }
}
