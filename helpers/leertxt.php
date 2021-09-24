<?php

    $path = '../productos/productos.txt';
    require_once '../configs/db.php';

    $db = Database::connect();

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

            $sql="SELECT * FROM productos";
            $leerDb = $db->query($sql);

            $code = $data[0];
            $nombre = $data[1];
            $precio = $data[2];

            while($prods = $leerDb->fetch_object()){
              $codedb = $prods->code;

              if($codedb == $code){

                $sql = "UPDATE productos SET nombre='$nombre', precio=$precio WHERE code=$code";
                $save = $db->query($sql);

                if($save){
                  echo "Me actualice<br>";
                }else{
                  echo "No me actualice<br>";
                }
                
              }else{

                $sql = "INSERT INTO productos VALUES(NULL, $code, '$nombre', $precio)";
                $insert = $db->query($sql);

                if($insert){
                  echo "Me cree<br>";
                }else{
                  echo "No me cree<br>";
                }

              }

            }

          }

        }

        //Cerrar recursos
        fclose($f);
        $db->close();
        unlink($path);
    }
?>