<?php

function insertaFrecuenciaRecinto(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
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

function insertaProbabilidadRecinto(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $frecuencias_recinto = "SELECT * FROM frecuencias_recinto";

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    //Trae las frecuencias para luego sacar las probabilidades
    while ($row = mysqli_fetch_array( $frecuencias_recinto )) {
        $m = $row['m'];
        $nParariso = $row['nParariso'];
        $nTurrialba = $row['nTurrialba'];
        $ncSexo = $row['ncSexo'];
        $ncEstilo = $row['ncEstilo'];
        $ncPromedio = $row['ncPromedio'];
    }

    $recinto = "";
    $valor_probabilidad = 0;
    $valor_caracteristica = "";

    $countPF = 0;
    $countTM = 0;
    $countPM = 0;
    $countTF = 0;
    $countPAcomodador = 0;
    $countTAcomodador = 0;
    $countPAsimilador = 0;
    $countTAsimilador = 0;
    $countPConvergente = 0;
    $countTConvergente = 0;
    $countPDivergente = 0;
    $countTDivergente = 0;

    while ($row = mysqli_fetch_array( $frecuencias_recinto )) {
        //Cuenta las veces que esta una columna filtrado por recinto
        if($row['recinto'] == "Paraiso" && $row['sexo'] == "F"):
            $countPF++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['sexo'] == "M"):
            $countTM++;
        endif;
        if($row['recinto'] == "Paraiso" && $row['sexo'] == "F"):
            $countPM++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['sexo'] == "M"):
            $countTF++;
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "ACOMODADOR"):
            $countPAcomodador++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['estilo'] == "ACOMODADOR"):
            $countTAcomodador++;
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "ASIMILADOR"):
            $countPAsimilador++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['estilo'] == "ASIMILADOR"):
            $countTAsimilador++;
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "CONVERGENTE"):
            $countPConvergente++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['estilo'] == "CONVERGENTE"):
            $countTConvergente++;
        endif;

        if($row['recinto'] == "Paraiso" && $row['estilo'] == "DIVERGENTE"):
            $countPDivergente++;
        endif;
        if($row['recinto'] == "Turrialba" && $row['estilo'] == "DIVERGENTE"):
            $countTDivergente++;
        endif;
    }

    while ($row = mysqli_fetch_array( $sql )) {
        if($row['sexo'] == "F" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPF + ($m * (1/$ncSexo))) / ($nParariso + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPF + ($m * (1/$ncSexo))) / ($nParariso + $m));
            $valor_caracteristica = "M";
        endif;

        if($row['sexo'] == "F" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countPM + ($m * (1/$ncSexo))) / ($nTurrialba + $m));
            $valor_caracteristica = "F";
        endif;

        if($row['sexo'] == "M" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countPM + ($m * (1/$ncSexo))) / ($nTurrialba + $m));
            $valor_caracteristica = "M";
        endif;

        if($row['estilo'] == "ACOMODADOR" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPAcomodador + ($m * (1/$ncEstilo))) / ($nParariso + $m));
            $valor_caracteristica = "ACOMODADOR";
        endif;

        if($row['estilo'] == "ACOMODADOR" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countTAcomodador + ($m * (1/$ncEstilo))) / ($nTurrialba + $m));
            $valor_caracteristica = "ACOMODADOR";
        endif;

        if($row['estilo'] == "ASIMILADOR" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPAsimilador + ($m * (1/$ncEstilo))) / ($nParariso + $m));
            $valor_caracteristica = "ASIMILADOR";
        endif;

        if($row['estilo'] == "ASIMILADOR" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countTAsimilador + ($m * (1/$ncEstilo))) / ($nTurrialba + $m));
            $valor_caracteristica = "ASIMILADOR";
        endif;

        if($row['estilo'] == "CONVERGENTE" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPConvergente + ($m * (1/$ncEstilo))) / ($nParariso + $m));
            $valor_caracteristica = "CONVERGENTE";
        endif;

        if($row['estilo'] == "CONVERGENTE" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countTConvergente + ($m * (1/$ncEstilo))) / ($nTurrialba + $m));
            $valor_caracteristica = "CONVERGENTE";
        endif;

        if($row['estilo'] == "DIVERGENTE" && $row['recinto'] == "Paraiso"):
            $recinto = "Paraiso";
            $valor_probabilidad = (($countPDivergente + ($m * (1/$ncEstilo))) / ($nParariso + $m));
            $valor_caracteristica = "DIVERGENTE";
        endif;

        if($row['estilo'] == "DIVERGENTE" && $row['recinto'] == "Turrialba"):
            $recinto = "Turrialba";
            $valor_probabilidad = (($countTDivergente + ($m * (1/$ncEstilo))) / ($nTurrialba + $m));
            $valor_caracteristica = "DIVERGENTE";
        endif;

        $sqlInsertar = "INSERT INTO probabilidad_promedio (recinto,valor_probabilidad,valor_caracteristica)
            VALUES (recinto,valor_probabilidad,valor_caracteristica)";
    }

    mysqli_close($conn);
}
?>