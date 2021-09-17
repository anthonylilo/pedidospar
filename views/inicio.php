<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
        <h1>Pedidos Online</h1>
        <ul class="list-group">
            <?php if(!isset($_SESSION['identity'])): ?>
            <li class="list-group-item">
                <a href="<?=base_url?>usuario/iniciarsesion">Iniciar Sesión</a>
            </li>
        <?php else: ?>
            <li class="list-group-item">Usuario:
                <?=$_SESSION['identity']->username?>
            </li>

            <li class="list-group-item">
                <a
                    href="<?=base_url?>pedido/realizar"
                    class="btn btn-danger"
                    style="color:white;">Realizar pedido</a>
            </li>

            <li class="list-group-item">
                <a href="<?=base_url?>pedido/listadopedido" class="btn btn-primary">Estado del pedido</a>
            </li>

            <li class="list-group-item">
                <a
                    href="<?=base_url?>productos/index"
                    class="btn btn-info"
                    style="color:white;">Ver/Crear/Modificar Productos</a>
            </li>

            <li class="list-group-item">
                <a href="<?=base_url?>clientes/index" class="btn btn-info" style="color:white;">Ver/Crear/Modificar Clientes</a>
            </li>

            <?php if(isset($_SESSION['admin'])): ?>
            <li class="list-group-item">
                <a href="<?=base_url?>pedido/gestion" class="btn btn-success">Gestionar pedidos</a>
            </li>
            <li class="list-group-item">
                <a href="<?=base_url?>usuario/register" class="btn btn-dark">Registrar usuario</a>
            </li>
            <?php endif; ?>
            <li class="list-group-item">
                <a href="<?=base_url?>usuario/logout" class="btn btn-warning">Cerrar sesión</a>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>
<?php require_once 'views/layout/footer.php'; ?>