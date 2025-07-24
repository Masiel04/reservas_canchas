<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Nueva Cancha</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/cancha/guardar">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de la cancha:</label>
                            <input type="text" name="nombre_cancha" class="form-control form-control-sm" placeholder="Ingrese el nombre" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipo de cancha:</label>
                            <select name="tipo" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione tipo --</option>
                                <option value="fútbol">Fútbol</option>
                                <option value="básquet">Básquet</option>
                                <option value="voley">Voley</option>
                                <option value="tenis">Tenis</option>
                                <option value="pádel">Pádel</option>
                                <option value="multiusos">Multiusos</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Estado:</label>
                            <select name="estado" class="form-select form-select-sm" required>
                                <option value="disponible">Disponible</option>
                                <option value="no_disponible">No disponible</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-2"></i>Guardar
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
