<?php
function metodo_naive_bayes($recinto,$promedio,$sexo){
  //Conexion con la base de datos
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b82444";
  $conexion = mysqli_connect($host,$user,$password,$data_base);

  //Trae las valor_probabilidades de sexo
  $datosSexo = "SELECT * FROM  probabilidad_sexo";
  $conexionSexo = mysqli_query($conexion, $datosSexo);

  //Trae las valor_probabilidades de promedio
  $datosPromedio = "SELECT * FROM  probabilidad_promedio";
  $conexionPromedio = mysqli_query($conexion, $datosPromedio);

  //Trae las valor_probabilidades de recinto
  $datosRecinto = "SELECT * FROM  probabilidad_recinto";
  $conexionRecinto = mysqli_query($conexion, $datosRecinto);

  //Trae las frecuencias de estilo2
  $datosFrecuenciasEsilo2 = "SELECT * FROM frecuencias_estilo2";
  $conexionFrecuenciaEsilo2 = mysqli_query($conexion, $datosFrecuenciasEsilo2);

  $frecuenciaAcomodador= 1;
  $frecuenciaAsimilador = 1;
  $frecuenciaConvergente = 1;
  $frecuenciaDivergente = 1;
  
  //Datos para comparar el sexo 
  while ($row = mysqli_fetch_array($conexionSexo)) {       
    if ($row['sexo'] == $sexo && $row['valor_caracteristica'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['valor_probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['valor_caracteristica'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['valor_probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['valor_caracteristica'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['valor_probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['valor_caracteristica'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['valor_probabilidad'];
    endif;        
  }

  //Datos para comparar el promedio 
  while ($row = mysqli_fetch_array($conexionPromedio)) {     
    if ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['valor_probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['valor_probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['valor_probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['valor_probabilidad'];
    endif; 
  }

  //Datos para comparar el recinto 
  while ($row = mysqli_fetch_array($conexionRecinto)) {     
    if ($row['recinto'] == $recinto && $row['valor_caracteristica'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['valor_probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['valor_caracteristica'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['valor_probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['valor_caracteristica'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['valor_probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['valor_caracteristica'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['valor_probabilidad'];
    endif; 
  }
  
  //Bucle que trae las frecuencias ya calculadas de estilo2
  while ($row = mysqli_fetch_array($conexionFrecuenciaEsilo2)) { 
    //Datos provenientes de la Base de datos
    $nAcomodador = $row['nAcomodador'];
    $nAsimilador = $row['nAsimilador'];
    $nConvergente = $row['nConvergente'];
    $nDivergente = $row['nDivergente'];
  }

  $estilo = "";
  
  //Producto de frecuencia
  //Compara los totales para establecer cual es el mayor valor
  if ((($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaAsimilador * $nAsimilador)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'ACOMODADOR';
  elseif ((($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'ASIMILADOR';
  elseif((($frecuenciaConvergente * $nConvergente) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'CONVERGENTE';
  else:
    $estilo = 'DIVERGENTE';
  endif;

  return $estilo;//Retorna el valor
}
?>