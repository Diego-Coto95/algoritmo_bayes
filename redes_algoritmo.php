<?php 

function metodo_naive_bayes($reliability,$number_of,$capacity,$costo){

  ///Conexión a la base de datos MySql
  $host = "127.0.0.1";
  $user = "root";
  // $host = "163.178.107.10";
  // $user = "laboratorios";
  // $password = "KmZpo.2796";+
  $password ="";
  $data_base = "if7103_tarea2_b82444";
  // $conexion = mysqli_connect($host,$user,$password,$data_base);
  $conexion = mysqli_connect($host,$user,$password ,$data_base);
  
  $frecuenciaClaseA = 1;
  $frecuenciaClaseB = 1;


  //Trae las probabilidades de redes
  $datosRedes = "SELECT * FROM  probabilidad_redes";
  $conexionRedes = mysqli_query($conexion, $datosRedes);

  //Trae las frecuencias de redes
  $datosFrecuenciasRedes = "SELECT * FROM frecuencias_redes";
  $conexionFrecuenciaRedes = mysqli_query($conexion, $datosFrecuenciasRedes);


  //while que recorre todos los valores traidos desde la base de datos
  while ($row = mysqli_fetch_array($conexionRedes)) {
      //Datos provenientes de la Base de datos
      //Datos para comparar el reliability 
      if($row['class'] == 'A' && $row['valor_caracteristica_reliability'] == $reliability):
        $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_reliability'];
      elseif($row['class'] == 'B' && $row['valor_caracteristica_reliability'] == $reliability):
        $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_reliability'];
      endif;

      //Datos para comparar el number of links 
      if ($row['class'] == 'A' && $row['valor_caracteristica_number_of'] == $number_of):
        $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_number_of'];
      elseif($row['class'] == 'B' && $row['valor_caracteristica_number_of'] == $number_of):
        $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_number_of'];
      endif;

      //Datos para comparar el capacity 
      if($row['class'] == 'A' && $row['valor_caracteristica_capacity'] == $capacity):
        $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_capacity'];
      elseif($row['class'] == 'B' && $row['valor_caracteristica_capacity'] == $capacity):
        $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_capacity'];
      endif;

      //Datos para comparar el costo 
      if($row['class'] == 'A' && $row['valor_caracteristica_costo'] == $costo):
        $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_costo'];
      elseif($row['class'] == 'B' && $row['valor_caracteristica_costo'] == $costo):
        $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_costo'];
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
  if(($frecuenciaClaseA * (18/35)) > ($frecuenciaClaseB * (19/35))):
    $redes = 'A';
  else:
    $redes = 'B';
  endif;

  return $redes;//Retorna el valor
}

?>