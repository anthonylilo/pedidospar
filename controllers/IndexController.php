<?php

class indexController{

  public function index(){
    
    //renderizar vista
    require_once 'views/layout/header.php';
    require_once 'views/inicio.php';
    require_once 'views/layout/footer.php';
  }
  
}