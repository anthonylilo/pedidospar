<?php 

function controllers_autoload($classname){
  $script = "controllers/$classname.php";
  if(file_exists($script)){
    include $script;
  }else{
    die("No existe el archivo de controlador para <b>$classname</b>.");
  }
}

spl_autoload_register('controllers_autoload');

?>