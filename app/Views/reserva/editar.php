<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Título centrado -->
            <h2 class="text-center mb-4">Editar Reserva</h2>
            
            <!-- Tarjeta más compacta -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/reserva/actualizar/<?= $reserva['id_reserva'] ?>">
                        <!-- Grupo de campos más compactos -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Usuario:</label>
                            <select name="id_usuario" class="form-select form-select-sm" required>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= $usuario['id_usuario'] ?>" <?= $usuario['id_usuario'] == $reserva['id_usuario'] ? 'selected' : '' ?>>
                                        <?= esc($usuario['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cancha:</label>
                            <select name="id_cancha" id="id_cancha" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione cancha --</option>
                                <?php foreach ($canchas as $cancha): ?>
                                    <option value="<?= $cancha['id_cancha'] ?>" <?= $cancha['id_cancha'] == $reserva['cancha_id'] ? 'selected' : '' ?>>
                                        <?= esc($cancha['nombre_cancha']) ?> (<?= esc($cancha['tipo']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Horario disponible:</label>
                            <select name="id_horario" id="id_horario" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione horario --</option>
                                <?php foreach ($horarios as $horario): ?>
                                    <option data-cancha="<?= $horario['id_cancha'] ?>" value="<?= $horario['id_horario'] ?>" <?= $horario['id_horario'] == $reserva['id_horario'] ? 'selected' : '' ?>>
                                        <?= date('d/m/Y', strtotime($horario['fecha'])) ?> | <?= substr($horario['hora_inicio'], 0, 5) ?> - <?= substr($horario['hora_fin'], 0, 5) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha de reserva:</label>
                            <input type="date" name="fecha_reserva" class="form-control form-control-sm" value="<?= date('Y-m-d', strtotime($reserva['fecha_reserva'])) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Estado:</label>
                            <select name="estado" class="form-select form-select-sm" required>
                                <option value="pendiente" <?= $reserva['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="pagada" <?= $reserva['estado'] == 'pagada' ? 'selected' : '' ?>>Pagada</option>
                                <option value="cancelada" <?= $reserva['estado'] == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
                            </select>
                        </div>

                        <!-- Botón centrado -->
                        
                        <div class="d-flex justify-content-center gap-3 mt-4">
    <button type="submit" class="btn btn-success px-4">Actualizar</button>
    <a href="/reserva" class="btn btn-secondary px-4">Cancelar</a>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Filtrar horarios según cancha seleccionada
    document.getElementById('id_cancha').addEventListener('change', function() {
        const canchaSeleccionada = this.value;
        const opcionesHorario = document.querySelectorAll('#id_horario option');
        
        opcionesHorario.forEach(option => {
            if (option.value === '') {
                option.hidden = false;
                return;
            }
            option.hidden = option.getAttribute('data-cancha') !== canchaSeleccionada;
        });

        document.getElementById('id_horario').value = '';
    });
    
    // Disparar el evento change al cargar si ya hay una cancha seleccionada
    if (document.getElementById('id_cancha').value) {
        document.getElementById('id_cancha').dispatchEvent(new Event('change'));
    }
</script>

<?= $this->endSection() ?>