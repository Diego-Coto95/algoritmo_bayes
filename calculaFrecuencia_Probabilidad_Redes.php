<?php

function insertaFrecuenciaRedes(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
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

function insertaProbabilidadRedes(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $sql = "SELECT * FROM redes";

    $frecuencias_redes = "SELECT * FROM frecuencias_redes";


    
    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    //Trae las frecuencias para luego sacar las probabilidades
    while ($row = mysqli_fetch_array( $frecuencias_redes )) {
        $m = $row['m'];
        $nClaseA = $row['nClaseA'];
        $nClaseB = $row['nClaseB'];
        $ncReliability = $row['ncReliability'];
        $ncLinks = $row['ncLinks'];
        $ncCapacity = $row['ncCapacity'];
        $ncCosto = $row['ncCosto'];
    }

    $valor_caracteristica_reliability = 0;
    $valor_probabilidad_reliability = 0;
    $valor_caracteristica_number_of = 0;
    $valor_probabilidad_number_of = 0;
    $valor_caracteristica_capacity = 0;
    $valor_probabilidad_capacity = 0;
    $valor_caracteristica_costo = 0;
    $valor_probabilidad_costo = 0;
    $class = "";


    $countR = 0;
    $countN = 0;
    $countCa = 0;
    $countCo = 0;

    while ($row = mysqli_fetch_array( $frecuencias_redes )) {
        //Cuenta las veces que esta una columna filtrado por recinto
        if($row['reliability']):
            $countR++;
        endif;
        if($row['number_of'] ):
            $countN++;
        endif;
        if($row['capacity']):
            $countCa++;
        endif;
        if($row['costo'] ):
            $countCo++;
        endif;
    }

    while ($row = mysqli_fetch_array( $sql )) {
        foreach (range(2, 5) as $valor_caracteristica) {
            if($row['reliability'] && $row['class'] == "A"):
                $valor_caracteristica_reliability = "Paraiso";
                $valor_probabilidad = (($countR + ($m * (1/$ncReliability))) / ($nClaseA + $m));
                $class = "A";
            endif;

            if($row['reliability'] && $row['class'] == "B"):
                $valor_caracteristica_reliability = "Paraiso";
                $valor_probabilidad = (($countR + ($m * (1/$ncReliability))) / ($nClaseB + $m));
                $class = "B";
            endif;

            if($row['number_of'] && $row['class'] == "A"):
                $valor_caracteristica_number_of = "Turrialba";
                $valor_probabilidad = (($countN + ($m * (1/$ncLinks))) / ($nClaseA + $m));
                $class = "A";
            endif;

            if($row['number_of'] && $row['class'] == "B"):
                $valor_caracteristica_number_of = "Turrialba";
                $valor_probabilidad = (($countN + ($m * (1/$ncLinks))) / ($nClaseB + $m));
                $class = "B";
            endif;

            if($row['capacity'] && $row['class'] == "A"):
                $valor_caracteristica_capacity = "Paraiso";
                $valor_probabilidad = (($countCa + ($m * (1/$ncCapacity))) / ($nClaseA + $m));
                $class = "A";
            endif;

            if($row['capacity'] && $row['class'] == "B"):
                $valor_caracteristica_capacity = "Turrialba";
                $valor_probabilidad = (($countCa + ($m * (1/$ncCapacity))) / ($nClaseB + $m));
                $class = "B";
            endif;

            if($row['costo'] && $row['class'] == "A"):
                $valor_caracteristica_costo = "Paraiso";
                $valor_probabilidad = (($countCo + ($m * (1/$ncCosto))) / ($nClaseA + $m));
                $class = "A";
            endif;

            if($row['costo'] && $row['class'] == "B"):
                $valor_caracteristica_costo = "Turrialba";
                $valor_probabilidad = (($countCo + ($m * (1/$ncCosto))) / ($nClaseB + $m));
                $class = "B";
            endif;

            $sqlInsertar = "INSERT INTO probabilidad_redes (
                valor_caracteristica_reliability,
                valor_probabilidad_reliability,
                valor_caracteristica_number_of,
                valor_probabilidad_number_of,
                valor_caracteristica_capacity,
                valor_probabilidad_capacity,
                valor_caracteristica_costo,
                valor_probabilidad_costo,
                class
                )
                VALUES (
                    valor_caracteristica_reliability,
                    valor_probabilidad_reliability,
                    valor_caracteristica_number_of,
                    valor_probabilidad_number_of,
                    valor_caracteristica_capacity,
                    valor_probabilidad_capacity,
                    valor_caracteristica_costo,
                    valor_probabilidad_costo,
                    class
                    )";
        }

        
    } 
    
    mysqli_close($conn);
}

?>