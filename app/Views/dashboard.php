<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Panel de Control</h2>

    <!-- Tarjetas de KPIs - Diseño más compacto -->
    <div class="row mb-4 g-3">
        <!-- Total de Reservas -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-calendar-check fs-4 text-primary me-2"></i>
                        <h6 class="card-title mb-0">Total Reservas</h6>
                    </div>
                    <p class="card-text h4 mb-0 text-primary"><?= $total_reservas ?></p>
                    <small class="text-muted">Este mes</small>
                </div>
            </div>
        </div>

        <!-- Ingresos Generados -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-cash-coin fs-4 text-success me-2"></i>
                        <h6 class="card-title mb-0">Ingresos</h6>
                    </div>
                    <p class="card-text h4 mb-0 text-success">$<?= number_format($ingresos->total_ingresos, 2) ?></p>
                    <small class="text-muted">Últimos 30 días</small>
                </div>
            </div>
        </div>

        <!-- Canchas Disponibles -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-pin-map fs-4 text-info me-2"></i>
                        <h6 class="card-title mb-0">Disponibilidad</h6>
                    </div>
                    <div class="d-flex justify-content-around">
                        <?php foreach ($canchas_disponibilidad as $estado): ?>
                            <div>
                                <span class="d-block fw-bold <?= $estado['estado'] == 'Disponible' ? 'text-success' : 'text-danger' ?>">
                                    <?= $estado['total'] ?>
                                </span>
                                <small class="text-muted"><?= esc($estado['estado']) ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resolución de Incidencias -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-clock-history fs-4 text-warning me-2"></i>
                        <h6 class="card-title mb-0">Resolución</h6>
                    </div>
                    <p class="card-text h4 mb-0 text-warning"><?= number_format($promedio_resolucion, 2) ?>h</p>
                    <small class="text-muted">Promedio</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Primera fila de gráficos -->
    <div class="row mb-4 g-3">
        <!-- Reservas por Estado -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-pie-chart me-2"></i>Reservas por Estado
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="reservasEstadoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Canchas Disponibles -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-building me-2"></i>Disponibilidad de Canchas
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="canchasDisponibilidadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda fila de gráficos -->
    <div class="row mb-4 g-3">
        <!-- Canchas con Más Reservas -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-trophy me-2"></i>Canchas Más Reservadas
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="canchasMasReservasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tendencias por Hora -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-clock me-2"></i>Reservas por Hora
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="tendenciaReservasPorHora"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tercera fila de gráficos -->
    <div class="row mb-4 g-3">
        <!-- Usuarios Activos -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-people me-2"></i>Usuarios Activos
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="usuariosActivosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservas por Tipo -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-diagram-3 me-2"></i>Reservas por Tipo de Cancha
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="reservasTipoCanchaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuarta fila (gráfico único centrado) -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h6 class="card-title text-center mb-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>Incidencias por Estado
                    </h6>
                    <div style="height: 250px;">
                        <canvas id="incidenciasEstadoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Configuración común para todos los gráficos
        const chartOptions = {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 20
                    }
                },
                datalabels: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false
                }
            }
        };

        // Colores personalizados
        const colors = {
            primary: '#4e73df',
            success: '#1cc88a',
            info: '#36b9cc',
            warning: '#f6c23e',
            danger: '#e74a3b',
            secondary: '#858796',
            light: '#f8f9fc'
        };

        // 1. Gráfico de Reservas por Estado
        new Chart(document.getElementById('reservasEstadoChart'), {
            type: 'doughnut',
            data: {
                labels: [<?php foreach ($reservas_estado as $estado): ?>'<?= $estado['estado'] ?>',<?php endforeach; ?>],
                datasets: [{
                    data: [<?php foreach ($reservas_estado as $estado): ?>'<?= $estado['total'] ?>',<?php endforeach; ?>],
                    backgroundColor: [
                        colors.primary,
                        colors.success,
                        colors.warning,
                        colors.danger
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                cutout: '70%'
            }
        });

        // 2. Gráfico de Canchas Disponibles
        new Chart(document.getElementById('canchasDisponibilidadChart'), {
            type: 'pie',
            data: {
                labels: [<?php foreach ($canchas_disponibilidad as $estado): ?>'<?= $estado['estado'] ?>',<?php endforeach; ?>],
                datasets: [{
                    data: [<?php foreach ($canchas_disponibilidad as $estado): ?>'<?= $estado['total'] ?>',<?php endforeach; ?>],
                    backgroundColor: [
                        colors.success,
                        colors.danger
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                cutout: '60%'
            }
        });

        // 3. Canchas con Más Reservas (Bar Chart)
        new Chart(document.getElementById('canchasMasReservasChart'), {
            type: 'bar',
            data: {
                labels: [<?php foreach ($canchas_reservas as $cancha): ?>'<?= $cancha['nombre_cancha'] ?>',<?php endforeach; ?>],
                datasets: [{
                    label: 'Reservas',
                    data: [<?php foreach ($canchas_reservas as $cancha): ?>'<?= $cancha['total_reservas'] ?>',<?php endforeach; ?>],
                    backgroundColor: colors.primary,
                    borderColor: colors.primary,
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // 4. Tendencias de Reservas por Hora
        new Chart(document.getElementById('tendenciaReservasPorHora'), {
            type: 'line',
            data: {
                labels: [<?php foreach ($tendencias_hora as $hora): ?>'<?= $hora['hora'] ?>',<?php endforeach; ?>],
                datasets: [{
                    label: 'Reservas',
                    data: [<?php foreach ($tendencias_hora as $hora): ?>'<?= $hora['total_reservas'] ?>',<?php endforeach; ?>],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: colors.primary,
                    borderWidth: 2,
                    pointBackgroundColor: colors.primary,
                    pointRadius: 3,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // 5. Usuarios Activos
        new Chart(document.getElementById('usuariosActivosChart'), {
            type: 'doughnut',
            data: {
                labels: [<?php foreach ($usuarios_activos as $usuario): ?>'<?= $usuario['tipo'] ?>',<?php endforeach; ?>],
                datasets: [{
                    data: [<?php foreach ($usuarios_activos as $usuario): ?>'<?= $usuario['total'] ?>',<?php endforeach; ?>],
                    backgroundColor: [
                        colors.primary,
                        colors.info
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                cutout: '70%'
            }
        });

        // 6. Reservas por Tipo de Cancha
        new Chart(document.getElementById('reservasTipoCanchaChart'), {
            type: 'bar',
            data: {
                labels: [<?php foreach ($reservas_tipo_cancha as $tipo): ?>'<?= $tipo['tipo'] ?>',<?php endforeach; ?>],
                datasets: [{
                    label: 'Reservas',
                    data: [<?php foreach ($reservas_tipo_cancha as $tipo): ?>'<?= $tipo['total_reservas'] ?>',<?php endforeach; ?>],
                    backgroundColor: [
                        colors.primary,
                        colors.success,
                        colors.warning,
                        colors.danger
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // 7. Incidencias por Estado
        new Chart(document.getElementById('incidenciasEstadoChart'), {
            type: 'pie',
            data: {
                labels: [<?php foreach ($incidencias_estado as $estado): ?>'<?= $estado['estado'] ?>',<?php endforeach; ?>],
                datasets: [{
                    data: [<?php foreach ($incidencias_estado as $estado): ?>'<?= $estado['total'] ?>',<?php endforeach; ?>],
                    backgroundColor: [
                        colors.success,
                        colors.danger,
                        colors.warning
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                cutout: '60%'
            }
        });
    </script>
</div>

<?= $this->endSection() ?>