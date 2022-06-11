<?php

function insertaFrecuenciaEstilo(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM recintoEstilo";

    $m = 4;
    $nAcomodador = 0;
    $nAsimilador = 0;
    $nConvergente = 0;
    $nDivergente = 0;
    $ncCa = 0;
    $ncEc = 0;
    $ncEa = 0;
    $ncOr = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        
        //Suma los valores de cada uno de los estilos (n)
        if($row['estilo'] == "ACOMODADOR"): 
            $nAcomodador++; 
        endif;
        if($row['estilo'] == "ASIMILADOR"): 
            $nAsimilador++;
        endif;
        if($row['estilo'] == "CONVERGENTE"): 
            $nConvergente++; 
        endif;
        if($row['estilo'] == "DIVERGENTE"): 
            $nDivergente++;
        endif;

        //Llena en el array y va contando que no hayan datos repetidos
        $ncCa = count(array_unique[$row['ca']]);
        $ncEc = count(array_unique[$row['ec']]);
        $ncEa = count(array_unique[$row['ea']]);
        $ncOr = count(array_unique[$row['or_']]);
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    $sql = "INSERT INTO frecuencias_estilo1 (m,nAcomodador,nAsimilador,
                        nConvergente,nDivergente,ncCa,ncEc,ncEa,ncOr)
            VALUES (m,nAcomodador,nAsimilador,
                    nConvergente,nDivergente,ncCa,ncEc,ncEa,ncOr)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>