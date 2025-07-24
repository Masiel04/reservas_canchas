<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Nuevo Horario Disponible</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/horario_disponible/guardar">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cancha:</label>
                            <select name="id_cancha" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione una cancha --</option>
                                <?php foreach ($canchas as $cancha): ?>
                                    <option value="<?= $cancha['id_cancha'] ?>">
                                        <?= esc($cancha['nombre_cancha']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha:</label>
                            <input type="date" name="fecha" class="form-control form-control-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Hora Inicio:</label>
                            <input type="time" name="hora_inicio" class="form-control form-control-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Hora Fin:</label>
                            <input type="time" name="hora_fin" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="disponible" class="form-check-input" id="disponible" checked>
                            <label class="form-check-label fw-bold" for="disponible">Disponible</label>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-2"></i>Guardar
                            </button>
                            <a href="<?= base_url('horario_disponible') ?>" class="btn btn-outline-secondary btn-sm px-4">
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
