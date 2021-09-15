<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>DepotWeb - pedidos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
            crossorigin="anonymous">
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=base_url?>">Prealfa(DepotWeb)</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=base_url?>">Inicio</a>
                        </li>
                        <?php if(!isset($_SESSION['identity'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url?>usuario/iniciarsesion">Iniciar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url?>clientes/index">Ver/Crear/Modificar Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url?>pedido/listadopedido">Estado del pedido</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url?>pedido/realizar">Realizar pedido</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="<?=base_url?>usuario/logout"
                                tabindex="-1"
                                aria-disabled="true">Cerrar sesión</a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>