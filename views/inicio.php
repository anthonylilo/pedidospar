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
                <?=$_SESSION['identity']->username?></li>
            <li class="list-group-item">
                <a href="<?=base_url?>productos/index">Ver/Crear/Modificar Productos</a>
            </li>
            <li class="list-group-item">
                <a href="<?=base_url?>clientes/index">Ver/Crear/Modificar Clientes</a>
            </li>
            <li class="list-group-item">
                <a href="<?=base_url?>pedido/listadopedido">Estado del pedido</a>
            </li>
            
            <li class="list-group-item">
                <a href="<?=base_url?>pedido/realizar">Realizar pedido</a>
            </li>
            <li class="list-group-item">
                <a href="<?=base_url?>usuario/logout">Cerrar sesión</a>
            </li>
        <?php endif;?>
            <?php if(isset($_SESSION['admin'])): ?>
            <li class="list-group-item">
                <a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>
            </li>
            <li class="list-group-item">
                <a href="<?=base_url?>usuario/register">Registrar usuario</a>
            </li>    
        <?php endif; ?>
        </ul>
    </div>
</div>
<?php require_once 'views/layout/footer.php'; ?>
