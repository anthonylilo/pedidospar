<?php

    $path = '../clientes/clientes.txt';
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

            $sql="SELECT * FROM clientes";
            $leerDb = $db->query($sql);

            $nombre = $data[0];
            $ruc = $data[1];
            $direccion = $data[2];
            $numero_telefono = $data[3];

            if($leerDb->num_rows){
              while($clients = $leerDb->fetch_object()){
              $rucdb = $clients->ruc;

              if($rucdb == $ruc){

                $sql = "UPDATE clientes SET nombre='$nombre', direccion='$direccion', numero_telefono=$numero_telefono WHERE ruc='$ruc'";
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
            //NOTE: Si no hay nada en la bd
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
        }
        //Cerrar recursos
        fclose($f);
        $db->close();
        unlink($path);
    }
?>