<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">
        <?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
        <strong class="alert_green">El producto se ha creado correctamente</strong>
        <?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
        <strong class="alert_red">El producto NO ha creado correctamente</strong>
        <?php endif; Utils::deleteSession('producto');?>

        <h1>Productos</h1>
        <?php if(isset($_SESSION['admin'])): ?>
            <a class="btn btn-success" href="<?=base_url?>productos/crear">Crear producto</a>
        <?php endif; ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PRECIO</th>
                    <?php if(isset($_SESSION['admin'])): ?>
                        <th scope="col">Modificar</th>
                        <th scope="col">Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <?php while($prod = $productos->fetch_object()):
              ?>
            <tbody>
                <tr>
                    <td><?=$prod->id?></td>
                    <td><?=$prod->nombre?></td>
                    <td><?=$prod->precio?></td>
                    <?php if(isset($_SESSION['admin'])): ?>
                        <td><a class="btn btn-warning" value="Modificar" href="<?=base_url?>productos/modificar&id=<?=$prod->id?>">Modificar</a></td>
                        
                        <td><input data-id="<?=$prod->id?>" name-prod="<?=$prod->nombre?>" type="button" class="btn btn-danger eliminar_producto" value="Eliminar"></td>
                    <?php endif; ?>

                </tr>
            </tbody>
            <?php endwhile; ?>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url?>js/js.js"></script>
<?php require_once 'views/layout/footer.php'; ?>