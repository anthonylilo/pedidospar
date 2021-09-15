<?php require_once 'views/layout/header.php'; ?>
<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<div class="container">
    <div class="row">
        <div class="col-md-5 m-1">

            <div class="project-info-box mt-0">
                <?php if(isset($pedido)): ?>
                <h1>Tu pedido se ha confirmado</h1>
                <p class="mb-0">Tu pedido ha sido guardado con exito.</p>
            </div>
            <!-- / project-info-box -->

            <div class="project-info-box">
                <h3>Datos del pedido:</h3>
                <p>
                    <b>Número del pedido:</b>
                    <?=$pedido->id?></p>
                <p>
                    <b>Total a pagar:</b>
                    
                    <?=number_format($pedido->total, 2, ".", "," )?>
                    Gs</p>
            </div>
            <!-- / project-info-box -->
        </div>
        <!-- / column -->

        <div class="project-info-box mt-0 mb-0">
            <p class="mb-0">
                <span class="fw-bold mr-10 va-middle hide-mobile">Productos:</span>
            </p>
        </div>
        <!-- / project-info-box -->
    </div>
    <!-- / column -->

    <div class="m-0 row justify-content-center text-center">
        <table class="table table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
            <?php while($producto = $productos->fetch_object()): ?>
                <tr>
                    <td>
                        <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>">
                            <?=$producto->nombre?></a>
                    </td>
                    <td><?=$producto->precio?></td>
                    <td><?=$producto->unidades?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>
</div>

<?php endif; ?>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
<h1>Tu pedido NO ha podido procesarse</h1>
<p>De seguro esta enviando valores vacíos, por favor verifique.</p>
<?php endif; ?>
<?php require_once 'views/layout/footer.php'; ?>