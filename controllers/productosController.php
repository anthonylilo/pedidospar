<?php
require_once 'models/productos.php';
class productosController{

  public function index(){
    $producto = new Productos();
    $productos = $producto->getAll();
    
    //renderizar vista
    require_once 'views/productos/index.php';
  }

  public function crear(){
    Utils::isAdmin();

    require_once 'views/productos/crear.php';
  }

  public function save(){
    Utils::isAdmin();
    if(isset($_POST)){
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $precio = isset($_POST['precio']) ? $_POST['precio'] : false;

      if($nombre && $precio){
        $producto = new Productos();
        $producto->setNombre($nombre);
        $producto->setPrecio($precio);

        if(isset($_GET['id'])){

          $id = $_GET['id'];
          $producto->setId($id);

          $save = $producto->edit();

        }else{
          $save = $producto->save();
        }
        
          if($save){
            $_SESSION['producto'] = "complete";
          }else{
            $_SESSION['producto'] = "failed";
          }
      }else{
        $_SESSION['producto'] = "failed";
      }
    }else{
      $_SESSION['producto'] = "failed";
    }
    header("Location:".base_url."productos/index");
  }

  public function modificar(){
    Utils::isAdmin();
    if(!isset($_GET)){
      header("Location:".base_url."/productos/index");
    }elseif(empty($_GET['id'])){
      header("Location:".base_url."/productos/index");
    }else{
      $edit = true;
      $id_prod = $_GET['id'];

      $producto = new Productos();
      $producto->setId($id_prod);
      $prod = $producto->getOne();

      if($prod){

        require_once 'views/productos/crear.php';

      }else{
        echo "<h1>Este id no existe en la bd</h1>";
      }
    }
  }

  public function eliminar(){
    Utils::isAdmin();

    if(isset($_POST['id'])){
      $id = $_POST['id'];
      $producto = new Productos();
      $producto->setId($id);
      $delete = $producto->delete();

      if($delete){
        $_SESSION['delete'] = 'complete';
      }else{
        $_SESSION['delete'] = 'failed';
      }
    }else{
      $_SESSION['delete'] = 'failed';
    }

    header("Location:".base_url."producto/gestion");
  }
  
}