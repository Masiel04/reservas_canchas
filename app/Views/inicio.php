<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<!-- Hero Section Centrada -->
<section id="hero" class="hero-section d-flex align-items-center">
  <img src="<?= base_url('assets/img/cancha3.jpg') ?>" alt="Cancha deportiva" class="hero-bg" data-aos="fade-in">

  <div class="container text-center position-relative" data-aos="zoom-out" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-white display-4 fw-bold mb-3">BIENVENIDOS</h2>
        <p class="text-white fs-3 mb-5">GESTIÓN DE RESERVAS CANCHAS DEPORTIVAS</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <?php if (session('tipo') === 'admin'): ?>
            <a href="<?= base_url('usuario') ?>" class="btn btn-primary btn-lg px-4 py-2 fw-bold">Gestionar Usuarios</a>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-primary btn-lg px-4 py-2 fw-bold">Dashboard</a>
            <a href="<?= base_url('cancha') ?>" class="btn btn-success btn-lg px-4 py-2 fw-bold">Gestionar Canchas</a>
            <a href="<?= base_url('reserva') ?>" class="btn btn-info btn-lg px-4 py-2 fw-bold">Ver Reservas</a>
            <a href="<?= base_url('pago') ?>" class="btn btn-warning btn-lg px-4 py-2 fw-bold">Gestionar Pagos</a>
            <a href="<?= base_url('incidencia') ?>" class="btn btn-secondary btn-lg px-4 py-2 fw-bold">Incidencias</a>
            <a href="<?= base_url('horario_disponible') ?>" class="btn btn-lg px-4 py-2 fw-bold" style="background-color:orange; color:white; border:none;">Horarios disponibles</a>
          <?php elseif (session('tipo') === 'cliente'): ?>
            <a href="<?= base_url('cancha') ?>" class="btn btn-success btn-lg px-4 py-2 fw-bold">Ver Canchas</a>
            <a href="<?= base_url('reserva') ?>" class="btn btn-info btn-lg px-4 py-2 fw-bold">Mis Reservas</a>
            <a href="<?= base_url('pago') ?>" class="btn btn-warning btn-lg px-4 py-2 fw-bold">Mis Pagos</a>
            <a href="<?= base_url('incidencia') ?>" class="btn btn-secondary btn-lg px-4 py-2 fw-bold">Reportar Incidencia</a>
          <?php else: ?>
            <a href="<?= base_url('reserva/nuevo') ?>" class="btn btn-light btn-lg px-4 py-2 fw-bold">RESERVAR AHORA</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .hero-section {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
  }
  
  .hero-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    z-index: 0;
  }
  
  /* Texto centrado verticalmente */
  .container.text-center {
    position: relative;
    z-index: 1;
    transform: translateY(-5%); /* Ajuste fino de centrado */
  }
  
  /* Estilos de texto mejorados */
  .text-white {
    color: white !important;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
  }
  
  /* Efecto para botones */
  .btn-light {
    transition: all 0.3s;
  }
  
  .btn-outline-light:hover {
    background: #38caee26;
  }
  
  @media (max-width: 768px) {
    .display-4 {
      font-size: 2.5rem !important;
    }
    
    .fs-3 {
      font-size: 1rem !important;
    }
    
    .d-flex {
      flex-direction: column;
      gap: 12px !important;
    }
    
    .btn {
      width: 90%;
      max-width: 200px;
    }
  }
</style><!-- /Hero Section -->
<?= $this->endSection() ?>
