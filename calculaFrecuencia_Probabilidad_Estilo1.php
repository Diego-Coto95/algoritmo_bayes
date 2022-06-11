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

function insertaProbabilidadEstilo1(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $sql = "SELECT * FROM recintoEstilo";

    $frecuencias_estilo1 = "SELECT * FROM frecuencias_estilo1";


    
    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    //Trae las frecuencias para luego sacar las probabilidades
    while ($row = mysqli_fetch_array( $frecuencias_estilo1 )) {
        $m = $row['m'];
        $nAcomodador = $row['nAcomodador'];
        $nAsimilador = $row['nAsimilador'];
        $nConvergente = $row['nConvergente'];
        $nDivergente = $row['nDivergente'];
        $ncCa = $row['ncCa'];
        $ncEc = $row['ncEc'];
        $ncEa = $row['ncEa'];
        $ncOr = $row['ncOr'];
    }
    $valor_caracteristica = 0;
    $ca = 0;
    $ec = 0;
    $ea = 0;
    $or_ = 0;
    $estilo = "";

    $countCA = 0;
    $countEC = 0;
    $countEA = 0;
    $countOR = 0;

    while ($row = mysqli_fetch_array( $sql )) {
        //Cuenta las veces que esta una columna filtrado por estilo
        if($row['ca'] == "ca" && $row['estilo'] == "ACOMODADOR"):
            $countCA++;
        endif;
        if($row['ec'] == "ec" && $row['estilo'] == "ACOMODADOR"):
            $countEC++;
        endif;
        if($row['ea'] == "ea" && $row['estilo'] == "ACOMODADOR"):
            $countEA++;
        endif;
        if($row['or_'] == "or_" && $row['estilo'] == "ACOMODADOR"):
            $countOR++;
        endif;

        if($row['ca'] == "ca" && $row['estilo'] == "ASIMILADOR"):
            $countCA++;
        endif;
        if($row['ec'] == "ec" && $row['estilo'] == "ASIMILADOR"):
            $countEC++;
        endif;
        if($row['ea'] == "ea" && $row['estilo'] == "ASIMILADOR"):
            $countEA++;
        endif;
        if($row['or_'] == "or_" && $row['estilo'] == "ASIMILADOR"):
            $countOR++;
        endif;

        if($row['ca'] == "ca" && $row['estilo'] == "CONVERGENTE"):
            $countCA++;
        endif;
        if($row['ec'] == "ec" && $row['estilo'] == "CONVERGENTE"):
            $countEC++;
        endif;
        if($row['ea'] == "ea" && $row['estilo'] == "CONVERGENTE"):
            $countEA++;
        endif;
        if($row['or_'] == "or_" && $row['estilo'] == "CONVERGENTE"):
            $countOR++;
        endif;

        if($row['ca'] == "ca" && $row['estilo'] == "DIVERGENTE"):
            $countCA++;
        endif;
        if($row['ec'] == "ec" && $row['estilo'] == "DIVERGENTE"):
            $countEC++;
        endif;
        if($row['ea'] == "ea" && $row['estilo'] == "DIVERGENTE"):
            $countEA++;
        endif;
        if($row['or_'] == "or_" && $row['estilo'] == "DIVERGENTE"):
            $countOR++;
        endif;
    }

    //Bucle para calcular las probabilidades
    while ($row = mysqli_fetch_array( $sql )) {
        //Bucle para la cantidad de probabilidades de la suma total de todos los valores ca,ec,ea,or_
        foreach (range(6, 24) as $valor_caracteristica) {
            $row['valor_caracteristica'] = $valor_caracteristica;
            if($row['estilo'] == "ACOMODADOR"):
                $ca = (($countCA + ($m * (1/$ncCa))) / ($nAcomodador + $m));
                $ea = (($countEC + ($m * (1/$ncEc))) / ($nAcomodador + $m));
                $ec = (($countEA + ($m * (1/$ncEa))) / ($nAcomodador + $m));
                $or_ = (($countOR + ($m * (1/$ncOr))) / ($nAcomodador + $m));
                $estilo = "ACOMODADOR";
            endif;

            if($row['estilo'] == "ASIMILADOR"):
                $ca = (($countCA + ($m * (1/$ncCa))) / ($nAsimilador + $m));
                $ea = (($countEC + ($m * (1/$ncEc))) / ($nAsimilador + $m));
                $ec = (($countEA + ($m * (1/$ncEa))) / ($nAsimilador + $m));
                $or_ = (($countOR + ($m * (1/$ncOr))) / ($nAsimilador + $m));
                $estilo = "ASIMILADOR";
            endif;

            if($row['estilo'] == "CONVERGENTE"):
                $ca = (($countCA + ($m * (1/$ncCa))) / ($nConvergente + $m));
                $ea = (($countEC + ($m * (1/$ncEc))) / ($nConvergente + $m));
                $ec = (($countEA + ($m * (1/$ncEa))) / ($nConvergente + $m));
                $or_ = (($countOR + ($m * (1/$ncOr))) / ($nConvergente + $m));
                $estilo = "CONVERGENTE";
            endif;

            if($row['estilo'] == "DIVERGENTE"):
                $ca = (($countCA + ($m * (1/$ncCa))) / ($nDivergente + $m));
                $ea = (($countEC + ($m * (1/$ncEc))) / ($nDivergente + $m));
                $ec = (($countEA + ($m * (1/$ncEa))) / ($nDivergente + $m));
                $or_ = (($countOR + ($m * (1/$ncOr))) / ($nDivergente + $m));
                $estilo = "DIVERGENTE";
            endif;

            $sqlInsertar = "INSERT INTO probabilidad_estilo1 (valor_caracteristica,ca,ec,
                        ea,or_,estilo)
            VALUES (valor_caracteristica,ca,ec,
                        ea,or_,estilo)";
        }
    }   
    
    mysqli_close($conn);
}

?>