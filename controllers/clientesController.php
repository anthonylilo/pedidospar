<?php
require_once 'models/clientes.php';

class clientesController{
  public function index(){

    $cliente = new Clientes();
    $clientes = $cliente->getAll();

    require_once 'views/clientes/index.php';
  }

  public function crear()
  {
    require_once 'views/clientes/crear.php';
  }

  public function save(){
    if(isset($_POST)){
      $nombre_cliente = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $ruc = isset($_POST['ruc']) ? $_POST['ruc'] : false;
      $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
      $numero_telefono = isset($_POST['numero_telefono']) ? $_POST['numero_telefono'] : false;

      if($nombre_cliente && $ruc && $direccion && $numero_telefono){

        //NOTE: guardar el cliente
        $cliente = new  Clientes();
        $cliente->setNombre($nombre_cliente);
        $cliente->setRuc($ruc);
        $cliente->setDireccion($direccion);
        $cliente->setNumero_telefono($numero_telefono);

        if(isset($_GET['id'])){

          $id = $_GET['id'];
          $cliente->setId($id);

          $save = $cliente->edit();
          
        }else{
          $save = $cliente->save();
        }

        if($save){
          $_SESSION['cliente'] = "complete";
        }else{
          $_SESSION['cliente'] = "failed";
        }

      }else{
        $_SESSION['cliente'] = "failed";
      }
    }else{
      $_SESSION['cliente'] = "failed";
    }
    header("Location:".base_url."/clientes/index");
  }

  public function modificar()
  {
    if(!isset($_GET)){
      header("Location:".base_url."/clientes/index");
    }elseif(empty($_GET['idcli'])){
      header("Location:".base_url."/clientes/index");
    }else{
      $edit = true;
      $id_cliente = $_GET['idcli'];

      $cliente = new Clientes();
      $cliente->setId($id_cliente);
      $cli = $cliente->verificar();

      if($cli){

        require_once 'views/clientes/crear.php';

      }else{
        echo "<h1>Este id no existe en la bd</h1>";
      }
    }
  }

  public function eliminar(){
    if(!isset($_POST)){
      header("Location:".base_url."/clientes/index");
    }else{
      $id_cliente = $_POST['id'];

      $cliente = new Clientes();
      $cliente->setId($id_cliente);
      $delete = $cliente->delete();

      $r = false;
      if($delete){
        echo $r = true;
      }
    }
  }
}