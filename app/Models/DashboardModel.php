<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';

    // 1. Total de Reservas realizadas
    public function getTotalReservas()
    {
        return $this->db->table('reservas')
            ->countAllResults();
    }

    // 2. Número de reservas por estado
    public function getReservasPorEstado()
    {
        return $this->db->table('reservas')
            ->select('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->get()->getResultArray();
    }

    // 3. Ingresos generados por reservas
    public function getIngresosGenerados()
    {
        return $this->db->table('pagos')
            ->selectSum('monto', 'total_ingresos')
            ->get()->getRow();
    }

    // 4. Número de canchas disponibles vs no disponibles
    public function getCanchasDisponibilidad()
    {
        return $this->db->table('canchas')
            ->select('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->get()->getResultArray();
    }

    // 5. Promedio de tiempo de resolución de incidencias
    public function getPromedioResolucionIncidencias()
    {
        $builder = $this->db->table('incidencias');
        $builder->select('TIMESTAMPDIFF(HOUR, fecha_reporte, CURRENT_TIMESTAMP) AS horas_resolucion');
        $builder->where('estado', 'resuelta');
        $query = $builder->get();

        $totalHoras = 0;
        $count = 0;

        foreach ($query->getResult() as $row) {
            $totalHoras += $row->horas_resolucion;
            $count++;
        }

        $promedio = ($count > 0) ? $totalHoras / $count : 0;
        return $promedio;
    }

    // 6. Canchas con más y menos reservas
    public function getCanchasConMasMenosReservas()
    {
        return $this->db->table('reservas r')
            ->join('horarios_disponibles h', 'r.id_horario = h.id_horario')
            ->join('canchas c', 'h.id_cancha = c.id_cancha')
            ->select('c.nombre_cancha, COUNT(r.id_reserva) as total_reservas')
            ->groupBy('c.nombre_cancha')
            ->orderBy('total_reservas', 'DESC')
            ->get()->getResultArray();
    }

    // 7. Tendencias de reservas por hora
    public function getTendenciasReservasPorHora()
    {
        return $this->db->table('reservas r')
            ->join('horarios_disponibles h', 'r.id_horario = h.id_horario')
            ->select('HOUR(hora_inicio) as hora, COUNT(*) as total_reservas')
            ->groupBy('hora')
            ->get()->getResultArray();
    }

    // 8. Usuarios activos por tipo (cliente/admin)
    public function getUsuariosActivos()
    {
        return $this->db->table('usuarios')
            ->select('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->get()->getResultArray();
    }

    // 9. Reservas por tipo de cancha
    public function getReservasPorTipoCancha()
    {
        return $this->db->table('reservas r')
            ->join('horarios_disponibles h', 'r.id_horario = h.id_horario')
            ->join('canchas c', 'h.id_cancha = c.id_cancha')
            ->select('c.tipo, COUNT(r.id_reserva) as total_reservas')
            ->groupBy('c.tipo')
            ->get()->getResultArray();
    }

    // 10. Incidencias reportadas por estado
    public function getIncidenciasEstado()
    {
        return $this->db->table('incidencias')
            ->select('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->get()->getResultArray();
    }
}
?>
