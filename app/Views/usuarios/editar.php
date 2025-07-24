<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<h2>Actualizar Usuario</h2>
<form method="post" action="/usuario/actualizar/<?= $usuario['id_usuario'] ?>">
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>
    <input type="email" name="correo" value="<?= $usuario['correo'] ?>" required><br>
    <button type="submit">Actualizar</button>
</form>
<?= $this->endSection() ?>