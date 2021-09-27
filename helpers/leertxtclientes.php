<?php

    $path = '../clientes/clientes.txt';
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

            $nombre = $data[0];
            $ruc = $data[1];
            $direccion = $data[2];
            $numero_telefono = $data[3];

            compararruc($ruc,$nombre,$direccion,$numero_telefono);
          }
        }
        //Cerrar recursos
        fclose($f);
        unlink($path);
    }
?>