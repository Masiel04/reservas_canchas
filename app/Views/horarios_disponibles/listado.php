<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Horarios Disponibles</h2>
        <a href="/horario_disponible/nuevo" class="btn btn-primary">+ Nuevo Horario</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaHorarios">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Disponible</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $horario): ?>
                    <tr>
                        <td><?= $horario['id_horario'] ?></td>
                        <td>
                            <?php
                            foreach ($canchas as $cancha) {
                                if ($cancha['id_cancha'] == $horario['id_cancha']) {
                                    echo esc($cancha['nombre_cancha']);
                                    break;
                                }
                            }
                            ?>
                        </td>
                        <td><?= esc($horario['fecha']) ?></td>
                        <td><?= esc($horario['hora_inicio']) ?></td>
                        <td><?= esc($horario['hora_fin']) ?></td>
                        <td>
                            <?= $horario['disponible'] ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>' ?>
                        </td>
                        <td>
                            <a href="/horario_disponible/editar/<?= $horario['id_horario'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/horario_disponible/eliminar/<?= $horario['id_horario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este horario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




<?= $this->endSection() ?>
