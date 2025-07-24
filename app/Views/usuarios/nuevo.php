

<body style="background:url('<?= base_url('assets/img/cancha3.jpg') ?>') center center/cover no-repeat fixed;min-height:100vh;position:relative;">
    <div style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:0;background:rgba(0,0,0,0.45);"></div>
    <div style="position:relative;z-index:1;display:flex;align-items:center;justify-content:center;min-height:100vh;">
        <div style="background:#fff;padding:2.5em 2em 2em 2em;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.07);max-width:350px;width:100%;text-align:center;">
            <h2 style="margin-bottom:1.5em;">Registro de Nuevo Usuario</h2>
        <form method="post" action="/usuario/guardar" style="display:flex;flex-direction:column;gap:1em;">
            <input type="text" name="nombre" placeholder="Nombre" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
            <input type="email" name="correo" placeholder="Correo" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
            <input type="password" name="contrasena" placeholder="Contraseña" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
            <button type="submit" style="padding:10px;background:#007bff;color:#fff;border:none;border-radius:5px;font-weight:bold;">Registrarse</button>
        </form>
        <div style="margin-top:1em;">
            <span>¿Ya tienes cuenta?</span>
            <a href="<?= base_url('login') ?>" style="color:#007bff;text-decoration:underline;margin-left:6px;">Iniciar Sesión</a>
        </div>
    </div>
</body>


