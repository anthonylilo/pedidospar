<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
        <?php if(isset($_SESSION['cliente']) && $_SESSION['cliente'] == 'complete'): ?>
        <strong class="alert_green">El cliente se ha creado correctamente</strong>
        <?php elseif(isset($_SESSION['cliente']) && $_SESSION['cliente'] != 'complete'): ?>
        <strong class="alert_red">El cliente NO ha creado correctamente</strong>
        <?php endif; Utils::deleteSession('cliente');?>

        <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
        <strong class="alert_green">El cliente se a borrado</strong>
        <?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
        <strong class="alert_red">El cliente NO se a borrado</strong>
        <?php endif; Utils::deleteSession('delete');?>

        <h1>Clientes</h1>
        <a class="btn btn-success" href="<?=base_url?>clientes/crear">Crear cliente</a>
        <table>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>RUC</th>
                <th>DIRECCIÓN</th>
                <th>NÚMERO DE TELÉFONO</th>
                <th>Modificar</th>
                <?php if(isset($_SESSION['admin'])): ?>
                <th>Eliminar</th>
                <?php endif; ?>
            </tr>
            <?php while($cli = $clientes->fetch_object()):
              ?>
            <tr>
                <td><?=$cli->id?></td>
                <td><?=$cli->nombre?></td>
                <td><?=$cli->ruc?></td>
                <?php if(is_null($direc = $cli->direccion)):?>
                <td>Direccion no proporcionada</td>
            <?php else: ?>
                <td><?=$direc?></td>
                <?php endif; ?>
                <?php if(is_null($tlfno = $cli->numero_telefono)):?>
                <td>Telefono no proporcionado</td>
            <?php else: ?>
                <td><?=$tlfno?></td>
                <?php endif; ?>
                <td><a class="btn btn-warning" value="Modificar" href="<?=base_url?>clientes/modificar&idcli=<?=$cli->id?>">Modificar</a></td>
                <?php if(isset($_SESSION['admin'])): ?>
                <td><input data-id="<?=$cli->id?>" name-cliente="<?=$cli->nombre?>" type="button" class="btn btn-danger eliminar_cliente" value="Eliminar"></td>
                <?php endif; ?>

            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/js.js"></script>
<?php require_once 'views/layout/footer.php'; ?>
