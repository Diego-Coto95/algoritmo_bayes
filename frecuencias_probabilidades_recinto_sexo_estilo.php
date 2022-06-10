<?php

function insertaFrecuenciaProbabilidad(){
    //Conexion con la base de datos
    $host = "163.178.107.10";
    $user = "laboratorios";
    $password = "KmZpo.2796";
    $data_base = "if7103_tarea2_b82444";
    $conexion = mysqli_connect($host,$user,$password,$data_base);
    $sql = "SELECT * FROM estiloSexoPromedioRecinto";

    $sql2 = "SELECT * FROM frecuencias_estiloSexoPromedioRecinto";
    
    $data_bd2 = mysqli_query( $conexion, $sql2 );

    $data_bd = mysqli_query( $conexion, $sql );

    //Instancio los valores por defecto para cada uno de los valores que requeriré para los cálculos
    //Cuenta la cantidad total de cada uno de los recintos en la base de datos
    $nTurrialba = 0; 
    $nParaiso = 0; 

    //valores frecuencias
    $ncSexoTurrialba = 0; 
    $ncSexoParaiso = 0; 

    $ncEstiloTurrialba = 0; 
    $ncEstiloParaiso = 0; 

    $ncPromedioParaiso = 0; 
    $ncPromedioTurrialba = 0; 

    //Valores donde el sexo tiene que pertenecer a un recinto en especifico
    //Turrialba Sexo
    $ncMasculinoTurrialba = 0; 
    $ncFemeninoTurrialba = 0;
    //Paraiso Sexo
    $ncMasculinoParaiso = 0; 
    $ncFemeninoParaiso = 0; 

    //Valores donde el estilo tiene que pertenecer a un recinto en especifico
    //Turrialba Estilo
    $ncAcomodadorTurrialba=0; 
    $ncAsimiladorTurrialba=0; 
    $ncConvergenteTurrialba=0; 
	$ncDivergenteTurrialba=0;
    
    //Paraiso Estilo
    $ncAcomodadorParaiso =0;
	$ncAsimiladorParaiso=0; 
	$ncConvergenteParaiso=0; 	
    $ncDivergenteParaiso=0; 

    //Valores donde el promedio tiene que pertenecer a un recinto en especifico
    //Turrialba Promedio
    $ncProSeisTurrialba=0; 
    $ncProSieteTurrialba=0; 
    $ncProOchoTurrialba=0; 
    $ncProueveTurrialba=0; 
    
    //Paraiso Promedio
    $ncProSeisParaiso=0; 
    $ncProSieteParaiso=0; 
    $ncProOchoParaiso=0; 
    $ncProNueveParaiso=0;

    $m = 3; //Es 3 porque son 3 atributos
    $p = 0.50; //Porque son 2 sexos F,M
    $pEstilo = 0.25; //Porque son 4 estilos
    $pPromedio = 0.02; 

    //Bucle para que recorra las columnas que vienen de la base de datos
    while ($row = mysqli_fetch_array( $data_bd )) {

        //Suma la cantidad total de estudiantes en cada recinto en la BD por recinto
        if ($row['recinto'] == 'Turrialba'): 
            $nTurrialba++; 
        elseif($row['recinto'] == 'Paraiso'): 
            $nParaiso++; 
        endif; 

        //Suma los valores de los sexos y recinto
        //Turrialba
        if ($row['recinto'] == "Turrialba" and $row['sexo'] == 'M'): 
            $ncMasculinoTurrialba++; 
        elseif($row['recinto'] == "Turrialba" and $row['sexo'] == 'F'): 
            $ncFemeninoTurrialba++;  
        endif;
        
        //Suma los valores de los recintos y el estilo
        //Turrialba
        if($row['estilo'] == "ACOMODADOR" and $row['recinto'] == 'Turrialba'): 
            $ncAcomodadorTurrialba++; 
        endif;
        if($row['estilo'] == "CONVERGENTE" and $row['recinto'] == 'Turrialba'): 
            $ncConvergenteTurrialba++;
        endif;
        if($row['estilo'] == "ASIMILADOR" and $row['recinto'] == 'Turrialba'): 
            $ncAsimiladorTurrialba++; 
        endif;
        if($row['estilo'] == "DIVERGENTE" and $row['recinto'] == 'Turrialba'): 
            $ncDivergenteTurrialba++;
        endif;

        //Obtiene los valores de los recintos y el promedio
        //Turrialba
        if (($row['promedio'] >= 6 && $row['promedio'] < 7) and $row['recinto'] == 'Turrialba'): 
            $ncProSeisTurrialba++; 
        endif; 
        if (($row['promedio'] >= 7 && $row['promedio'] < 8) and $row['recinto'] == 'Turrialba'): 
            $ncProSieteTurrialba++; 
        endif; 
        if (($row['promedio'] >= 8 && $row['promedio'] < 9) and $row['recinto'] == 'Turrialba'): 
            $ncProOchoTurrialba++; 
        endif; 
        if (($row['promedio'] >= 9 && $row['promedio'] < 10) and $row['recinto'] == 'Turrialba'): 
            $ncProueveTurrialba++; 
        endif; 

        //Suma los valores de los sexos y recinto
        //Paraiso
        if ($row['recinto'] == "Paraiso" and $row['sexo'] == 'M'): 
            $ncMasculinoParaiso++; 
        elseif($row['recinto'] == "Paraiso" and $row['sexo'] == 'F'): 
            $ncFemeninoParaiso++;  
        endif; 
        //Paraiso
        if($row['estilo'] == "ACOMODADOR" and $row['recinto'] == 'Paraiso'): 
            $ncAcomodadorParaiso++; 
        endif;
        if($row['estilo'] == "CONVERGENTE" and $row['recinto'] == 'Paraiso'): 
            $ncConvergenteParaiso++;
        endif;
        if($row['estilo'] == "ASIMILADOR" and $row['recinto'] == 'Paraiso'): 
            $ncAsimiladorParaiso++; 
        endif;
        if($row['estilo'] == "DIVERGENTE" and $row['recinto'] == 'Paraiso'): 
            $ncDivergenteParaiso++;
        endif;

        //Obtiene los valores de los recintos y el promedio
        //Paraiso
        if (($row['promedio'] >= 6 && $row['promedio'] < 7) and $row['recinto'] == 'Paraiso'): 
            $ncProSeisParaiso++; 
        endif; 
        if (($row['promedio'] >= 7 && $row['promedio'] < 8) and $row['recinto'] == 'Paraiso'): 
            $ncProSieteParaiso++; 
        endif; 
        if (($row['promedio'] >= 8 && $row['promedio'] < 9) and $row['recinto'] == 'Paraiso'): 
            $ncProOchoParaiso++; 
        endif; 
        if (($row['promedio'] >= 9 && $row['promedio'] < 10) and $row['recinto'] == 'Paraiso'): 
            $ncProNueveParaiso++; 
        endif; 
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    //Check connection
    if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO frecuencias_estiloSexoPromedioRecinto (
        ncMTurrialba ,ncFTurrialba ,ncAcomodadorTurrialba ,ncAsimiladorTurrialba ,ncConvergenteTurrialba ,
        ncDivergenteTurrialba ,ncPromedio6Turrialba ,ncPromedio7Turrialba ,ncPromedio8Turrialba ,
        ncPromedio9Turrialba ,ncMParaiso ,ncFParaiso ,ncAcomodadorParaiso ,ncAsimiladorParaiso ,
        ncConvergenteParaiso ,ncDivergenteParaiso ,ncPromedio6Paraiso ,ncPromedio7Paraiso ,
        ncPromedio8Paraiso ,ncPromedio9Paraiso)
    VALUES (ncSexoMasculinoTurrialba,ncSexoFemeninoTurrialba,ncEstiloAcomodadorTurrialba,
    ncEstiloAsimiladorTurrialba,ncEstiloConvergenteTurrialba,ncEstiloDivergenteTurrialba,
    ncPromedioSeisTurrialba,ncPromedioSieteTurrialba,ncPromedioOchoTurrialba,
    ncPromedioNueveTurrialba,ncSexoMasculinoParaiso,ncSexoFemeninoParaiso,
    ncEstiloAcomodadorParaiso,ncEstiloAsimiladorParaiso,ncEstiloConvergenteParaiso
    ncEstiloDivergenteParaiso,ncPromedioSeisParaiso,ncPromedioSieteParaiso,ncPromedioOchoParaiso,
    ncPromedioNueveParaiso)";

    if ($conn->query($sql) === TRUE) {
    echo "Guardado Exitoso";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


    //Variables para capturar las probabilidades
    //Turrialba Sexo
    $probabilidadMasculinoTurrialba = 0; 
    $probabilidadSexoFemeninoTurrialba = 0;
    //Paraiso Sexo
    $probabilidadMasculinoParaiso = 0; 
    $probabilidadFemeninoParaiso = 0; 

    //Valores donde el estilo tiene que pertenecer a un recinto en especifico
    //Turrialba Estilo
    $probabilidadAcomodadorTurrialba = 0; 
    $probabilidadAsimiladorTurrialba = 0; 
    $probabilidadConvergenteTurrialba = 0; 
	$probabilidadDivergenteTurrialba = 0;
    
    //Paraiso Estilo
    $probabilidadAcomodadorParaiso = 0;
	$probabilidadAsimiladorParaiso = 0; 
	$probabilidadConvergenteParaiso = 0; 	
    $probabilidadDivergenteParaiso = 0; 

    //Valores donde el promedio tiene que pertenecer a un recinto en especifico
    //Turrialba Promedio
    $probabilidadProSeisTurrialba = 0; 
    $probabilidadProSieteTurrialba = 0; 
    $probabilidadProOchoTurrialba = 0; 
    $probabilidadProNueveTurrialba = 0; 
    
    //Paraiso Promedio
    $probabilidadProSeisParaiso = 0; 
    $probabilidadProSieteParaiso = 0; 
    $probabilidadProOchoParaiso = 0; 
    $probabilidadProNueveParaiso = 0;

    //Suma el total de todos los datos en la base de datos
    $sumaTotalDatos = $nTurrialba + $nParaiso; 
    //Probabilidad que el recinto sea Paraiso en todos los datos 
    $probabilidadParaiso = $nParaiso / $sumaTotalDatos; 
    //Probabilidad que el recinto sea Turrialba en todos los datos 
    $probabilidadTurrialba = $nTurrialba / $sumaTotalDatos; 


    //while para guardar las probabilidades
    while ($row2 = mysqli_fetch_array( $data_bd2 )) {
        //Calcula las probabilidades de sexo 
        //M Turri
        $ncMasculinoTurrialba = $row2['ncMTurrialba'];
        $probabilidadMasculinoTurrialba = (($ncMasculinoTurrialba + ($m * $p)) / ($nTurrialba + $m));
        //F Turri
        $ncFemeninoTurrialba = $row2['ncFTurrialba'];
        $probabilidadFemeninoTurrialba = (($ncFemeninoTurrialba + ($m * $p)) / ($nTurrialba + $m));
    
        //Calcula las probabilidades de estilo 
        //ACOMODADOR Turri
        $ncAcomodadorTurrialba = $row2['ncAcomodadorTurrialba'];
        $probabilidadAcomodadorTurrialba = (($ncAcomodadorTurrialba + ($m * $pEstilo)) / ($nTurrialba + $m));
        //ASIMILADOR Turri
        $ncAsimiladorTurrialba = $row2['ncAsimiladorTurrialba'];
        $probabilidadAsimiladorTurrialba = (($ncAsimiladorTurrialba + ($m * $pEstilo)) / ($nTurrialba + $m));
        //CONVERGENTE Turri
        $ncConvergenteTurrialba = $row2['ncConvergenteTurrialba'];
        $probabilidadConvergenteTurrialba = (($ncConvergenteTurrialba + ($m * $pEstilo)) / ($nTurrialba + $m));
        //DIVERGENTE Turri
        $ncDivergenteTurrialba = $row2['ncDivergenteTurrialba'];
        $probabilidadDivergenteTurrialba = (($ncDivergenteTurrialba + ($m * $pEstilo)) / ($nTurrialba + $m));

        //Calcula las probabilidades de promedio 
        //6 Turri
        $ncProSeisTurrialba = $row2['ncPromedio6Turrialba'];
        $probabilidadProSeisTurrialba = (($ncProSeisTurrialba + ($m * $pPromedio)) / ($nTurrialba + $m));
        //7 Turri
        $ncProSieteTurrialba = $row2['ncPromedio7Turrialba'];
        $probabilidadProSieteTurrialba = (($ncProSieteTurrialba + ($m * $pPromedio)) / ($nTurrialba + $m));
        //8 Turri
        $ncProOchoTurrialba = $row2['ncPromedio8Turrialba'];
        $probabilidadProOchoTurrialba = (($ncProOchoTurrialba + ($m * $pPromedio)) / ($nTurrialba + $m));
        //9 Turri
        $ncProNueveTurrialba = $row2['ncPromedio9Turrialba'];
        $probabilidadProueveTurrialba = (($ncProueveTurrialba + ($m * $pPromedio)) / ($nTurrialba + $m));
        

        //Calcula las probabilidades de sexo 
        //M Paraiso
        $ncMasculinoParaiso = $row2['ncMParaiso'];
        $probabilidadMasculinoParaiso = (($ncMasculinoParaiso + ($m * $p)) / ($nParaiso + $m));
        //F Paraiso
        $ncFemeninoParaiso = $row2['ncFParaiso'];
        $probabilidadFemeninoParaiso = (($ncFemeninoParaiso + ($m * $p)) / ($nParaiso + $m));

        //Calcula las probabilidades de estilo 
        //ACOMODADOR Paraiso
        $ncAcomodadorParaiso = $row2['ncAcomodadorParaiso'];
        $probabilidadAcomodadorParaiso = (($ncAcomodadorParaiso + ($m * $pEstilo)) / ($nParaiso + $m));
        //ASIMILADOR Paraiso
        $ncAsimiladorParaiso = $row2['ncAsimiladorParaiso'];
        $probabilidadAsimiladorParaiso = (($ncAsimiladorParaiso + ($m * $pEstilo)) / ($nParaiso + $m));
        //CONVERGENTE Paraiso
        $ncConvergenteParaiso = $row2['ncConvergenteParaiso'];
        $probabilidadConvergenteParaiso = (($ncConvergenteParaiso + ($m * $pEstilo)) / ($nParaiso + $m));
        //DIVERGENTE Paraiso
        $ncDivergenteParaiso = $row2['ncDivergenteParaiso'];
        $probabilidadDivergenteParaiso = (($ncDivergenteParaiso + ($m * $pEstilo)) / ($nParaiso + $m));

        //Calcula las probabilidades de promedio 
        //6 Paraiso
        $ncProSeisParaiso = $row2['ncPromedio6Paraiso'];
        $probabilidadProSeisParaiso = (($ncProSeisParaiso + ($m * $pPromedio)) / ($nParaiso + $m));
        //7 Paraiso
        $ncProSieteParaiso = $row2['ncPromedio7Paraiso'];
        $probabilidadProSieteParaiso = (($ncProSieteParaiso + ($m * $pPromedio)) / ($nParaiso + $m));
        //8 Paraiso
        $ncProOchoParaiso = $row2['ncPromedio8Paraiso'];
        $probabilidadProOchoParaiso = (($ncProOchoParaiso + ($m * $pPromedio)) / ($nParaiso + $m));
        //9 Paraiso
        $ncProNueveParaiso = $row2['ncPromedio9Paraiso'];
        $probabilidadProNueveParaiso = (($ncProNueveParaiso + ($m * $pPromedio)) / ($nParaiso + $m));
    }

    //Creo la conexion para insertar en la base de datos
    $conn = new mysqli($host,$user,$password,$data_base);
    //Check connection
    if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO probabilidades_estiloSexoPromedioRecinto (
        mTurrialba ,fTurrialba ,acomodadorTurrialba ,asimiladorTurrialba ,convergenteTurrialba ,
        divergenteTurrialba ,promedio6Turrialba ,promedio7Turrialba ,promedio8Turrialba ,
        npromedio9Turrialba ,mParaiso ,fParaiso ,acomodadorParaiso ,asimiladorParaiso ,
        convergenteParaiso ,divergenteParaiso ,promedio6Paraiso ,promedio7Paraiso ,
        promedio8Paraiso ,promedio9Paraiso)
    VALUES (probabilidadMasculinoTurrialba,probabilidadFemeninoTurrialba,probabilidadAcomodadorTurrialba,
    probabilidadAsimiladorTurrialba,probabilidadConvergenteTurrialba,probabilidadDivergenteTurrialba,
    probabilidadProSeisTurrialba,probabilidadProSieteTurrialba,probabilidadProOchoTurrialba,
    probabilidadProNueveTurrialba,probabilidadMasculinoParaiso,probabilidadFemeninoParaiso,
    probabilidadAcomodadorParaiso,probabilidadAsimiladorParaiso,probabilidadConvergenteParaiso
    probabilidadDivergenteParaiso,probabilidadProSeisParaiso,probabilidadProSieteParaiso,probabilidadProOchoParaiso,
    probabilidadProNueveParaiso)";

    if ($conn->query($sql) === TRUE) {
    echo "Guardado Exitoso";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
