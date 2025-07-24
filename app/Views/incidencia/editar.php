<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Actualizar Incidencia</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/incidencia/actualizar/<?= $incidencia['id_incidencia'] ?>">

                        <div class="mb-3">
                            <label for="id_usuario" class="form-label fw-bold">Usuario:</label>
                            <select name="id_usuario" id="id_usuario" class="form-select form-select-sm" required>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= $usuario['id_usuario'] ?>" <?= $usuario['id_usuario'] == $incidencia['id_usuario'] ? 'selected' : '' ?>>
                                        <?= esc($usuario['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_cancha" class="form-label fw-bold">Cancha:</label>
                            <select name="id_cancha" id="id_cancha" class="form-select form-select-sm" required>
                                <?php foreach ($canchas as $cancha): ?>
                                    <option value="<?= $cancha['id_cancha'] ?>" <?= $cancha['id_cancha'] == $incidencia['id_cancha'] ? 'selected' : '' ?>>
                                        <?= esc($cancha['nombre_cancha']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="form-control form-control-sm" required><?= esc($incidencia['descripcion']) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="form-label fw-bold">Estado:</label>
                            <select name="estado" id="estado" class="form-select form-select-sm" required>
                                <option value="pendiente" <?= $incidencia['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="resuelta" <?= $incidencia['estado'] == 'resuelta' ? 'selected' : '' ?>>Resuelta</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm py-2 px-4 flex-grow-0">
                                <i class="bi bi-save me-2"></i>Actualizar
                            </button>
                            <a href="/incidencia" class="btn btn-outline-secondary btn-sm py-2 px-4 flex-grow-0">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
