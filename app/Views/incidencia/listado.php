<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Incidencias</h2>
        <a href="/incidencia/nuevo" class="btn btn-primary">+ Nueva Incidencia</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaIncidencias">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Cancha</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Reporte</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incidencias as $incidencia): ?>
                    <tr>
                        <td><?= $incidencia['id_incidencia'] ?></td>
                        <td><?= esc($incidencia['nombre_usuario']) ?></td>
                        <td><?= esc($incidencia['nombre_cancha']) ?></td>
                        <td><?= esc($incidencia['descripcion']) ?></td>
                        <td><?= esc($incidencia['estado']) ?></td>
                        <td><?= $incidencia['fecha_reporte'] ?></td>
                        <td>
                            <a href="/incidencia/editar/<?= $incidencia['id_incidencia'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/incidencia/eliminar/<?= $incidencia['id_incidencia'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta incidencia?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
