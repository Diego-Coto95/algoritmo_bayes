<?php

//Algoritmo que calcula la distancia euclidiana 
function metodo_distancia_euclidiana($a,$b,$c,$d,$e,$f,$g,$h){
        
    $valor_minimo = 1000; //Valor para que compare en la primera iteracion del algoritmo

    //Conexión a la base de datos MySql
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM profesores"; //Trae los datos requeridos de la base de datos y se guardan en la variable $sql
    $data_bd = mysqli_query( $conexion, $sql );

    //Bucle para que recorra las columnas que vienen de la base de datos
    while ($row = mysqli_fetch_array( $data_bd )) {
      $metodo_euclides=0; //Esta variable tomará el valor euclidiano a comparar  y se reiniciará cada vez que itere el bucle


      /*If que comparan un valor string proveniente de la base de datos y 
        se les asignan un valor numérico  para después poder restar ese valor en la función 
      */
      if($row['b'] == "M"):
        $row['b'] = 1;
        elseif($row['b'] == "F"):
        $row['b'] = 2;
      else:
        $row['b'] = 3;
      endif;

      if($row['c'] == "B"):
        $row['c'] = 1;
        elseif($row['c'] == "I"):
        $row['c'] = 2;
      else:
        $row['c'] = 3;
      endif;

      if($row['e'] == "DM"):
        $row['e'] = 1;
        elseif($row['e'] == "ND"):
        $row['e'] = 2;
      else:
        $row['e'] = 3;
      endif;

      if($row['f'] == "L"):
        $row['f'] = 1;
        elseif($row['f'] == "A"):
        $row['f'] = 2;
      else:
        $row['f'] = 3;
      endif;

      if($row['g'] == "N"):
        $row['g'] = 1;
      elseif($row['g'] == "S"): 
        $row['g'] = 2;
      else:
        $row['g'] = 3;
      endif;

      if($row['h'] == "N"):
        $row['h'] = 1;
      elseif($row['h'] == "S"):
        $row['h'] = 2;
      else:
        $row['h'] = 3;
      endif;

      
      /*Funcion matematica que me da el valor euclidiano. Saca la raíz cuadrada de la suma de las restas de dos valores elevados al cuadrado
        uno de ellos proveniente de la base de datos y el otro ingresado por el usuario*/
      $metodo_euclides= sqrt(pow(((int)$row['a']-(int)$a),2)+ pow(((int)$row['b']-(int)$b),2)+pow(((int)$row['c']-(int)$c),2)+pow(((int)$row['d']-(int)$d),2)+pow(((int)$row['e']-(int)$e),2)+pow(((int)$row['f']-(int)$f),2)+pow(((int)$row['g']-(int)$g),2)+pow(((int)$row['h']-(int)$h),2));

      /*Compara si el valor euclidiano es menor a un minimo establecido posteriormente, en este caso lo estableci en 1000.
        En caso de que la condición se cumpla,el valor minimo remplaza al valor establecido y en la siguiente iteración vuelve a comparar
        hasta que encuentre un valor exacto o similar.
      */
      if($metodo_euclides <= $valor_minimo){
              $valor_minimo =  $metodo_euclides;
              $class = $row['class'];
      }
    }
    return $class; //Variable que retorna el valor más cercano o exacto proveniente de la base de datos. Es el valor a mostrarle al usuario.
}
?>