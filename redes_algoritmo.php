<?php 

//Algoritmo que calcula la distancia euclidiana  
function metodo_distancia_euclidiana($reliability,$number_of,$capacity,$costo){
        
    $valor_minimo = 1000; //Valor para que compare en la primera iteracion del algoritmo

    //Conexión a la base de datos MySql
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM redes"; //Trae los datos requeridos de la base de datos y se guardan en la variable $sql
    $data_bd = mysqli_query( $conexion, $sql );

    //Bucle para que recorra las columnas que vienen de la base de datos
    while ($row = mysqli_fetch_array( $data_bd )) {
      $metodo_euclides=0; //Esta variable tomará el valor euclidiano a comparar  y se reiniciará cada vez que itere el bucle


      /*If que comparan un valor string proveniente de la base de datos y 
        se les asignan un valor numérico  para después poder restar ese valor en la función 
      */
      if($row['capacity'] == "Low"):
        $row['capacity'] = 1;
      elseif($row['capacity'] == "Medium"):
        $row['capacity'] = 2;
      else:
        $row['capacity'] = 3;
      endif;

      if($row['costo'] == "Low"):
        $row['costo'] = 1;
      elseif($row['costo'] == "Medium"):
        $row['costo'] = 2;
      else:
        $row['costo'] = 3;
      endif;

      
      /*Funcion matematica que me da el valor euclidiano. Saca la raíz cuadrada de la suma de las restas de dos valores elevados al cuadrado
      uno de ellos proveniente de la base de datos y el otro ingresado por el usuario
      */
      $metodo_euclides= sqrt(pow(((int)$row['reliability']-(int)$reliability),2)+ pow(((int)$row['number_of']-(int)$number_of),2)+pow(((int)$row['capacity']-(int)$capacity),2)+pow(((int)$row['costo']-(int)$costo),2));


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