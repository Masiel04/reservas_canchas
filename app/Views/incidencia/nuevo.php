<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Nueva Incidencia</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/incidencia/guardar">

                        <div class="mb-3">
                            <label for="id_usuario" class="form-label fw-bold">Usuario:</label>
                            <?php if (session('tipo') === 'cliente'): ?>
                                <input type="text" class="form-control form-control-sm" value="<?= esc(session('nombre')) ?>" disabled>
                                <input type="hidden" name="id_usuario" value="<?= esc(session('id_usuario')) ?>">
                            <?php else: ?>
                                <select name="id_usuario" id="id_usuario" class="form-select form-select-sm" required>
                                    <option value="">-- Seleccione un usuario --</option>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?= $usuario['id_usuario'] ?>"><?= esc($usuario['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="id_cancha" class="form-label fw-bold">Cancha:</label>
                            <select name="id_cancha" id="id_cancha" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione cancha --</option>
                                <?php foreach ($canchas as $cancha): ?>
                                    <option value="<?= $cancha['id_cancha'] ?>">
                                        <?= esc($cancha['nombre_cancha']) ?> (<?= esc($cancha['tipo'] ?? '') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control form-control-sm" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="form-label fw-bold">Estado:</label>
                            <select name="estado" id="estado" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione estado --</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="resuelta">Resuelta</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm py-2 px-4 flex-grow-0">
                                <i class="bi bi-save me-2"></i>Guardar Incidencia
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
