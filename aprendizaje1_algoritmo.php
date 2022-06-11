<?php 
function metodo_naive_bayes($ca,$ec,$ea,$or){
        //Conexion con la base de datos
        $host = "163.178.107.10";
        $user = "laboratorios";
        $password = "KmZpo.2796";
        $data_base = "if7103_tarea2_b82444";
        $conexion = mysqli_connect($host,$user,$password,$data_base);

        //Trae las probabilidades de estilo1
        $datosEstilo1 = "SELECT * FROM probabilidad_estilo1";
        $conexionEstilo = mysqli_query($conexion, $datosEstilo1);

        //Trae las frecuencias de estilo1
        $datosFrecuenciasEstilo1 = "SELECT * FROM frecuencias_estilo1";
        $conexionFrecuenciaEstilo1 = mysqli_query($conexion, $datosFrecuenciasEstilo1);
        
        $frecuenciaAcomodador= 1;
        $frecuenciaAsimilador = 1;
        $frecuenciaConvergente = 1;
        $frecuenciaDivergente = 1;

        while ($row = mysqli_fetch_array($conexionEstilo)) {
                //Datos para comparar el valor ca      
                if($row['valor_caracteristica'] == $ca && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $row['ca'];
                elseif($row['valor_caracteristica'] == $ca && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['ca'];
                elseif($row['valor_caracteristica'] == $ca && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ca'];
                elseif($row['valor_caracteristica'] == $ca && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ca'];
                endif;

                //Datos para comparar el valor ec   
                if($row['valor_caracteristica'] == $ec && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $Row['ec'];
                elseif($row['valor_caracteristica'] == $ec && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $Row['ec'];
                elseif($row['valor_caracteristica'] == $ec && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ec'];
                elseif($row['valor_caracteristica'] == $ec && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ec'];
                endif;

                //Datos para comparar el valor ea   
                if($row['valor_caracteristica'] == $ea && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $Row['ea'];
                elseif($row['valor_caracteristica'] == $ea && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['ea'];
                elseif($row['valor_caracteristica'] == $ea && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ea'];
                elseif($row['valor_caracteristica'] == $ea && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ea'];
                endif;

                //Datos para comparar el valor or_   
                if($row['valor_caracteristica'] == $or && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $row['or_'];
                elseif($row['valor_caracteristica'] == $or && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['or_'];
                elseif($row['valor_caracteristica'] == $or && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $Row['or_'];
                elseif($row['valor_caracteristica'] == $or && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['or_'];
                endif;
        }

        

        //Bucle que trae las frecuencias ya calculadas de estilo
        while ($row = mysqli_fetch_array($conexionFrecuenciaEstilo1)) { 
                //Datos provenientes de la Base de datos
                $nAcomodador = $row['nAcomodador'];
                $nAsimilador = $row['nAsimilador'];
                $nConvergente = $row['nConvergente'];
                $nDivergente = $row['nDivergente'];
        }

        $estilo = "";
        //Producto de frecuencia
        //Compara los totales para establecer cual es el mayor valor_caracteristica
        if((($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaAsimilador * $nAsimilador)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'ACOMODADOR';
        elseif((($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'ASIMILADOR';
        elseif((($frecuenciaConvergente * $nConvergente) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'CONVERGENTE';
        else:
                $estilo = 'DIVERGENTE';
        endif;

        return $estilo;//Retorna el valor_caracteristica
}

?>