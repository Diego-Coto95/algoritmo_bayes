<?php

function metodo_naive_bayes($a,$b,$c,$d,$e,$f,$g,$h){

  //Conexión a la base de datos MySql
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b82444";
  $conexion = mysqli_connect($host,$user,$password,$data_base);

  //Trae las probabilidades de profesores
  // $profesores = "SELECT * FROM profesores";
  // $conexionProfes = mysqli_query( $conexion, $profesores );

  //Trae las probabilidades de profesores
  $datosProfesores = "SELECT * FROM probabilidad_profesores";
  $conexionProfesores = mysqli_query( $conexion, $datosProfesores );

  //Trae las frecuencias de profesor
  $datosFrecuenciasProfesores = "SELECT * FROM frecuencias_sexo";
  $conexionFrecuenciaProfesores = mysqli_query($conexion, $datosFrecuenciasProfesores);

  $frecuenciaClaseB = 1;
  $frecuenciaClaseI = 1;
  $frecuenciaClaseA = 1;

  while ($row = mysqli_fetch_array($conexionProfesores)) {
    $datoA = $row['a'];
    $datoB = $row['b'];
    $datoC = $row['c'];
    $datoD = $row['d'];
    $datoE = $row['e'];
    $datoF = $row['f'];
    $datoG = $row['g'];
    $datoH = $row['h'];

    //Datos para comparar el a 
    if($row['class'] == 'Beginner' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoA;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseI = $frecuenciaClaseI *  $datoA;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_a'] == $a):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoA;
    endif;

    //Datos para comparar el b
    if($row['class'] == 'Beginner' && $row['valor_caracteristica_b'] == $b):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoB;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_b'] == $b):
     $frecuenciaClaseI = $frecuenciaClaseI *  $datoB;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_b'] == $b):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoB;
    endif;

    //Datos para comparar el c
    if ($row['class'] == 'Beginner'&& $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoC;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoC;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_c'] == $c):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoC;
    endif;

    //Datos para comparar el d
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoD;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoD;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_d'] == $d):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoD;
    endif;

    //Datos para comparar el e
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoE;
    elseif( $row['class'] ==' Intermediate' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoE;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_e'] == $e):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoE;
    endif;

    //Datos para comparar el f
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoF;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoF;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_f'] == $f):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoF;
    endif;

    //Datos para comparar el g
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoG;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoG;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_g'] == $g):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoG;
    endif;

    //Datos para comparar el h
    if ($row['class'] == 'Beginner' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoH;
    elseif($row['class'] == 'Intermediate' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoH;
    elseif($row['class'] == 'Advanced' && $row['valor_caracteristica_h'] == $h):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoH;
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
  if(($frecuenciaClaseB * $nClaseB) > ($frecuenciaClaseI * $nClaseI) && ($frecuenciaClaseB * $nClaseB) > ($frecuenciaClaseA * $nClaseA)):
      $profesor = 'BEGINNER';
  elseif(($frecuenciaClaseI * $nClaseI) > ($frecuenciaClaseA  *$nClaseA)):
      $profesor = 'INTERMEDIATE';
  else:
      $profesor = 'ADVANCED';
  endif;

  return $profesor; //Retorna el valor
}
?>