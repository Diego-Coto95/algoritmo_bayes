<?php

function metodo_naive_bayes($a,$b,$c,$d,$e,$f,$g,$h){

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

  //Trae las probabilidades de profesores
  // $profesores = "SELECT * FROM profesores";
  // $conexionProfes = mysqli_query( $conexion, $profesores );

  //Trae las probabilidades de profesores
  $datosProfesores = "SELECT * FROM probabilidad_profesores";
  $conexionProfesores = mysqli_query( $conexion, $datosProfesores );

  //Trae las frecuencias de profesor
  $datosFrecuenciasProfesores = "SELECT * FROM frecuencias_profesores";
  $conexionFrecuenciaProfesores = mysqli_query($conexion, $datosFrecuenciasProfesores);

  $frecuenciaClaseB = 1;
  $frecuenciaClaseI = 1;
  $frecuenciaClaseA = 1;

  while ($row = mysqli_fetch_array($conexionProfesores)) {

    //Datos para comparar el a 
    if($row['class'] == 'Beginner' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_a'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_a'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_a'];
    endif;

    //Datos para comparar el b
    if($row['class'] == 'Beginner' && $row['valor_caracteristica_b'] == $b):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_b'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_b'] == $b):
     $frecuenciaClaseI = $frecuenciaClaseI *  $row['valor_probabilidad_b'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_b'] == $b):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_b'];
    endif;

    //Datos para comparar el c
    if ($row['class'] == 'Beginner'&& $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_c'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_c'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_c'];
    endif;

    //Datos para comparar el d
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_d'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_d'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseA = $frecuenciaClaseA *$row['valor_probabilidad_d'];
    endif;

    //Datos para comparar el e
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_e'];
    elseif( $row['class'] ==' Intermediate' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_e'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_e'];
    endif;

    //Datos para comparar el f
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_f'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_f'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_f'];
    endif;

    //Datos para comparar el g
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_g'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_g'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_g'];
    endif;

    //Datos para comparar el h
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseB = $frecuenciaClaseB * $row['valor_probabilidad_h'];
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseI = $frecuenciaClaseI * $row['valor_probabilidad_h'];
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseA = $frecuenciaClaseA * $row['valor_probabilidad_h'];
    endif;
  } 


  //Bucle que trae las frecuencias ya calculadas de profesores
  while ($row = mysqli_fetch_array($conexionFrecuenciaProfesores)) { 
    //Datos provenientes de la Base de datos
    $nClaseB = $row['nBeginner'];
    $nClaseI = $row['nIntermediate'];
    $nClaseA = $row['nAdvanced'];
  }

  $profesor = "";

  //Producto de frecuencia
  //Compara los totales para establecer cual es el mayor valor
  if(($frecuenciaClaseB * ($nClaseB/20)) > ($frecuenciaClaseI * ($nClaseI/20)) && ($frecuenciaClaseB * ($nClaseB/20)) > ($frecuenciaClaseA * ($nClaseA/20))):
      $profesor = 'BEGINNER';
  elseif(($frecuenciaClaseI * ($nClaseI/20)) > ($frecuenciaClaseA  * ($nClaseA/20))):
      $profesor = 'INTERMEDIATE';
  else:
      $profesor = 'ADVANCED';
  endif;

  return $profesor; //Retorna el valor
}
?>