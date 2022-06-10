<?php
function metodo_naive_bayes($estilo,$promedio,$recinto){
    
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b72204";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sqlEstilo = "SELECT * FROM  prob_estilo;";
    $queryEstilo = mysqli_query($conexion, $sqlEstilo);
    $sqlPromedio = "SELECT * FROM  prob_promedio;";
    $queryPromedio = mysqli_query($conexion, $sqlPromedio);
    $sqlRecinto = "SELECT * FROM  prob_recinto;";
    $queryRecinto = mysqli_query($conexion, $sqlRecinto);
    $frecuenciaMasculino= 1;
    $frecuenciaFemenino = 1;
    

    //Datos para comparar el sexo 
    while ($row = mysqli_fetch_array($queryRecinto)) {
        if ($row['recinto'] == $recinto && $row['criterio'] == 'M'): 
            $frecuenciaMasculino = $frecuenciaMasculino * $row['probabilidad'];        
        elseif ( $row['recinto'] == $recinto && $row['criterio'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($queryEstilo)) {
        if ($row['estilo'] == $estilo && $row['criterio'] == 'M'):
            $frecuenciaMasculino = $frecuenciaMasculino * $row['probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['criterio'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($queryPromedio)) {
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
    if (($frecuenciaMasculino * $nMasculino) > ($frecuenciaFemenino * $nFemenino)) {
        $sexo='Masculino';
    } else {
        $sexo='Femenino';
    };
    return $sexo;
}
?>



