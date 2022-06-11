<?php

function insertaFrecuenciaSexo(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $m = 3;
    $nM = 0;
    $nF = 0;
    $ncEstilo = 0;
    $ncRecinto = 0;
    $ncPromedio = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        
        //Suma los valores de cada uno de los sexos (n)
        if($row['sexo'] == "M"): 
            $nM++; 
        endif;
        if($row['sexo'] == "F"): 
            $nF++;
        endif;

        //Llena en el array y va contando que no hayan datos repetidos
        $ncEstilo = count(array_unique[$row['estilo']]);
        $ncRecinto = count(array_unique[$row['recinto']]);
        $ncPromedio = count(array_unique[$row['promedio']]);
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    $sql = "INSERT INTO frecuencias_sexo (m,nM,nF,
                        ncEstilo,ncRecinto,ncPromedio)
            VALUES (m,nParariso,nTurrialba,
                    ncEstilo,ncRecinto,ncPromedio)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>