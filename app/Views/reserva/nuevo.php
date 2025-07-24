<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Nueva Reserva</h2>
            
            <?php if (session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="post" action="/reserva/guardar" id="formReserva">
                        <?= csrf_field() ?>
                        
                        <?php if (session('tipo') === 'admin'): ?>
                            <!-- Mostrar selector de usuario solo para administradores -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Usuario:</label>
                                <select name="id_usuario" class="form-select form-select-sm" required>
                                    <option value="">-- Seleccione un usuario --</option>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?= $usuario['id_usuario'] ?>" <?= (session('id_usuario') == $usuario['id_usuario']) ? 'selected' : '' ?>>
                                            <?= esc($usuario['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <!-- Usuario actual (oculto) -->
                            <input type="hidden" name="id_usuario" value="<?= session('id_usuario') ?>">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Usuario:</label>
                                <input type="text" class="form-control form-control-sm" value="<?= esc($usuario_actual['nombre']) ?>" readonly>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cancha: <span class="text-danger">*</span></label>
                            <select name="id_cancha" id="id_cancha" class="form-select form-select-sm" required>
                                <option value="">-- Seleccione cancha --</option>
                                <?php foreach ($canchas as $cancha): ?>
                                    <option value="<?= $cancha['id_cancha'] ?>">
                                        <?= esc($cancha['nombre_cancha']) ?> (<?= esc($cancha['tipo']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Horario disponible: <span class="text-danger">*</span></label>
                            <select name="id_horario" id="id_horario" class="form-select form-select-sm" required disabled>
                                <option value="">-- Primero seleccione una cancha --</option>
                            </select>
                            <div id="loadingHorarios" class="text-center mt-2 d-none">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                                <span class="ms-2">Cargando horarios disponibles...</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha de reserva: <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_reserva" id="fecha_reserva" class="form-control form-control-sm" required 
                                   min="<?= date('Y-m-d') ?>" 
                                   value="<?= date('Y-m-d') ?>">
                        </div>

                        <input type="hidden" name="estado" value="pendiente">

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm py-2 px-4 flex-grow-0" id="btnGuardar">
                                <i class="bi bi-save me-2"></i>Guardar Reserva
                            </button>
                            <a href="<?= base_url('reserva') ?>" class="btn btn-outline-secondary btn-sm py-2 px-4 flex-grow-0">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectCancha = document.getElementById('id_cancha');
        const selectHorario = document.getElementById('id_horario');
        const loadingHorarios = document.getElementById('loadingHorarios');
        const fechaReserva = document.getElementById('fecha_reserva');
        const btnGuardar = document.getElementById('btnGuardar');
        
        // Cargar horarios cuando se selecciona una cancha
        selectCancha.addEventListener('change', function() {
            const idCancha = this.value;
            
            if (!idCancha) {
                selectHorario.innerHTML = '<option value="">-- Primero seleccione una cancha --</option>';
                selectHorario.disabled = true;
                return;
            }
            
            // Mostrar carga
            selectHorario.disabled = true;
            loadingHorarios.classList.remove('d-none');
            
            // Limpiar opciones anteriores
            selectHorario.innerHTML = '<option value="">Cargando horarios...</option>';
            
            // Obtener la fecha seleccionada para filtrar
            const fechaSeleccionada = fechaReserva.value;
            
            // Hacer petición AJAX para obtener horarios disponibles
            fetch(`/reserva/horariosPorCancha/${idCancha}?fecha=${fechaSeleccionada}`)
                .then(response => response.json())
                .then(data => {
                    selectHorario.innerHTML = '';
                    
                    if (data.length === 0) {
                        selectHorario.innerHTML = '<option value="">No hay horarios disponibles para esta cancha en la fecha seleccionada</option>';
                        return;
                    }
                    
                    // Agregar opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '-- Seleccione un horario --';
                    selectHorario.appendChild(defaultOption);
                    
                    // Agregar horarios disponibles
                    data.forEach(horario => {
                        const option = document.createElement('option');
                        option.value = horario.id_horario;
                        option.textContent = `${horario.hora_inicio.substring(0, 5)} - ${horario.hora_fin.substring(0, 5)}`;
                        selectHorario.appendChild(option);
                    });
                    
                    selectHorario.disabled = false;
                })
                .catch(error => {
                    console.error('Error al cargar horarios:', error);
                    selectHorario.innerHTML = '<option value="">Error al cargar horarios</option>';
                })
                .finally(() => {
                    loadingHorarios.classList.add('d-none');
                });
        });
        
        // Cargar horarios cuando cambia la fecha
        fechaReserva.addEventListener('change', function() {
            if (selectCancha.value) {
                selectCancha.dispatchEvent(new Event('change'));
            }
        });
        
        // Validar formulario antes de enviar
        document.getElementById('formReserva').addEventListener('submit', function(e) {
            if (!selectHorario.value) {
                e.preventDefault();
                alert('Por favor, seleccione un horario disponible');
                return false;
            }
            
            // Deshabilitar botón para evitar múltiples envíos
            btnGuardar.disabled = true;
            btnGuardar.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';
            
            return true;
        });
    });
</script>

<?= $this->endSection() ?>