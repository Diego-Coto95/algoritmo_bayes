<?php
function metodo_naive_bayes($recinto,$promedio,$sexo){
  //Conexion con la base de datos
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b72204";
  //$data_base = "if7103_tarea2_b82444";
  
  $conexion = mysqli_connect($host,$user,$password,$data_base);

  $datosSexo = "SELECT * FROM  prob_sexo;";
  $conexionSexo = mysqli_query($conexion, $datosSexo);

  $datosPromedio = "SELECT * FROM  prob_promedio;";
  $conexionPromedio = mysqli_query($conexion, $datosPromedio);

  $datosRecinto = "SELECT * FROM  prob_recinto;";
  $conexionRecinto = mysqli_query($conexion, $datosRecinto);

  $frecuenciaAcomodador= 1;
  $frecuenciaAsimilador = 1;
  $frecuenciaConvergente = 1;
  $frecuenciaDivergente = 1;
  

  while ($row = mysqli_fetch_array($conexionSexo)) {       
    if ($row['sexo'] == $sexo && $row['criterio'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['criterio'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['criterio'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['probabilidad'];
    elseif ($row['sexo'] == $sexo && $row['criterio'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['probabilidad'];
    endif;        
  }
  while ($row = mysqli_fetch_array($conexionPromedio)) {     
    if ($row['promedio'] == $promedio && $row['criterio'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['criterio'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['criterio'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['probabilidad'];
    elseif ($row['promedio'] == $promedio && $row['criterio'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['probabilidad'];
    endif; 
  }
  while ($row = mysqli_fetch_array($conexionRecinto)) {     
    if ($row['recinto'] == $recinto && $row['criterio'] == 'ACOMODADOR'):
      $frecuenciaAcomodador = $frecuenciaAcomodador * $row['probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['criterio'] == 'ASIMILADOR'):
      $frecuenciaAsimilador = $frecuenciaAsimilador * $row['probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['criterio'] == 'CONVERGENTE'):
      $frecuenciaConvergente = $frecuenciaConvergente * $row['probabilidad'];
    elseif ($row['recinto'] == $recinto && $row['criterio'] == 'DIVERGENTE'):
      $frecuenciaDivergente = $frecuenciaDivergente * $row['probabilidad'];
    endif; 
  }
  
  $estilo = "";
  //Cantidad de registros por recinto para sacar el producto final
  $nAcomodador =14/76;
  $nAsimilador = 21/76;
  $nConvergente = 21/76;
  $nDivergente = 21/76;

  
  //Producto de frecuencia
  //If que verifica cual es el valor mayor para escoger el estilo de aprendizaje
  if ((($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaAsimilador * $nAsimilador)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'ACOMODADOR';
  elseif ((($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'ASIMILADOR';
  elseif((($frecuenciaConvergente * $nConvergente) > ($frecuenciaDivergente * $nDivergente))):
    $estilo = 'CONVERGENTE';
  else:
    $estilo = 'DIVERGENTE';
  endif;
  return $estilo;
}
?>