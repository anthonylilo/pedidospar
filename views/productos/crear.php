<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
    <?php if(isset($edit) && isset($prod) && is_object($prod) ): $url_action = base_url."productos/save&id=".$prod->id; ?>
        <h1>Editar producto <?=$prod->nombre?></h1>
    <?php else: $url_action = base_url."productos/save"; ?>
        <h1>Crear nueva producto</h1>
    <?php endif; ?>

        <form class="form-signin" action="<?=$url_action?>" method="POST">

            <label for="nombre">Nombre del producto</label>
            <input class="form-control" type="text" name="nombre" required="required" value="<?=isset($prod) && is_object($prod) ? $prod->nombre : '';?>">

            <label for="precio">Precio</label>
            <input class="form-control" type="text" name="precio" required="required" value="<?=isset($prod) && is_object($prod) ? $prod->precio : '';?>">

            <input class="form-control btn btn-success" style="margin-top: 2%;" type="submit" value="Guardar">

        </form>
    </div>
</div>
<?php require_once 'views/layout/footer.php'; ?>
