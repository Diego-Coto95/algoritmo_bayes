<?php
function metodo_naive_bayes1($estilo,$promedio,$sexo){
    
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
    $sqlSexo = "SELECT * FROM  prob_sexo;";
    $querySexo = mysqli_query($conexion, $sqlSexo);
    $frecuenciaParaiso = 1;
    $frecuenciaTurrialba = 1;
    

    //Datos para comparar el sexo 
    while ($row = mysqli_fetch_array($querySexo)) {
        //sentencias if para escoger las frecuencias de cada variable y
        //almacenarlas en una variable para calcular el producto de las frecuencias
        if ($row['sexo'] == $sexo && $row['criterio'] == 'Turrialba'): 
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['probabilidad'];        
        elseif ( $row['sexo'] == $sexo && $row['criterio'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['probabilidad'];
        endif;
    }

    //Datos para comparar el estilo 
    while ($row = mysqli_fetch_array($queryEstilo)) {
        if ($row['estilo'] == $estilo && $row['criterio'] == 'Turrialba'):
            $frecuenciaTurrialba = $frecuenciaTurrialba * $row['probabilidad'];
        elseif ($row['estilo'] == $estilo && $row['criterio'] == 'Paraiso'):
            $frecuenciaParaiso = $frecuenciaParaiso * $row['probabilidad'];
        endif;        
    }

    //Datos para comparar el promedio 
    while ($row = mysqli_fetch_array($queryPromedio)) {
        //sentencias if para escoger las frecuencias de cada variable y
        //almacenarlas en una variable para calcular el producto de las frecuencias  
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
    //If que verifica cual es el valor mayor para escoger el recinto
    if (($frecuenciaTurrialba * $nTurrialba) > ($frecuenciaParaiso * $nParaiso)) {
        $recinto='Turrialba';
    } else {
        $recinto='Paraiso';
    };
    return $recinto;
}

?>
