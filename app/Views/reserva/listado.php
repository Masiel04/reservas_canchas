<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>RESERVAS DE CANCHAS</h2>
        <a href="/reserva/nuevo" class="btn btn-primary">+ Nueva Reserva</a>
    </div>

    <div class="table-responsive">
        <table id="tablaReservas" class="table table-striped table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cancha</th>
                    <th>Fecha Horario</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Fecha Reserva</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?= $reserva['id_reserva'] ?></td>
                        <td><?= esc($reserva['nombre_cancha']) ?></td>
                        <td><?= esc($reserva['fecha']) ?></td>
                        <td><?= esc($reserva['hora_inicio']) ?></td>
                        <td><?= esc($reserva['hora_fin']) ?></td>
                        <td><?= esc($reserva['fecha_reserva']) ?></td>
                        <td>
                            <span class="badge bg-<?= $reserva['estado'] === 'confirmada' ? 'success' : 'warning' ?>">
                                <?= ucfirst($reserva['estado']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/reserva/editar/<?= $reserva['id_reserva'] ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/reserva/eliminar/<?= $reserva['id_reserva'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta reserva?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Solución 1: Verificar si ya está inicializado
        if ($.fn.DataTable.isDataTable('#tablaReservas')) {
            $('#tablaReservas').DataTable().destroy();
        }
        
        // Inicializar DataTable con opciones
        $('#tablaReservas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
            },
            "responsive": true,
            "dom": '<"top"lf>rt<"bottom"ip><"clear">',
            "order": [[0, 'desc']],
            "columnDefs": [
                { "orderable": false, "targets": [7] }, // Columna de acciones
                { "className": "dt-center", "targets": [6, 7] } // Centrar estado y acciones
            ],
            "initComplete": function() {
                $('.dataTables_filter input').addClass('form-control');
                $('.dataTables_length select').addClass('form-select');
            }
        });
    });
</script>
<?= $this->endSection() ?>