<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Usuarios</h2>
        <a href="/usuario/nuevo" class="btn btn-primary">+ Nuevo Usuario</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaUsuarios">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['id_usuario']) ?></td>
                        <td><?= esc($usuario['nombre']) ?></td>
                        <td><?= esc($usuario['correo']) ?></td>
                        <td><?= esc($usuario['tipo']) ?></td>
                        <td>
                            <a href="/usuario/editar/<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/usuario/eliminar/<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
