<?php

function insertaFrecuenciaProfesores(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM profesores";

    $m = 8;
    $nBeginner = 0;
    $nIntermediate = 0;
    $nAdvanced = 0;
    $ncA = 0;
    $ncB = 0;
    $ncC = 0;
    $ncD = 0;
    $ncE = 0;
    $ncF = 0;
    $ncG = 0;
    $ncH = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        
        //Suma los valores de cada uno de los profesores (n)
        if($row['class'] == "Beginner"): 
            $nBeginner++; 
        endif;
        if($row['class'] == "Intermediate"): 
            $nIntermediate++;
        endif;
        if($row['class'] == "Advanced"): 
            $nAdvanced++;
        endif;

        //Llena en el array y va contando que no hayan datos repetidos
        $ncA = count(array_unique[$row['A']]);
        $ncB = count(array_unique[$row['B']]);
        $ncC = count(array_unique[$row['C']]);
        $ncD = count(array_unique[$row['D']]);
        $ncE = count(array_unique[$row['E']]);
        $ncF = count(array_unique[$row['F']]);
        $ncG = count(array_unique[$row['G']]);
        $ncH = count(array_unique[$row['H']]);
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    $sql = "INSERT INTO frecuencias_profesores (m,nBeginner,nIntermediate,
                        nAdvanced,ncA,ncB,ncC,ncD,ncE,ncF,ncG,ncH)
            VALUES (m,nBeginner,nIntermediate,
                    nAdvanced,ncA,ncB,ncC,ncD,ncE,ncF,ncG,ncH)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>