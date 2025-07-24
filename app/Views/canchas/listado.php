<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Canchas</h2>
        <?php if (session('tipo') === 'admin'): ?>
            <a href="/cancha/nuevo" class="btn btn-primary">+ Nueva Cancha</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaCanchas">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre Cancha</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <?php if (session('tipo') === 'admin'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($canchas as $cancha): ?>
                <tr>
                    <td><?= esc($cancha['id_cancha']) ?></td>
                    <td><?= esc($cancha['nombre_cancha']) ?></td>
                    <td><?= esc($cancha['tipo']) ?></td>
                    <td><?= esc($cancha['estado']) ?></td>
                    <?php if (session('tipo') === 'admin'): ?>
                        <td>
                            <a href="/cancha/editar/<?= $cancha['id_cancha'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/cancha/eliminar/<?= $cancha['id_cancha'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
