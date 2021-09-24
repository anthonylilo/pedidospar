<?php

    $path = '../clientes/clientes.txt';
    require_once '../configs/db.php';

    $db = Database::connect();

    $test = 7;
    $test2 = 3;

    $ARRAY = array(
      3,4,5,6,7,8,9
    );

    foreach($ARRAY as $value){
      if($value <=7 && $value >= 3){
        echo "si";
      }else{
        echo "no";
      }
    }

    die();

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
    }
?>