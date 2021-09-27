<?php

    $path = '../productos/productos.txt';
    require_once 'utils.php';

    if(!file_exists($path))
    {
    
        echo "!Archivo no existe!";     
    
    }else{
    
        $f = fopen($path, "r");
        $linea = 0;

        while($data = fgetcsv($f, 1000000, ';', '"')){

          $linea++;

          if($linea == 0)
          continue;

          if(current($data)){

            $code = $data[0];
            $nombre = $data[1];
            $precio = $data[2];

            compararcodigo($code,$nombre,$precio);
          }
        }
        //Cerrar recursos
        fclose($f);
        unlink($path);
    }
?>