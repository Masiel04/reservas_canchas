<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Pagos</h2>
        <a href="/pago/nuevo" class="btn btn-primary">+ Nuevo Pago</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaPagos">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Reserva (ID)</th>
                    <th>Usuario</th>
                    <th>Fecha Reserva</th>
                    <th>Monto</th>
                    <th>Método Pago</th>
                    <th>Fecha Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagos as $pago): ?>
                    <tr>
                        <td><?= $pago['id_pago'] ?></td>
                        <td><?= $pago['id_reserva'] ?></td>
                        <td><?= esc($pago['nombre_usuario']) ?></td>
                        <td><?= esc($pago['fecha_reserva']) ?></td>
                        <td><?= number_format($pago['monto'], 2) ?></td>
                        <td><?= esc($pago['metodo_pago']) ?></td>
                        <td><?= esc($pago['fecha_pago']) ?></td>
                        <td>
                            <a href="/pago/editar/<?= $pago['id_pago'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/pago/eliminar/<?= $pago['id_pago'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este pago?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
