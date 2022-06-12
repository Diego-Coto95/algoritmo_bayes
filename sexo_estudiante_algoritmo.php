<?php
function metodo_naive_bayes($estilo,$promedio,$recinto){
    
    //Conexión a la base de datos MySql
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    //Trae las probabilidades de estilo2
    $datosEstilo = "SELECT * FROM  probabilidad_estilo2";
    $conexionEstilo = mysqli_query($conexion, $datosEstilo);

    //Trae las probabilidades de promedio
    $datosPromedio = "SELECT * FROM  probabilidad_promedio";
    $conexionPromedio = mysqli_query($conexion, $datosPromedio);

    //Trae las probabilidades de recinto
    $datosRecinto = "SELECT * FROM  probabilidad_recinto";
    $conexionRecinto = mysqli_query($conexion, $datosRecinto);

    //Trae las frecuencias de sexo
    $datosFrecuenciasSexo = "SELECT * FROM frecuencias_sexo";
    $conexionFrecuenciaSexo = mysqli_query($conexion, $datosFrecuenciasSexo);

    $frecuenciaMasculino = 1;
    $frecuenciaFemenino = 1;
    
    //Datos para comparar el recinto 
    while ($row = mysqli_fetch_array($conexionRecinto)) {
        if ($row['recinto'] == $recinto && $row['valor_caracteristica'] == 'M'): 
            $frecuenciaMasculino = $frecuenciaMasculino * $row['valor_probabilidad'];        
        elseif ( $row['recinto'] == $recinto && $row['valor_caracteristica'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['valor_probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($conexionEstilo)) {
        if ($row['estilo'] == $estilo && $row['valor_caracteristica'] == 'M'):
            $frecuenciaMasculino = $frecuenciaMasculino * $row['valor_probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['valor_caracteristica'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['valor_probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($conexionPromedio)) {
        if ($row['promedio'] == $promedio && $row['valor_caracteristica'] == 'M'):
            $frecuenciaMasculino = $frecuenciaMasculino * $row['valor_probabilidad'];      
        elseif ($row['promedio'] == $promedio &&  $row['valor_caracteristica'] == 'F'):
            $frecuenciaFemenino = $frecuenciaFemenino * $row['valor_probabilidad'];
        endif;
    }
    
    
    //Bucle que trae las frecuencias ya calculadas de sexo
    while ($row = mysqli_fetch_array($conexionFrecuenciaSexo)) { 
        //Datos provenientes de la Base de datos
        $nMasculino = $row['nM'];
        $nFemenino = $row['nF'];
    }
    
    $sexo = "";

    $totalMasculino = $frecuenciaMasculino * ($nMasculino/77);
    $totalFemenino = $frecuenciaFemenino * ($nFemenino/77);
    //Producto de frecuencia
    //Compara los totales para establecer cual es el mayor valor
    if($totalMasculino > $totalFemenino):
        $sexo='Masculino';
    else:
        $sexo='Femenino';
    endif;

    return $sexo;//Retorna el valor
}
?>



