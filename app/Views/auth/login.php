<!-- app/Views/auth/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body style="background:url('<?= base_url('assets/img/cancha3.jpg') ?>') center center/cover no-repeat fixed;min-height:100vh;position:relative;">
    <div style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:0;background:rgba(0,0,0,0.45);"></div>
    <div style="position:relative;z-index:1;display:flex;align-items:center;justify-content:center;min-height:100vh;">
        <div style="background:#fff;padding:2.5em 2em 2em 2em;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.07);max-width:350px;width:100%;text-align:center;">
            <h2 style="margin-bottom:1.5em;">Iniciar Sesión</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <p style="color:red; font-weight:bold;"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login') ?>" style="display:flex;flex-direction:column;gap:1em;">
                <input type="email" name="email" placeholder="Correo" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
                <input type="password" name="password" placeholder="Contraseña" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
                <button type="submit" style="padding:10px;background:#007bff;color:#fff;border:none;border-radius:5px;font-weight:bold;">Iniciar sesión</button>
            </form>

            <div style="margin-top:1em;">
                <span>¿No tienes cuenta?</span>
                <a href="<?= base_url('registro') ?>" style="color:#007bff;text-decoration:underline;margin-left:6px;">Regístrate</a>
            </div>
        </div>
    </div>
</body>
</html>
