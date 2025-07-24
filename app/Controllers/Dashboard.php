<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $dashboardModel = new DashboardModel();

        // Obtener los KPIs
        $data = [
            'total_reservas' => $dashboardModel->getTotalReservas(),
            'reservas_estado' => $dashboardModel->getReservasPorEstado(),
            'ingresos' => $dashboardModel->getIngresosGenerados(),
            'canchas_disponibilidad' => $dashboardModel->getCanchasDisponibilidad(),
            'canchas_reservas' => $dashboardModel->getCanchasConMasMenosReservas(),
            'incidencias_estado' => $dashboardModel->getIncidenciasEstado(),
            'promedio_resolucion' => $dashboardModel->getPromedioResolucionIncidencias(),
            'reservas_tipo_cancha' => $dashboardModel->getReservasPorTipoCancha(),
            'tendencias_hora' => $dashboardModel->getTendenciasReservasPorHora(),
            'usuarios_activos' => $dashboardModel->getUsuariosActivos()
        ];

        return view('dashboard', $data);
    }
}
?>
