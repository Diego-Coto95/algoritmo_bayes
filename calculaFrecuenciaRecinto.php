<?php

function insertaFrecuenciaRecinto(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $m = 3;
    $nParariso = 0;
    $nTurrialba = 0;
    $ncSexo = 0;
    $ncEstilo = 0;
    $ncPromedio = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        
        //Suma los valores de cada uno de los recintos (n)
        if($row['recinto'] == "Paraiso"): 
            $nParariso++; 
        endif;
        if($row['recinto'] == "Turrialba"): 
            $nTurrialba++;
        endif;

        //Llena en el array y va contando que no hayan datos repetidos
        $ncSexo = count(array_unique[$row['sexo']]);
        $ncEstilo = count(array_unique[$row['estilo']]);
        $ncPromedio = count(array_unique[$row['promedio']]);
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    $sql = "INSERT INTO frecuencias_recinto (m,nParariso,nTurrialba,
                        ncSexo,ncEstilo,ncPromedio)
            VALUES (m,nParariso,nTurrialba,
                    ncSexo,ncEstilo,ncPromedio)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>