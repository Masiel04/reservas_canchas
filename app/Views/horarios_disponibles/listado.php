<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<?php if (session('mensaje')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Horarios Disponibles</h2>
        <?php if (session('tipo') === 'admin'): ?>
            <a href="/horario_disponible/nuevo" class="btn btn-primary">+ Nuevo Horario</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaHorarios">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Disponible</th>
                    <?php if (session('tipo') === 'admin' || session('tipo') === 'cliente'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $horario): ?>
                    <tr>
                        <td><?= $horario['id_horario'] ?></td>
                        <td>
                            <?php
                            foreach ($canchas as $cancha) {
                                if ($cancha['id_cancha'] == $horario['id_cancha']) {
                                    echo esc($cancha['nombre_cancha']);
                                    break;
                                }
                            }
                            ?>
                        </td>
                        <td><?= esc($horario['fecha']) ?></td>
                        <td><?= esc($horario['hora_inicio']) ?></td>
                        <td><?= esc($horario['hora_fin']) ?></td>
                        <td><?= esc($horario['disponible']) ?></td>
                        <?php if (session('tipo') === 'admin' || session('tipo') === 'cliente'): ?>
                            <td>
                                <?php if (session('tipo') === 'admin'): ?>
                                    <a href="/horario_disponible/editar/<?= $horario['id_horario'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="/horario_disponible/eliminar/<?= $horario['id_horario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este horario?')">Eliminar</a>
                                <?php endif; ?>
                                
                                <?php if ($horario['disponible'] && session('tipo') === 'cliente'): ?>
                                    <form action="/reserva/guardar" method="post" class="d-inline" onsubmit="return confirmReserva(this, <?= $horario['id_horario'] ?>)">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id_horario" value="<?= $horario['id_horario'] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn-reserva-<?= $horario['id_horario'] ?>">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <span class="btn-text">Reservar</span>
                                        </button>
                                    </form>
                                <?php elseif (session('tipo') === 'cliente'): ?>
                                    <button class="btn btn-sm btn-secondary" disabled>No disponible</button>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Asegúrate de tener esto en tu plantilla principal o en la vista -->
<script>
    $(document).ready(function () {
        $('#tablaHorarios').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": <?php echo (session('tipo') === 'admin') ? '[6]' : '[]'; ?> }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });

    function confirmReserva(form, idHorario) {
        if (!confirm('¿Confirmar reserva de este horario?')) {
            return false;
        }
        
        const button = form.querySelector('button[type="submit"]');
        const spinner = button.querySelector('.spinner-border');
        const buttonText = button.querySelector('.btn-text');
        
        // Mostrar estado de carga
        spinner.classList.remove('d-none');
        buttonText.textContent = 'Procesando...';
        button.disabled = true;
        
        // Deshabilitar otros botones de reserva
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            if (btn.id !== `btn-reserva-${idHorario}`) {
                btn.disabled = true;
            }
        });
        
        return true;
    }
</script>

<?= $this->endSection() ?>
