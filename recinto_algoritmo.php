<?php
function metodo_naive_bayes($estilo,$promedio,$sexo){
    
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    //Trae las valor_probabilidades de estilo2
    $datosEstilo = "SELECT * FROM  probabilidad_estilo2";
    $conexionEstilo = mysqli_query($conexion, $datosEstilo);

    //Trae las valor_probabilidades de promedio
    $datosPromedio = "SELECT * FROM  probabilidad_promedio";
    $conexionPromedio = mysqli_query($conexion, $datosPromedio);

    //Trae las valor_probabilidades de sexo
    $datosSexo = "SELECT * FROM  probabilidad_sexo";
    $conexionSexo = mysqli_query($conexion, $datosSexo);

    //Trae las frecuencias de recinto
    $datosFrecuenciasRecinto = "SELECT * FROM frecuencias_recinto";
    $conexionFrecuenciaRecinto = mysqli_query($conexion, $datosFrecuenciasRecinto);

    $frecuenciaParaiso = 1;
    $frecuenciaTurrialba = 1;
    

    //Datos para comparar el sexo 
    while ($row = mysqli_fetch_array($conexionSexo)) {
        if ($row['sexo'] == $sexo && $row['valor_caracteristica'] == 'Turrialba'): 
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['valor_probabilidad'];        
        elseif ( $row['sexo'] == $sexo && $row['valor_caracteristica'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['valor_probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($conexionEstilo)) {
        if ($row['estilo'] == $estilo && $row['valor_caracteristica'] == 'Turrialba'):
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['valor_probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['valor_caracteristica'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['valor_probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($conexionPromedio)) {
        if ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'Turrialba'):
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['valor_probabilidad'];      
        elseif ($row['promedio'] == $promedio &&  $row['valor_caracteristica'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['valor_probabilidad'];
        endif;
    }
    
    //Bucle que trae las frecuencias ya calculadas de recinto
    while ($row = mysqli_fetch_array($conexionFrecuenciaRecinto)) { 
        //Datos provenientes de la Base de datos
        $nParaiso = $row['nParaiso'];
        $nTurrialba = $row['nTurrialba'];
    }

    $recinto = "";

    //Producto de frecuencia
    //Compara los totales para establecer cual es el mayor valor
    if(($frecuenciaTurrialba * $nTurrialba) > ($frecuenciaParaiso * $nParaiso)):
        $recinto='Turrialba';
    else:
        $recinto='Paraiso';
    endif;

    return $recinto;//Retorna el valor
}

?>
