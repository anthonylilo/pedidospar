<div class="container">
    <div class="row">
        <h1>Registrar Usuario</h1>
        <?php 
if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>

        <strong class="alert_green">Registro completado correctamente</strong>

    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>

        <strong class="alert_red">Registro fallido, introduce bien los datos</strong>

        <?php endif; ?>
        <?php Utils::deleteSession('register');?>

        <form action="<?=base_url?>usuario/save" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" required="required">
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input class="form-control" type="text" name="apellidos" required="required">
            </div>

            <div class="form-group">
                <label for="username">Usuario</label>
                <input class="form-control" type="username" name="username" required="required">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input class="form-control" type="password" name="password" required="required">
            </div>

            <div class="form-group">
                <input class="btn btn-primary m-1" style="margin-top:1%" type="submit" value="Registrarse">
            </div>
        </form>
    </div>
</div>
