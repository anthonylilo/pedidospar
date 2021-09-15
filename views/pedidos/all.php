<?php require_once 'views/layout/header.php'; ?>
<div class="container">
    <div class="m-0 row justify-content-center text-center">

        <?php if(isset($_SESSION['admin']) && isset($gestion)): ?>
          <h1>Pedidos generales</h1>
        <?php else: ?>
          <h1>Tus pedidos</h1>
        <?php endif; ?>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N° PEDIDO</th>
                    <?php if(isset($_SESSION['admin'])): ?>
                      <th scope="col">VENDEDOR</th>
                    <?php endif; ?>
                    <th scope="col">NOMBRE DEL CLIENTE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ESTADO</th>
                </tr>
            </thead>
            <?php while($ped = $pedidos->fetch_object()):
              ?>
            <tbody>
                <tr>
                    <td><?=$ped->id?></td>
                    <?php if(isset($_SESSION['admin'])): ?>
                      <td><?=$ped->ussname?></td>
                    <?php endif; ?>
                    <td><?=$ped->nombre?></td>
                    <td><?=number_format($ped->total, 2, ".", "," )?></td>
                    <td><?=$ped->fecha?></td>
                    <td><?=$ped->status?></td>
                </tr>
            </tbody>
            <?php endwhile; ?>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/js.js"></script>
<?php require_once 'views/layout/footer.php'; ?>