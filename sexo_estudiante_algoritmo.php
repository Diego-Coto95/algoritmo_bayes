<?php
function metodo_naive_bayes($estilo,$promedio,$recinto){
    
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

    $datosRecinto = "SELECT * FROM  prob_recinto;";
    $conexionRecinto = mysqli_query($conexion, $datosRecinto);

    $frecuenciaMasculino= 1;
    $frecuenciaFemenino = 1;
    
    //Datos para comparar el sexo 
    while ($row = mysqli_fetch_array($conexionRecinto)) {
        if ($row['recinto'] == $recinto && $row['criterio'] == 'M'): 
            $frecuenciaMasculino = $frecuenciaMasculino * $row['probabilidad'];        
        elseif ( $row['recinto'] == $recinto && $row['criterio'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($conexionEstilo)) {
        if ($row['estilo'] == $estilo && $row['criterio'] == 'M'):
            $frecuenciaMasculino = $frecuenciaMasculino * $row['probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['criterio'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($conexionPromedio)) {
        if ($row['promedio'] == $promedio && $row['criterio'] == 'M'):
            $frecuenciaMasculino = $frecuenciaMasculino * $row['probabilidad'];      
        elseif ($row['promedio'] == $promedio &&  $row['criterio'] == 'F'):
            $frecuenciaFemenino = $frecuenciaParaiso * $row['probabilidad'];
        endif;
    }
    
    $sexo = "";
    //Cantidad de registros por recinto para sacar el producto final
    $nMasculino = 64/76;
    $nFemenino = 13/76;
    
    //Producto de frecuencia
    //If que verifica cual es el valor mayor para escoger el recinto
    if(($frecuenciaMasculino * $nMasculino) > ($frecuenciaFemenino * $nFemenino)):
        $sexo='Masculino';
    else:
        $sexo='Femenino';
    endif;
    return $sexo;
}
?>



