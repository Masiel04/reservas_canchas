<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gestión de Reservas</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Poppins&family=Raleway&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  


  <!-- Main CSS File -->
  <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="index-page">

  <!-- HEADER -->
  <header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">CANCHA PLUS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="<?= base_url() ?>" class="active">Inicio</a></li>
          <?php if (session('tipo') === 'admin'): ?>
            <li><a href="<?= base_url('cancha') ?>">Gestionar Canchas</a></li>
            <li><a href="<?= base_url('usuario') ?>">Gestionar Usuarios</a></li>
            <li><a href="<?= base_url('reserva') ?>">Ver Reservas</a></li>
            <li><a href="<?= base_url('pago') ?>">Gestionar Pagos</a></li>
            <li><a href="<?= base_url('incidencia') ?>">Incidencias</a></li>
            <li><a href="<?= base_url('logout') ?>">Cerrar Sesión</a></li>
          <?php elseif (session('tipo') === 'cliente'): ?>
            <li><a href="<?= base_url('cancha') ?>">Ver Canchas</a></li>
            <li><a href="<?= base_url('horario_disponible') ?>">Horarios Disponibles</a></li>
            <li><a href="<?= base_url('reserva') ?>">Mis Reservas</a></li>
            <li><a href="<?= base_url('pago') ?>">Mis Pagos</a></li>
            <li><a href="<?= base_url('incidencia') ?>">Reportar Incidencia</a></li>
            <li><a href="<?= base_url('logout') ?>">Cerrar Sesión</a></li>
          <?php else: ?>
            <li><a href="<?= base_url('login') ?>">Iniciar Sesión</a></li>
            <li><a href="<?= base_url('usuario/nuevo') ?>">Registrarse</a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main class="main">
    <?= $this->renderSection('contenido') ?>
  </main>


  <!-- FOOTER -->
  <footer id="footer" class="footer light-background">
    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Yesseña Canchig - Adriana Carua</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- iziToast CSS y JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>

  <!-- Script para mostrar notificaciones -->
  <script>
    // Mostrar notificaciones de sesión (éxito/error)
    <?php if(session()->getFlashdata('mensaje')): ?>
      iziToast.success({
        title: '¡Éxito!',
        message: '<?= session()->getFlashdata('mensaje') ?>',
        position: 'topRight',
        timeout: 5000
      });
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
      iziToast.error({
        title: 'Error',
        message: '<?= session()->getFlashdata('error') ?>',
        position: 'topRight',
        timeout: 5000
      });
    <?php endif; ?>

    // Función para confirmar eliminación con iziToast
    function confirmarEliminacion(event, mensaje = '¿Estás seguro de eliminar este registro?') {
      event.preventDefault();
      const url = event.currentTarget.getAttribute('href');
      
      iziToast.question({
        overlay: true,
        close: false,
        displayMode: 'once',
        title: 'Confirmar',
        message: mensaje,
        position: 'center',
        buttons: [
          ['<button><b>Sí</b></button>', function (instance, toast) {
            window.location.href = url;
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }, true],
          ['<button>No</button>', function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }]
        ]
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <script>
      $(document).ready(function () {
        $('#tablaReservas').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
          }
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tablaCanchas').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#tablaHorarios').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#tablaIncidencias').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#tablaPagos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#tablaUsuarios').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#tablaReservas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>
</body>
</html>
