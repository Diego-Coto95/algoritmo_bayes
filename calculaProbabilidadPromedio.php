<?php
function insertaProbabilidadPromedio(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "Uy&)&nfC7QqQau.%278UQ24/=%";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $sql1 = "SELECT * FROM frecuencias_recinto";
    $sql2 = "SELECT * FROM frecuencias_sexo";
    $sql3 = "SELECT * FROM frecuencias_estilo";

    $promedio = 0;
    $valor_probabilidad = 0;
    $valor_caracteristica = "";

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    while ($row = mysqli_fetch_array( $sql1 )) {
        $mR = $row['m'];
        $nParariso = $row['nParariso'];
        $nTurrialba = $row['nTurrialba'];
        $ncSexo1 = $row['ncSexo'];
        $ncEstilo1 = $row['ncEstilo'];
        $ncPromedio1 = $row['ncPromedio'];
    }

    while ($row = mysqli_fetch_array( $sql2 )) {
        $mS = $row['m'];
        $nM = $row['nM'];
        $nF = $row['nF'];
        $ncEstilo2 = $row['ncEstilo'];
        $ncRecinto1 = $row['ncEstilo'];
        $ncPromedio2 = $row['ncPromedio'];
    }

    while ($row = mysqli_fetch_array( $sql3 )) {
        $mE = $row['m'];
        $nAcomodador = $row['nAcomodador'];
        $nAsimilador = $row['nAsimilador'];
        $nConvergente = $row['nConvergente'];
        $nDivergente = $row['nDivergente'];
        $ncSexo2 = $row['ncSexo'];
        $ncRecinto2 = $row['ncRecinto'];
        $ncPromedio3 = $row['ncPromedio'];
    }

    $countP = 0;
    $countT = 0;
    $countM = 0;
    $countF = 0;
    $countAcomodador = 0;
    $countAsimilador = 0;
    $countConvergente = 0;
    $countDivergente = 0;

    while ($row = mysqli_fetch_array( $estiloSexoPromedioRecinto )) {
        //Cuenta las veces que esta una columna filtrado por estilo
        if($row['promedio'] && $row['recinto'] == "Paraiso"):
            $countP++;
        endif;
        if($row['promedio'] && $row['recinto'] == "Turrialba"):
            $countT++;
        endif;
        if($row['promedio'] && $row['sexo'] == "M"):
            $countM++;
        endif;
        if($row['promedio'] && $row['sexo'] == "F"):
            $countF++;
        endif;
        if($row['promedio'] && $row['estilo'] == "ACOMODADOR"):
            $countAcomodador++;
        endif;
        if($row['promedio'] && $row['estilo'] == "ASIMILADOR"):
            $countAsimilador++;
        endif;
        if($row['promedio'] && $row['estilo'] == "CONVERGENTE"):
            $countConvergente++;
        endif;
        if($row['promedio'] && $row['estilo'] == "DIVERGENTE"):
            $countDivergente++;
        endif;
    }

    //Realiza los calculos de las probabilidades
    while ($row = mysqli_fetch_array( $estiloSexoPromedioRecinto )) {
        if($row['recinto'] == "Paraiso"):
            $promedio = $promedio;
            $valor_probabilidad = (($countP + ($mR * (1/$ncPromedio1))) / ($nParariso + $mR));
            $valor_caracteristica = "Paraiso";
        endif;

        if($row['recinto'] == "Turrialba"):
            $promedio = $promedio;
            $valor_probabilidad = (($countT + ($mR * (1/$ncPromedio1))) / ($nTurrialba + $mR));
            $valor_caracteristica ="Turrialba";
        endif;

        if($row['sexo'] == "M"):
            $promedio = $promedio;
            $valor_probabilidad = (($countM + ($mS * (1/$ncPromedio2))) / ($nM + $mS));
            $valor_caracteristica = "M";
        endif;

        if($row['sexo'] == "F"):
            $promedio = $promedio;
            $valor_probabilidad = (($countF + ($mS * (1/$ncPromedio2))) / ($nF + $mS));
            $valor_caracteristica = "F";
        endif;

        if($row['estilo'] == "ACOMODADOR"):
            $promedio = $promedio;
            $valor_probabilidad = (($countAcomodador + ($mE * (1/$ncPromedio3))) / ($nAcomodador + $mE));
            $valor_caracteristica = "ACOMODADOR";
        endif;

        if($row['estilo'] == "ASIMILADOR"):
            $promedio = $promedio;
            $valor_probabilidad = (($countAsimilador + ($mE * (1/$ncPromedio3))) / ($nAsimilador + $mS));
            $valor_caracteristica = "ASIMILADOR";
        endif;

        if($row['estilo'] == "CONVERGENTE"):
            $promedio = $promedio;
            $valor_probabilidad = (($countConvergente + ($mE * (1/$ncPromedio3))) / ($nConvergente + $mE));
            $valor_caracteristica = "CONVERGENTE";
        endif;

        if($row['estilo'] == "DIVERGENTE"):
            $promedio = $promedio;
            $valor_probabilidad = (($countDivergente + ($mE * (1/$ncPromedio3))) / ($nDivergente + $mE));
            $valor_caracteristica = "DIVERGENTE";
        endif;

        $sqlInsertar = "INSERT INTO probabilidad_promedio (promedio,valor_probabilidad,valor_caracteristica)
            VALUES (promedio,valor_probabilidad,valor_caracteristica)";
        
    }
    mysqli_close($conn);
}
?>