<?php
require_once 'models/pedidos.php';
require_once 'models/productos.php';

class pedidoController{

  public function realizar(){
    if(isset($_SESSION['identity'])){
      $cliente = new Pedidos();
      $clientes = $cliente->getClientes();

      require_once 'views/pedidos/index.php';

    }else{
      header("Location:".base_url);
    }
  }

  public function guardarventa(){
    if(isset($_POST)){
      $usuario_id = isset($_SESSION['identity']->id) ? $_SESSION['identity']->id : false;
      $cliente_id = isset($_POST['cliente_id']) ? $_POST['cliente_id'] : false;
      $total = isset($_POST['TotalVentaGeneral']) ? $_POST['TotalVentaGeneral'] : false;
      $IdProd = isset($_POST['IdProd']) ? $_POST['IdProd'] : false;
      $CantProdV = isset($_POST['CantProdV']) ? $_POST['CantProdV'] : false;

      if(is_array($IdProd) && !empty($IdProd) && is_array($CantProdV) && !empty($CantProdV)){
        if($usuario_id && $cliente_id  && $total){

        $total = intval(str_replace(".", "", $total));

        $venta = new Pedidos();
        $venta->setUsuario_id($usuario_id);
        $venta->setCliente_id($cliente_id);
        $venta->setTotal($total);

        $save = $venta->savePedido();

        //NOTE: guardar linea pedido

        $venta->setProductoid($IdProd);
        $venta->setUnidades($CantProdV);

        $save_cobro = $venta->save_linea();
        
        if($save && $save_cobro){
          $_SESSION['pedido'] = 'complete';
        }else{
          $_SESSION['pedido'] = 'failed';
        }

        }else{
        $_SESSION['pedido'] = 'failed';
        }
      }else{
        $_SESSION['pedido'] = 'failed';
      }

    }else{
      $_SESSION['pedido'] = 'failed';
    }
    header("Location:".base_url.'pedido/status');
  }

  public function buscar(){
    if(isset($_POST['consulta'])){
        $nombre = $_POST['consulta'];

        $producto = new Productos();
        $producto->setNombre($nombre);
        $productos = $producto->search();

        if($productos->num_rows > 0){

          while($fila = $productos->fetch_object()){
            ?>
              <li style="list-style:none" class="list-group-item">
                <button class="btn btn-warning btn-block ProdBtn" NP="<?=$fila->nombre?>" PP="<?=$fila->precio?>" IP="<?=$fila->id?>" CP="<?=$fila->code?>"><?=$fila->nombre?> <?=number_format($fila->precio, 2, ",", "." )?></button>
              </li>
              <br>
            <?php
          } 

        }else{
          echo "Error";
        }

    }else{
      echo "<div class='container'><p>Error en la busquedad</p></div>";
    }
  }

  public function status(){
    if(isset($_SESSION['identity'])){
      $identity = $_SESSION['identity'];
      $pedido = new Pedidos();
      $pedido->setUsuario_id($identity->id);

      $pedido = $pedido->getOneByUser();

      $pedido_productos = new Pedidos();
      $productos = $pedido_productos->getProductosByPedido($pedido->id);
    }
    require_once 'views/pedidos/status.php';
  }

  public function listadopedido(){
    Utils::isIdentity();
    $usuario_id = $_SESSION['identity']->id;
    $pedido = new Pedidos();

    //NOTE: Sacar los pedidos del usuario
    $pedido->setUsuario_id($usuario_id);
    $pedidos = $pedido->getAllByUser();

    require_once 'views/pedidos/all.php';
  }

  public function gestion(){
    Utils::isAdmin();
    $gestion = true;

    $pedido = new Pedidos();
    $pedidos = $pedido->getAll();
    
    require_once 'views/pedidos/all.php';
  }

  public function test(){
    var_dump($_POST);
    die;
  }
}