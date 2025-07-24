<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <h2 class="text-center mb-4">Editar Pago</h2>

      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <form method="post" action="/pago/actualizar/<?= $pago['id_pago'] ?>">

            <div class="mb-3">
              <label for="id_reserva" class="form-label fw-bold">Reserva:</label>
              <select name="id_reserva" id="id_reserva" class="form-select form-select-sm" required>
                <?php foreach ($reservas as $reserva): ?>
                  <option value="<?= $reserva['id_reserva'] ?>" <?= $reserva['id_reserva'] == $pago['id_reserva'] ? 'selected' : '' ?>>
                    Reserva #<?= $reserva['id_reserva'] ?> - Fecha: <?= esc(date('d/m/Y H:i', strtotime($reserva['fecha_reserva']))) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="monto" class="form-label fw-bold">Monto:</label>
              <input type="number" name="monto" id="monto" class="form-control form-control-sm" step="0.01" min="0" value="<?= esc($pago['monto']) ?>" required>
            </div>

            <div class="mb-3">
              <label for="metodo_pago" class="form-label fw-bold">Método de Pago:</label>
              <select name="metodo_pago" id="metodo_pago" class="form-select form-select-sm" required>
                <option value="Efectivo" <?= $pago['metodo_pago'] == 'Efectivo' ? 'selected' : '' ?>>Efectivo</option>
                <option value="Tarjeta" <?= $pago['metodo_pago'] == 'Tarjeta' ? 'selected' : '' ?>>Tarjeta Crédito</option>
                <option value="Transferencia" <?= $pago['metodo_pago'] == 'Transferencia' ? 'selected' : '' ?>>Transferencia</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="fecha_pago" class="form-label fw-bold">Fecha de Pago:</label>
              <input type="datetime-local" name="fecha_pago" id="fecha_pago" class="form-control form-control-sm" value="<?= date('Y-m-d\TH:i', strtotime($pago['fecha_pago'])) ?>" required>
            </div>

            <div class="d-flex justify-content-center gap-5 mt-4">
              <button type="submit" class="btn btn-primary btn-sm py-2 px-4 flex-grow-0">
                <i class="bi bi-save me-2"></i>Actualizar
              </button>
              <a href="/pago" class="btn btn-outline-secondary btn-sm py-2 px-4 flex-grow-0">
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
