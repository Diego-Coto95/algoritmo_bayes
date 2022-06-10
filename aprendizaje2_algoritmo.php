<?php

//Algoritmo que calcula la distancia euclidiana 
function metodo_naive_bayes($recinto,$promedio,$sexo){
  
  //Conexion con la base de datos
  $host = "163.178.107.10";
  $user = "laboratorios";
  $password = "KmZpo.2796";
  $data_base = "if7103_tarea2_b82444";
  $conexion = mysqli_connect($host,$user,$password,$data_base);
  $sql = "SELECT * FROM estiloSexoPromedioRecinto";
  $data_bd = mysqli_query( $conexion, $sql );


  //Instancio los valores por defecto para cada uno de los valores que se requerirán en los cálculos
  //Cuenta la cantidad total de cada uno de los estilos en la base de datos
  $nAsimilador=0; 
  $nAcomodador=0;
  $nConvergente=0;
  $nDivergente=0;

  //Cuenta la cantidad total de cada uno de los sexos en la base de datos
  $nSexoMasculino=0; 
  $nSexoFemenino=0;
  
  //Cuenta la cantidad total de cada uno de los recintos en la base de datos
  $nRecinto=0; 

  $m=3; //Es 3 porque son 3 atributos

  //valores frecuencias
  $ncSexoAsimilador=0; 
  $ncSexoAcomodador=0; 
  $ncSexoConvergente=0; 
  $ncSexoDivergente=0; 

  $ncRecintoAsimilador=0; 
  $ncRecintoAcomodador=0;
  $ncRecintoConvergente=0;
  $ncRecintoDivergente=0;

  $ncPromedioAsimilador=0; 
  $ncPromedioAcomodador=0;
  $ncPromedioConvergente=0; 
  $ncPromedioDivergente=0;  

  $p=1/2; //Porque son 2 sexos F,M
  $pRecinto=1/2; //Porque son 2 recintos
  $pPromedio=1/4; //Se estima un valor en el que se puedan repetir los promedios

  //Bucle para que recorra las columnas que vienen de la base de datos
  while ($row = mysqli_fetch_array( $data_bd )) {

    //Obtiene los valores de los estilos
    if ($row['estilo'] == 'ASIMILADOR'): 
      $nAsimilador++; 
    elseif($row['estilo'] == 'ACOMODADOR'): 
      $nAcomodador++; 
    elseif($row['estilo'] == 'CONVERGENTE'): 
      $nConvergente++;
    elseif($row['estilo'] == 'DIVERGENTE'): 
      $nDivergente++;
    endif; 

    //Obtiene los valores de los sexos
    if ($row['sexo'] == 'M'): 
      $nSexoMasculino++; 
    elseif($row['sexo'] == 'F'): 
      $nSexoFemenino++; 
    endif; 

    //Obtiene los valores de los estilos y sexo
    if($row['sexo'] == $sexo and $row['estilo'] == 'ASIMILADOR'): 
      $ncSexoAsimilador++; 
    elseif($row['sexo'] == $sexo and $row['estilo'] == 'ACOMODADOR'): 
      $ncSexoAcomodador++; 
    elseif($row['sexo'] == $sexo and $row['estilo'] == 'CONVERGENTE'): 
      $ncSexoConvergente++; 
    elseif($row['sexo'] == $sexo and $row['estilo'] == 'DIVERGENTE'): 
      $ncSexoDivergente++;  
    endif; 

    //Obtiene los valores de los estilos y recinto
    if($row['recinto'] == $recinto and $row['estilo'] == 'ASIMILADOR'): 
      $ncRecintoAsimilador++; 
    elseif($row['recinto']==$recinto and $row['estilo'] == 'ACOMODADOR'): 
      $ncRecintoAcomodador++; 
    elseif($row['recinto']==$recinto and $row['estilo'] == 'CONVERGENTE'): 
      $ncRecintoConvergente++; 
    elseif($row['recinto']==$recinto and $row['estilo'] == 'DIVERGENTE'): 
      $ncRecintoDivergente++;  
    endif; 

    //Obtiene los valores de los estilos y promedio
    if ($row['promedio'] == $promedio and $row['estilo'] =='ASIMILADOR'): 
      $ncPromedioAsimilador++; 
    elseif($row['promedio'] == $promedio and $row['estilo'] =='ACOMODADOR'): 
      $ncPromedioAcomodador++; 
    elseif($row['promedio'] == $promedio and $row['estilo'] =='CONVERGENTE'): 
      $ncPromedioConvergente++;
    elseif($row['promedio'] == $promedio and $row['estilo'] =='DIVERGENTE'): 
      $ncPromedioDivergente++; 
    endif; 

  }

  //Suma total de todos los datos en la base de datos
  $sumaTotalDatos = $nAsimilador + $nAcomodador + $nConvergente + $nDivergente; 
  //Probabilidad que el estilo sea Asimilador en todos los datos 
  $probabilidadAsimilador = $nAsimilador / $sumaTotalDatos; 
  //Probabilidad que el estilo sea Acomodador en todos los datos 
  $probabilidadAcomodador = $nAcomodador / $sumaTotalDatos; 
  //Probabilidad que el estilo sea Convergente en todos los datos 
  $probabilidadConvergente = $nConvergente / $sumaTotalDatos; 
  //Probabilidad que el estilo sea Divergente en todos los datos 
  $probabilidadDivergente = $nDivergente / $sumaTotalDatos; 

  //Cálculo de frecuencias Estilo Asimilador 
  $probabilidadFrecuenciaRecintoAsimilador = (($ncRecintoAsimilador + ($m * $pRecinto)) / ($nAsimilador + $m));
  $probabilidadFrecuenciaPromedioAsimilador = (($ncPromedioAsimilador + ($m * $pPromedio)) / ($nAsimilador + $m)); 
  $probabilidadFrecuenciaSexoAsimilador = (($ncSexoAsimilador + ($m * $p)) / ($nAsimilador + $m));
  $total = $probabilidadFrecuenciaSexoAsimilador * $probabilidadFrecuenciaRecintoAsimilador * $probabilidadFrecuenciaPromedioAsimilador; 
  $valorAsimilador = $total * $probabilidadAsimilador; 

  //Cálculo de frecuencias Estilo Acomodador 
  $probabilidadFrecuenciaRecintoAcomodador = (($ncRecintoAcomodador + ($m * $pRecinto)) / ($nAcomodador + $m)); 
  $probabilidadFrecuenciaPromedioAcomodador = (($ncPromedioAcomodador + ($m * $pPromedio)) / ($nAcomodador + $m)); 
  $probabilidadFrecuenciaSexoAcomodador = (($ncSexoAcomodador + ($m * $p)) / ($nAcomodador + $m));
  $total = $probabilidadFrecuenciaSexoAcomodador * $probabilidadFrecuenciaRecintoAcomodador * $probabilidadFrecuenciaPromedioAcomodador; 
  $valorAcomodador = $total * $probabilidadAcomodador; 

  //Cálculo de frecuencias Estilo Convergente 
  $probabilidadFrecuenciaRecintoConvergente = (($ncRecintoConvergente + ($m * $pRecinto)) / ($nConvergente + $m)); 
  $probabilidadFrecuenciaPromedioConvergente = (($ncPromedioConvergente + ($m * $pPromedio)) / ($nConvergente + $m)); 
  $probabilidadFrecuenciaSexoConvergente = (($ncSexoConvergente + ($m * $p)) / ($nConvergente + $m)); 
  $total = $probabilidadFrecuenciaSexoConvergente * $probabilidadFrecuenciaRecintoConvergente * $probabilidadFrecuenciaPromedioConvergente; 
  $valorConvergente = $total * $probabilidadConvergente; 

  //Cálculo de frecuencias Estilo Divergente 
  $probabilidadFrecuenciaRecintoDivergente = (($ncRecintoDivergente + ($m*$pRecinto)) / ($nDivergente + $m)); 
  $probabilidadFrecuenciaPromedioDivergente = (($ncPromedioDivergente + ($m * $pPromedio)) / ($nDivergente + $m)); 
  $probabilidadFrecuenciaSexoDivergente = (($ncSexoDivergente + ($m * $p)) / ($nDivergente + $m)); 
  $total = $probabilidadFrecuenciaSexoDivergente * $probabilidadFrecuenciaRecintoDivergente * $probabilidadFrecuenciaPromedioDivergente; 
  $valorDivergente = $total * $probabilidadDivergente; 

  //Establezco cada uno de los estilos, para que retorne su respectiva salida y muestre el valor del estilo al usuario (output)
  $asimilador = "ASIMILADOR";
  $acomodador = "ACOMODADOR";
  $convergente = "CONVERGENTE"; 
  $divergente ="DIVERGENTE"; 

  //Compara los valores para escoger el mayor de ellos
  if($valorAsimilador > $valorAcomodador && $valorAsimilador > $valorConvergente && $valorAsimilador > $valorDivergente){
    $estilo = $asimilador;
  }
  elseif($valorAcomodador > $valorAsimilador && $valorAcomodador > $valorConvergente && $valorAcomodador > $valorDivergente){
    $estilo = $acomodador; 
  }
  elseif($valorConvergente > $valorAsimilador && $valorConvergente > $valorAcomodador && $valorConvergente > $valorDivergente){
    $estilo = $convergente; 
  }
  else{
    $estilo = $divergente; 
  }

  //Retorna el estilo de la función
  return $estilo;
}
?>