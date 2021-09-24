<?php
require_once 'models/usuario.php';

class usuarioController{

  public function index(){
    echo "Controlador usuarios, accion index";
  }

  public function register()
  {
    //Utils::isAdmin();
    require_once 'views/usuario/registro.php';
  }

  public function save()
  {
    if(isset($_POST)){
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
      $username = isset($_POST['username']) ? $_POST['username'] : false;
      $password = isset($_POST['password']) ? $_POST['password'] : false;

      if($nombre && $apellidos && $username && $password){
        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setApellidos($apellidos);
        $usuario->setUsername($username);
        $usuario->setPassword($password);
        $save = $usuario->save();

        if($save){
          $_SESSION['register'] = 'complete';
        }else{
          $_SESSION['register'] = 'failed';
        }
      }else{
      $_SESSION['register'] = 'failed';
      }
    }else{
      $_SESSION['register'] = 'failed';
    }
    header("Location:".base_url.'usuario/register');
  }

  public function iniciarsesion(){
    require_once 'views/usuario/login.php';
  }

  public function login()
  {
    if(isset($_POST)){
      //NOTE: Identificar usuario
      //NOTE: Consulta a la base de datos
      $usuario = new Usuario();
      $usuario->setUsername($_POST['username']);
      $usuario->setPassword($_POST['password']);

      $identity = $usuario->login();

      if($identity && is_object($identity)){
        $_SESSION['identity'] = $identity;

        if($identity->rol == 'admin'){
          $_SESSION['admin'] = true;
        }
      }else{
        $_SESSION['error_login'] = "Identificacion fallida !!";
      }
    }
    header("Location:".base_url);
  }

  public function logout()
  {
    if(isset($_SESSION['identity'])){
      unset($_SESSION['identity']);
    }

    if(isset($_SESSION['admin'])){
      unset($_SESSION['admin']);
    }

    header("Location:".base_url);
  }
  
}