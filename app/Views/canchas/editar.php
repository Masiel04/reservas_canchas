<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Editar Cancha</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/cancha/actualizar/<?= $cancha['id_cancha'] ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de la cancha:</label>
                            <input type="text" name="nombre_cancha" class="form-control form-control-sm"
                                   value="<?= esc($cancha['nombre_cancha']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipo de cancha:</label>
                            <select name="tipo" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione tipo --</option>
                                <?php
                                $tipos = ['fútbol', 'básquet', 'voley', 'tenis', 'pádel', 'multiusos'];
                                foreach ($tipos as $tipo) {
                                    $selected = $cancha['tipo'] == $tipo ? 'selected' : '';
                                    echo "<option value=\"$tipo\" $selected>" . ucfirst($tipo) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Estado:</label>
                            <select name="estado" class="form-select form-select-sm" required>
                                <option value="disponible" <?= $cancha['estado'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                <option value="no_disponible" <?= $cancha['estado'] == 'no_disponible' ? 'selected' : '' ?>>No disponible</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-2"></i>Actualizar
                            </button>
                            <a href="<?= base_url('cancha') ?>" class="btn btn-outline-secondary btn-sm px-4">
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
