<?php 

function metodo_naive_bayes($reliability,$number_of,$capacity,$costo){
  
  $frecuenciaClaseA = 1;
  $frecuenciaClaseB = 1;

  //Conexión a la base de datos MySql
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b82444";
  $conexion = mysqli_connect($host,$user,$password,$data_base);

  //Trae las probabilidades de redes
  $datosRedes = "SELECT * FROM  probabilidad_redes";
  $conexionRedes = mysqli_query($connection, $datosRedes);

  //Trae las frecuencias de redes
  $datosFrecuenciasRedes = "SELECT * FROM frecuencias_redes";
  $conexionFrecuenciaRedes = mysqli_query($conexion, $datosFrecuenciasRedes);


  //while que recorre todos los valores traidos desde la base de datos
  while ($row = mysqli_fetch_array($conexionRedes)) {
      //Datos provenientes de la Base de datos
      $datoReliability = $row['valor_probabilidad_reliability'];
      $datoNumero = $row['valor_probabilidad_number_of'];
      $datoCapacity = $row['valor_probabilidad_capacity'];
      $datoCosto = $row['valor_probabilidad_costo'];

      //Datos para comparar el reliability 
      if($row['class'] == 'A' && $row['valor_caracteristica_reliability'] == $reliability):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoReliability;
      elseif($row['class'] == 'B' && $row['valor_caracteristica_reliability'] == $reliability):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoReliability;
      endif;

      //Datos para comparar el number of links 
      if ($row['class'] == 'A' && $row['valor_caracteristica_number_of'] == $number_of):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoNumero;
      elseif($row['class'] == 'B' && $row['valor_caracteristica_number_of'] == $number_of):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoNumero;
      endif;

      //Datos para comparar el capacity 
      if($row['class'] == 'A' && $row['valor_caracteristica_capacity'] == $capacity):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoCapacity;
      elseif($row['class'] == 'B' && $row['valor_caracteristica_capacity'] == $capacity):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoCapacity;
      endif;

      //Datos para comparar el costo 
      if($row['class'] == 'A' && $row['valor_caracteristica_costo'] == $costo):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoCosto;
      elseif($row['class'] == 'B' && $row['valor_caracteristica_costo'] == $costo):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoCosto;
      endif;        
  }

  //Bucle que trae las frecuencias ya calculadas de redes
  while ($row = mysqli_fetch_array($conexionFrecuenciaRedes)) { 
    //Datos provenientes de la Base de datos
    $nClaseA = $row['nClaseA'];
    $nClaseB = $row['nClaseB'];
}
  $redes = "";
  //Producto de frecuencia
  //Compara los totales para establecer cual es el mayor valor
  if(($frecuenciaClaseA * $nClaseA) > ($frecuenciaClaseB * $nClaseB)):
      $redes = 'A';
  else:
      $redes = 'B';
  endif;

  return $redes;//Retorna el valor
}

?>