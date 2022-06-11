<?php 

function metodo_naive_bayes($reliability,$number_of,$capacity,$costo){
  
  $frecuenciaClaseA = 1;
  $frecuenciaClaseB = 1;

  //Conexión a la base de datos MySql
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b72204";
  //$data_base = "if7103_tarea2_b82444";
  
  $conexion = mysqli_connect($host,$user,$password,$data_base);

  $datosRedes = "SELECT * FROM  prob_redes";
  $conexionRedes = mysqli_query($connection, $datosRedes);

  //while que recorre todos los valores traidos desde la base de datos
  while ($row = mysqli_fetch_array($conexionRedes)) {
      //Datos provenientes de la Base de datos
      $datoReliability = $row['reliability'];
      $datoNumero = $row['number_of_links'];
      $datoCapacity = $row['capacity'];
      $datoCosto = $row['costo'];

      if($row['class'] == 'A' && $row['crit_reliability'] == $reliability):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoReliability;
      elseif($row['class'] == 'B' && $row['crit_reliability'] == $reliability):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoReliability;
      endif;
      if ($row['class'] == 'A' && $row['crit_number_of_links'] == $number_of):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoNumero;
      elseif($row['class'] == 'B' && $row['number_of_links'] == $number_of):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoNumero;
      endif;
      if($row['class'] == 'A' && $row['crit_capacity'] == $capacity):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoCapacity;
      elseif($row['class'] == 'B' && $row['crit_capacity'] == $capacity):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoCapacity;
      endif;
      if($row['class'] == 'A' && $row['costo'] == $costo):
        $frecuenciaClaseA = $frecuenciaClaseA * $datoCosto;
      elseif($row['class'] == 'B' && $row['costo'] == $costo):
        $frecuenciaClaseB = $frecuenciaClaseB * $datoCosto;
      endif;        
  }

  $redes = "";
  $nClaseA = 18/35;
  $nClaseB = 19/35;


  if(($frecuenciaClaseA * $nClaseA) > ($frecuenciaClaseB * $nClaseB)):
      $redes = 'A';
  else:
      $redes = 'B';
  endif;
  return $redes;
}

?>