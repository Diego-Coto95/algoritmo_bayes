<?php

function metodo_naive_bayes($a,$b,$c,$d,$e,$f,$g,$h){

  
  //Conexión a la base de datos MySql
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b72204";
  //$data_base = "if7103_tarea2_b82444";
  $conexion = mysqli_connect($host,$user,$password,$data_base);
  $datosProfesores = "SELECT * FROM prob_profesores"; //Trae los datos requeridos de la base de datos y se guardan en la variable $sql
  $conexionProfesores = mysqli_query( $conexion, $datosProfesores );

  $frecuenciaClaseB = 1;
  $frecuenciaClaseI = 1;
  $frecuenciaClaseA = 1;

  while ($row = mysqli_fetch_array($conexionProfesores)) {
    //Variables que guardan los valores traidos de la base de datos
    $datoA = $row['a'];
    $datoB = $row['b'];
    $datoC = $row['c'];
    $datoD = $row['d'];
    $datoE = $row['e'];
    $datoF = $row['f'];
    $datoG = $row['g'];
    $datoH = $row['h'];

    if($row['class'] == 'Beginner' && $row['crit_a'] == $a):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoA;
    elseif($row['class'] == 'Intermediate' && $row['crit_a'] == $a):
      $frecuenciaClaseI = $frecuenciaClaseI *  $datoA;
    elseif($row['class'] == 'Advanced' && $row['crit_a'] == $a):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoA;
    endif;

    if($row['class'] == 'Beginner' && $row['crit_b'] == $b):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoB;
    elseif($row['class'] == 'Intermediate' && $row['crit_b'] == $b):
     $frecuenciaClaseI = $frecuenciaClaseI *  $datoB;
    elseif($row['class'] == 'Advanced' && $row['crit_b'] == $b):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoB;
    endif;

    if ($row['class'] == 'Beginner'&& $row['crit_c'] == $c):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoC;
    elseif($row['class'] == 'Intermediate' && $row['crit_c'] == $c):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoC;
    elseif($row['class'] == 'Advanced' && $row['crit_c'] == $c):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoC;
    endif;

    if ($row['class'] == 'Beginner' && $row['crit_d'] == $d):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoD;
    elseif($row['class'] == 'Intermediate' && $row['crit_d'] == $d):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoD;
    elseif($row['class'] == 'Advanced' && $row['crit_d'] == $d):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoD;
    endif;

    if ($row['class'] == 'Beginner' && $row['crit_e'] == $e):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoE;
    elseif( $row['class'] ==' Intermediate' && $row['crit_e'] == $e):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoE;
    elseif($row['class'] == 'Advanced' && $row['crit_e'] == $e):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoE;
    endif;

    if ($row['class'] == 'Beginner' && $row['crit_f'] == $f):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoF;
    elseif($row['class'] == 'Intermediate' && $row['crit_f'] == $f):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoF;
    elseif($row['class'] == 'Advanced' && $row['crit_f'] == $f):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoF;
    endif;

    if ($row['class'] == 'Beginner' && $row['crit_g'] == $g):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoG;
    elseif($row['class'] == 'Intermediate' && $row['crit_g'] == $g):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoG;
    elseif($row['class'] == 'Advanced' && $row['crit_g'] == $g):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoG;
    endif;

    if ($row['class'] == 'Beginner' && $row['crit_h'] == $h):
      $frecuenciaClaseB = $frecuenciaClaseB * $datoH;
    elseif($row['class'] == 'Intermediate' && $row['crit_h'] == $h):
      $frecuenciaClaseI = $frecuenciaClaseI * $datoH;
    elseif($row['class'] == 'Advanced' && $row['crit_h'] == $h):
      $frecuenciaClaseA = $frecuenciaClaseA * $datoH;
    endif;
  } 

  $profesor = "";
  $nClaseB = 9/20;
  $nClaseI = 6/20;
  $nClaseA = 5/20;

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