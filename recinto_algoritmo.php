<?php
function metodo_naive_bayes($estilo,$promedio,$sexo){
    
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b72204";
    //$data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $datosEstilo = "SELECT * FROM  prob_estilo;";
    $conexionEstilo = mysqli_query($conexion, $datosEstilo);

    $datosPromedio = "SELECT * FROM  prob_promedio;";
    $conexionPromedio = mysqli_query($conexion, $datosPromedio);

    $datosSexo = "SELECT * FROM  prob_sexo;";
    $conexionSexo = mysqli_query($conexion, $datosSexo);

    $frecuenciaParaiso = 1;
    $frecuenciaTurrialba = 1;
    

    //Datos para comparar el sexo 
    while ($row = mysqli_fetch_array($conexionSexo)) {
        if ($row['sexo'] == $sexo && $row['criterio'] == 'Turrialba'): 
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['probabilidad'];        
        elseif ( $row['sexo'] == $sexo && $row['criterio'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($conexionEstilo)) {
        if ($row['estilo'] == $estilo && $row['criterio'] == 'Turrialba'):
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['criterio'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($conexionPromedio)) {
        if ($row['promedio'] == $promedio && $row['criterio'] == 'Turrialba'):
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['probabilidad'];      
        elseif ($row['promedio'] == $promedio &&  $row['criterio'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['probabilidad'];
        endif;
    }
    
    $recinto = "";
    //Cantidad de registros por recinto para sacar el producto final
    $nTurrialba = 38/76;
    $nParaiso = 38/76;
    
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
