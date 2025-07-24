<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Reservas</h2>
        <a href="/reserva/nuevo" class="btn btn-primary">+ Nueva Reserva</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaReservas">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
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
                        <td><?= esc($reserva['nombre_usuario']) ?></td>
                        <td><?= esc($reserva['nombre_cancha']) ?></td>
                        <td><?= esc($reserva['fecha']) ?></td>
                        <td><?= esc($reserva['hora_inicio']) ?></td>
                        <td><?= esc($reserva['hora_fin']) ?></td>
                        <td><?= esc($reserva['fecha_reserva']) ?></td>
                        <td><?= esc($reserva['estado']) ?></td>
                        <td>
                            <a href="/reserva/editar/<?= $reserva['id_reserva'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/reserva/eliminar/<?= $reserva['id_reserva'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta reserva?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
