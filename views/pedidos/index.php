<?php require_once 'views/layout/header.php'; ?>
<br>
<div class="container">
    <section class="content">
        <div class="container-fluid">
            <!-- /.card-header -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title" id="TotalCompra">Realiza tu pedido</h3>
                </div>
                <div class="card-body">

                    <div class="input-group mb-3 form-row">
                        <div class="input-group-append col">
                            <input
                                type="text"
                                class="input-group-text bg-warning w-50"
                                placeholder="Cantidad"
                                id="CantProd"
                                autofocus="autofocus">
                        </div>
                        <div class="col">
                            <input
                                type="text"
                                name="Buscador"
                                class="form-control table_search"
                                placeholder="Buscar producto">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <ul id="LiAjax" class="list-group"></ul>
                            </div>
                        </div>
                    </div>

                    <form action="<?=base_url?>pedido/guardarventa" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-success card-title" id="btnpedido">Realizar pedido</button>
                                        <div class="input-group mb-3">
                                            <label>Selecciona tu cliente (Solo puedes elegir a 1)</label>
                                            <select class="form-select" name="cliente_id" required="required">
                                                <?php while($cli = $clientes->fetch_object()):?>
                                                <option value="<?=$cli->id?>"><?=$cli->nombre?>
                                                    <?=$cli->ruc?></option>
                                                <?php endwhile; ?>
                                            </select>

                                            <div class="input-group m-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Total:
                                                        </div>
                                                    </div>
                                                    <input
                                                        readonly="readonly"
                                                        name="TotalVentaGeneral"
                                                        type="text"
                                                        value="0"
                                                        class="form-control text-center"
                                                        style="color:red; font-weight: bold"
                                                        id="TotalVenta"
                                                        placeholder="Username">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Quitar</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cant</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tirar_aca">
                                                <!--NOTE: tr td por jquery -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url?>js/js.js"></script>

<?php require_once 'views/layout/footer.php'; ?>