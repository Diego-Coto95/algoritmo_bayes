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

function insertaProbabilidadProfesores(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);

    $sql = "SELECT * FROM profesores";

    $frecuencias_profesores = "SELECT * FROM frecuencias_profesores";


    
    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connected successfully";

    //Trae las frecuencias para luego sacar las probabilidades
    while ($row = mysqli_fetch_array( $frecuencias_profesores )) {
        $m = $row['m'];
        $nBeginner = $row['nBeginner'];
        $nIntermediate = $row['nIntermediate'];
        $nAdvanced = $row['nAdvanced'];
        $ncA = $row['ncA'];
        $ncB = $row['ncB'];
        $ncC = $row['ncC'];
        $ncD = $row['ncD'];
        $ncE = $row['ncE'];
        $ncF = $row['ncF'];
        $ncG = $row['ncG'];
        $ncH = $row['ncH'];
    }

    $valor_caracteristica_a = 0;
    $valor_probabilidad_a = 0;
    $valor_caracteristica_b = 0;
    $valor_probabilidad_b = 0;
    $valor_caracteristica_c = 0;
    $valor_probabilidad_c = 0;
    $valor_caracteristica_d = 0;
    $valor_probabilidad_d = 0;
    $valor_caracteristica_e = 0;
    $valor_probabilidad_e = 0;
    $valor_caracteristica_f = 0;
    $valor_probabilidad_f = 0;
    $valor_caracteristica_g = 0;
    $valor_probabilidad_g = 0;
    $valor_caracteristica_h = 0;
    $valor_probabilidad_h = 0;

    $class = "";


    $countA = 0;
    $countB = 0;
    $countC = 0;
    $countD = 0;
    $countE = 0;
    $countF = 0;
    $countG = 0;
    $countH = 0;

    while ($row = mysqli_fetch_array( $profesores )) {
        //Cuenta las veces que esta una columna filtrado por recinto
        if($row['A']):
            $countA++;
        endif;
        if($row['B'] ):
            $countB++;
        endif;
        if($row['C']):
            $countC++;
        endif;
        if($row['D'] ):
            $countD++;
        endif;
        if($row['E'] ):
            $countE++;
        endif;
        if($row['F'] ):
            $countF++;
        endif;
        if($row['G'] ):
            $countG++;
        endif;
        if($row['H'] ):
            $countH++;
        endif;
    }

    while ($row = mysqli_fetch_array( $sql )) {
        foreach (range(1, 3) as $valor_caracteristica) {
            if($row['A'] && $row['class'] == "Beginner"):
                $valor_caracteristica_a = "Paraiso";
                $valor_probabilidad_a = (($countA + ($m * (1/$ncA))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['B'] && $row['class'] == "Beginner"):
                $valor_caracteristica_b = "Paraiso";
                $valor_probabilidad_b = (($countB + ($m * (1/$ncB))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['C'] && $row['class'] == "Beginner"):
                $valor_caracteristica_c = "Paraiso";
                $valor_probabilidad_c = (($countC + ($m * (1/$ncC))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['D'] && $row['class'] == "Beginner"):
                $valor_caracteristica_d = "Paraiso";
                $valor_probabilidad_d = (($countD + ($m * (1/$ncD))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['E'] && $row['class'] == "Beginner"):
                $valor_caracteristica_e = "Paraiso";
                $valor_probabilidad_e = (($countE + ($m * (1/$ncE))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['F'] && $row['class'] == "Beginner"):
                $valor_caracteristica_f = "Paraiso";
                $valor_probabilidad_f = (($countF + ($m * (1/$ncF))) / ($nBeginner + $m));
                $class = "Beginner";

            endif;if($row['G'] && $row['class'] == "Beginner"):
                $valor_caracteristica_g = "Paraiso";
                $valor_probabilidad_g = (($countG + ($m * (1/$ncG))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['H'] && $row['class'] == "Beginner"):
                $valor_caracteristica_ = "Paraiso";
                $valor_probabilidad_h = (($countH + ($m * (1/$ncH))) / ($nBeginner + $m));
                $class = "Beginner";
            endif;

            if($row['A'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_a = "Paraiso";
                $valor_probabilidad_a = (($countA + ($m * (1/$ncA))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['B'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_b = "Paraiso";
                $valor_probabilidad_b = (($countB + ($m * (1/$ncB))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['C'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_c = "Paraiso";
                $valor_probabilidad_c = (($countC + ($m * (1/$ncC))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['D'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_d = "Paraiso";
                $valor_probabilidad_d = (($countD + ($m * (1/$ncD))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['E'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_e = "Paraiso";
                $valor_probabilidad_e = (($countE + ($m * (1/$ncE))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['F'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_f = "Paraiso";
                $valor_probabilidad_f = (($countF + ($m * (1/$ncF))) / ($nIntermediate + $m));
                $class = "Intermediate";

            endif;if($row['G'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_g = "Paraiso";
                $valor_probabilidad_g = (($countG + ($m * (1/$ncG))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['H'] && $row['class'] == "Intermediate"):
                $valor_caracteristica_ = "Paraiso";
                $valor_probabilidad_h = (($countH + ($m * (1/$ncH))) / ($nIntermediate + $m));
                $class = "Intermediate";
            endif;

            if($row['A'] && $row['class'] == "Advanced"):
                $valor_caracteristica_a = "Paraiso";
                $valor_probabilidad_a = (($countA + ($m * (1/$ncA))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['B'] && $row['class'] == "Advanced"):
                $valor_caracteristica_b = "Paraiso";
                $valor_probabilidad_b = (($countB + ($m * (1/$ncB))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['C'] && $row['class'] == "Advanced"):
                $valor_caracteristica_c = "Paraiso";
                $valor_probabilidad_c = (($countC + ($m * (1/$ncC))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['D'] && $row['class'] == "Advanced"):
                $valor_caracteristica_d = "Paraiso";
                $valor_probabilidad_d = (($countD + ($m * (1/$ncD))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['E'] && $row['class'] == "Advanced"):
                $valor_caracteristica_e = "Paraiso";
                $valor_probabilidad_e = (($countE + ($m * (1/$ncE))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['F'] && $row['class'] == "Advanced"):
                $valor_caracteristica_f = "Paraiso";
                $valor_probabilidad_f = (($countF + ($m * (1/$ncF))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['G'] && $row['class'] == "Advanced"):
                $valor_caracteristica_g = "Paraiso";
                $valor_probabilidad_g = (($countG + ($m * (1/$ncG))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            if($row['H'] && $row['class'] == "Advanced"):
                $valor_caracteristica_ = "Paraiso";
                $valor_probabilidad_h = (($countH + ($m * (1/$ncH))) / ($nAdvanced + $m));
                $class = "Advanced";
            endif;

            $sqlInsertar = "INSERT INTO probabilidad_profesores (
                valor_caracteristica_a,
                valor_probabilidad_a,
                valor_caracteristica_b,
                valor_probabilidad_b,
                valor_caracteristica_c,
                valor_probabilidad_c,
                valor_caracteristica_d,
                valor_probabilidad_d,
                valor_caracteristica_e,
                valor_probabilidad_e,
                valor_caracteristica_f,
                valor_probabilidad_f,
                valor_caracteristica_g,
                valor_probabilidad_g,
                valor_caracteristica_h,
                valor_probabilidad_h,
                class
                )
                VALUES (
                    valor_caracteristica_a,
                    valor_probabilidad_a,
                    valor_caracteristica_b,
                    valor_probabilidad_b,
                    valor_caracteristica_c,
                    valor_probabilidad_c,
                    valor_caracteristica_d,
                    valor_probabilidad_d,
                    valor_caracteristica_e,
                    valor_probabilidad_e,
                    valor_caracteristica_f,
                    valor_probabilidad_f,
                    valor_caracteristica_g,
                    valor_probabilidad_g,
                    valor_caracteristica_h,
                    valor_probabilidad_h,
                    class
                    )";
        }
    } 
    
    mysqli_close($conn);
}

?>