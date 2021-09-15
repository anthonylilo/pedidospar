<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
    <?php if(isset($edit) && isset($cli) && is_object($cli) ): $url_action = base_url."clientes/save&id=".$cli->id; ?>
        <h1>Editar cliente <?=$cli->nombre?></h1>
    <?php else: $url_action = base_url."clientes/save"; ?>
        <h1>Crear nueva cliente</h1>
    <?php endif; ?>

        <form class="form-signin" action="<?=$url_action?>" method="POST">

            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" required="required" value="<?=isset($cli) && is_object($cli) ? $cli->nombre : '';?>">

            <label for="ruc">RUC</label>
            <input class="form-control" type="text" name="ruc" required="required" value="<?=isset($cli) && is_object($cli) ? $cli->ruc : '';?>">

            <label for="direccion">Dirección</label>
            <input class="form-control" type="text" name="direccion" required="required" value="<?=isset($cli) && is_object($cli) ? $cli->direccion : '';?>">

            <label for="numero_telefono">Número de teléfono</label>
            <input class="form-control" type="number" name="numero_telefono" required="required" value="<?=isset($cli) && is_object($cli) ? $cli->numero_telefono : '';?>">

            <input class="form-control btn btn-success" style="margin-top: 2%;" type="submit" value="Guardar">

        </form>
    </div>
</div>
<?php require_once 'views/layout/footer.php'; ?>