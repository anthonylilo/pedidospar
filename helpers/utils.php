<?php 

class Utils{

  public static function deleteSession($name){
    if(isset($_SESSION[$name])){
    $_SESSION[$name] = null;
    unset($_SESSION[$name]);
    }

    return $name;
  }

  public static function isAdmin()
  {
    if(!isset($_SESSION['admin'])){
      header("Location:".base_url);
    }else{
      return true;
    }
  }

  public static function isIdentity()
  {
    if(!isset($_SESSION['identity'])){
      header("Location:".base_url);
    }else{
      return true;
    }
  }

  public static function statsCarrito(){
    $stats = array(
      'count' => 0,
      'total' => 0
    );
    
    if(isset($_SESSION['carrito'])){
      $stats['count'] = count($_SESSION['carrito']);

      foreach($_SESSION['carrito'] as $producto){
        $stats['total'] += $producto['precio']*$producto['unidades'];
      }
    }

    return $stats;
  }

  public static function showStatus($status){
    $value = "Pendiente";

    if($status == "confirm"){

      $value = "Pendiente"; 

    }elseif($status == "preparation"){

      $value = "En preparación";

    }elseif($status == "ready"){

      $value = "Preparado para enviar";

    }elseif($status == "sended"){

      $value = "Enviado";

    }

    return $value;
  }
}

function comparecode($code,$nombre,$precio){
  require_once '../configs/db.php';

  $db = Database::connect();
  $sql = "INSERT INTO productos(code,nombre,precio) VALUES('$code','$nombre',$precio) ON DUPLICATE KEY UPDATE nombre = '$nombre', precio = $precio";
  $leerDb = $db->query($sql);

  $result = false;
  if($leerDb){
    echo "Se incerto o actualizo";
  }

}

function compararcodigo($code,$nombre,$precio){
  require_once '../configs/db.php';

  $db = Database::connect();
  $sql = "SELECT COUNT(*) FROM `productos` WHERE code='$code'";
  $leerDb = $db->query($sql);
  $resultado = $leerDb->fetch_assoc();

  if($resultado['COUNT(*)']>0){

    $sql = "UPDATE productos SET nombre='$nombre', precio=$precio WHERE code='$code'";
    $save = $db->query($sql);

    if($save){
      echo "Me actualice<br>";
    }else{
      echo "No me actualice<br>";
    }
    
  }else{

    $sql = "INSERT INTO productos VALUES(NULL, '$code', '$nombre', $precio)";
    $insert = $db->query($sql);

    if($insert){
      echo "Me cree<br>";
    }else{
      echo "No me cree<br>";
    }

  }
}

function compararruc($ruc,$nombre,$direccion,$numero_telefono){
  require_once '../configs/db.php';

  $db = Database::connect();
  $sql = "SELECT COUNT(*) FROM `clientes` WHERE ruc='$ruc'";
  $leerDb = $db->query($sql);
  $resultado = $leerDb->fetch_assoc();

  if($resultado['COUNT(*)']>0){

    $sql = "UPDATE clientes SET nombre='$nombre', direccion='$direccion', numero_telefono='$numero_telefono' WHERE ruc='$ruc'";
    $save = $db->query($sql);

    if($save){
      echo "Me actualice<br>";
    }else{
      echo "No me actualice<br>";
    }
    
  }else{

    $sql = "INSERT INTO clientes VALUES(NULL, '$nombre', '$ruc', '$direccion', $numero_telefono)";
    $insert = $db->query($sql);

    if($insert){
      echo "Me cree<br>";
    }else{
      echo "No me cree<br>";
    }

  }
}