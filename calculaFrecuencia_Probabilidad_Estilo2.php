<?php

function insertaFrecuenciaEstilo2(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $m = 3;
    $nAcomodador = 0;
    $nAsimilador = 0;
    $nConvergente = 0;
    $nDivergente = 0;
    $ncSexo = 0;
    $ncRecinto = 0;
    $ncPromedio = 0;

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
        $ncSexo = count(array_unique[$row['sexo']]);
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

    $sql = "INSERT INTO frecuencias_estilo2 (m,nAcomodador,nAsimilador,nConvergente,nDivergente,
                        ncSexo,ncRecinto,ncPromedio)
            VALUES (m,nParariso,nTurrialba,
                    ncEstilo,ncRecinto,ncPromedio)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

}

function insertaProbabilidadEstilo(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $frecuencias_sexo = "SELECT * FROM frecuencias_estilo2";


    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    //Trae las frecuencias para luego sacar las probabilidades
    while ($row = mysqli_fetch_array( $frecuencias_estilo2 )) {
        $m = $row['m'];
        $nAcomodador = $row['nAcomodador'];
        $nAsimilador = $row['nAsimilador'];
        $nConvergente = $row['nConvergente'];
        $nDivergente = $row['nDivergente'];
        $ncSexo = $row['ncSexo'];
        $ncRecinto = $row['ncRecinto'];
        $ncPromedio = $row['ncPromedio'];
    }

    $sexo = "";
    $valor_probabilidad = 0;
    $valor_caracteristica = "";

    $countP = 0;
    $countT = 0;
    $countM = 0;
    $countF = 0;


    while ($row = mysqli_fetch_array( $frecuencias_recinto )) {
        //Cuenta las veces que esta una columna filtrado por recinto
        if($row['recinto'] == "Paraiso"):
            $countP++;
        endif;
        if($row['recinto'] == "Turrialba"):
            $countT++;
        endif;
        if($row['sexo'] == "F"):
            $countF++;
        endif;
        if($row['sexo'] == "M"):
            $countM++;
        endif;
    }

    while ($row = mysqli_fetch_array( $sql )) {
        if($row['sexo'] == "F" && $row['estilo'] == "ACOMODADOR"):
            $estilo = "ACOMODADOR";
            $valor_probabilidad = (($countF + ($m * (1/$ncSexo))) / ($nAcomodador + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['estilo'] == "ACOMODADOR"):
            $estilo = "ACOMODADOR";
            $valor_probabilidad = (($countM + ($m * (1/$ncSexo))) / ($nAcomodador + $m));
            $valor_caracteristica = "M";
        endif;

        if($row['sexo'] == "F" && $row['estilo'] == "ASIMILADOR"):
            $estilo = "ASIMILADOR";
            $valor_probabilidad = (($countF + ($m * (1/$ncSexo))) / ($nAsimilador + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['estilo'] == "ASIMILADOR"):
            $estilo = "ASIMILADOR";
            $valor_probabilidad = (($countM + ($m * (1/$ncSexo))) / ($nAsimilador + $m));
            $valor_caracteristica = "M";
        endif;

        if($row['sexo'] == "F" && $row['estilo'] == "CONVERGENTE"):
            $estilo = "CONVERGENTE";
            $valor_probabilidad = (($countF + ($m * (1/$ncSexo))) / ($nConvergente + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['estilo'] == "CONVERGENTE"):
            $estilo = "CONVERGENTE";
            $valor_probabilidad = (($countM + ($m * (1/$ncSexo))) / ($nConvergente + $m));
            $valor_caracteristica = "M";
        endif;

        if($row['sexo'] == "F" && $row['estilo'] == "DIVERGENTE"):
            $estilo = "DIVERGENTE";
            $valor_probabilidad = (($countF + ($m * (1/$ncSexo))) / ($nDivergente + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['estilo'] == "DIVERGENTE"):
            $estilo = "DIVERGENTE";
            $valor_probabilidad = (($countM + ($m * (1/$ncSexo))) / ($nDivergente + $m));
            $valor_caracteristica = "M";
        endif;


        if($row['recinto'] == "Paraiso" && $row['estilo'] == "ACOMODADOR"):
            $estilo = "ACOMODADOR";
            $valor_probabilidad = (($countP + ($m * (1/$ncRecinto))) / ($nAcomodador + $m));
            $valor_caracteristica = "Paraiso";
        endif;

        if($row['recinto'] == "Turrialba" && $row['estilo'] == "ACOMODADOR"):
            $estilo = "ACOMODADOR";
            $valor_probabilidad = (($countT + ($m * (1/$ncRecinto))) / ($nAcomodador + $m));
            $valor_caracteristica = "Turrialba";
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "ASIMILADOR"):
            $estilo = "ASIMILADOR";
            $valor_probabilidad = (($countP + ($m * (1/$ncRecinto))) / ($nAsimilador + $m));
            $valor_caracteristica = "Paraiso";
        endif;

        if($row['recinto'] == "Turrialba" && $row['estilo'] == "ASIMILADOR"):
            $estilo = "ASIMILADOR";
            $valor_probabilidad = (($countT + ($m * (1/$ncRecinto))) / ($nAsimilador + $m));
            $valor_caracteristica = "Turrialba";
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "CONVERGENTE"):
            $estilo = "CONVERGENTE";
            $valor_probabilidad = (($countP + ($m * (1/$ncRecinto))) / ($nConvergente + $m));
            $valor_caracteristica = "Paraiso";
        endif;

        if($row['recinto'] == "Turrialba" && $row['estilo'] == "CONVERGENTE"):
            $reestilocinto = "CONVERGENTE";
            $valor_probabilidad = (($countT + ($m * (1/$ncRecinto))) / ($nConvergente + $m));
            $valor_caracteristica = "Turrialba";
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "DIVERGENTE"):
            $estilo = "DIVERGENTE";
            $valor_probabilidad = (($countP + ($m * (1/$ncRecinto))) / ($nDivergente + $m));
            $valor_caracteristica = "Paraiso";
        endif;

        if($row['recinto'] == "Turrialba" && $row['estilo'] == "DIVERGENTE"):
            $estilo = "DIVERGENTE";
            $valor_probabilidad = (($countT + ($m * (1/$ncRecinto))) / ($nDivergente + $m));
            $valor_caracteristica = "Turrialba";
        endif;


        
        $sqlInsertar = "INSERT INTO probabilidad_estilo2 (estilo,valor_probabilidad,valor_caracteristica)
            VALUES (estilo,valor_probabilidad,valor_caracteristica)";
    }

    mysqli_close($conn);
}
?>