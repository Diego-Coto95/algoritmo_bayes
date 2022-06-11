<?php

function insertaFrecuenciaRedes(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM redes";

    $m = 4;
    $nClaseA = 0;
    $nClaseB = 0;
    $ncReliability = 0;
    $ncLinks = 0;
    $ncCapacity = 0;
    $ncCosto = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        
        //Suma los valores de cada uno de los redes (n)
        if($row['class'] == "A"): 
            $nClaseA++; 
        endif;
        if($row['class'] == "B"): 
            $nClaseB++;
        endif;


        //Llena en el array y va contando que no hayan datos repetidos
        $ncReliability = count(array_unique[$row['reliability']]);
        $ncLinks = count(array_unique[$row['number_of']]);
        $ncCapacity = count(array_unique[$row['capacity']]);
        $ncCosto = count(array_unique[$row['costo']]);
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    $sql = "INSERT INTO frecuencias_redes (m,nClaseA,nClaseB,
                        ncReliability,ncLinks,ncCapacity,ncCosto)
            VALUES (m,nClaseA,nClaseB,
                        ncReliability,ncLinks,ncCapacity,ncCosto)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>