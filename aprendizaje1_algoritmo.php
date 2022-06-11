<?php 
function metodo_naive_bayes($ca,$ec,$ea,$or){
        //Conexion con la base de datos
        $host = "163.178.107.10";
        $user = "laboratorios";
        $password = "KmZpo.2796";
        $data_base = "if7103_tarea2_b72204";
        //$data_base = "if7103_tarea2_b82444";
        
        $conexion = mysqli_connect($host,$user,$password,$data_base);
        $frecuenciaAcomodador= 1;
        $frecuenciaAsimilador = 1;
        $frecuenciaConvergente = 1;
        $frecuenciaDivergente = 1;

        $datosEstilo = "SELECT * FROM prob_formulario_estilo";
        $conexionEstilo = mysqli_query($conexion, $datosEstilo);

        while ($row = mysqli_fetch_array($conexionEstilo)) {     
                if($row['valor'] == $ca && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $row['ca'];
                elseif($row['valor'] == $ca && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['ca'];
                elseif($row['valor'] == $ca && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ca'];
                elseif($row['valor'] == $ca && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ca'];
                endif;

                if($row['valor'] == $ec && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $Row['ec'];
                elseif($row['valor'] == $ec && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $Row['ec'];
                elseif($row['valor'] == $ec && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ec'];
                elseif($row['valor'] == $ec && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ec'];
                endif;

                if($row['valor'] == $ea && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $Row['ea'];
                elseif($row['valor'] == $ea && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['ea'];
                elseif($row['valor'] == $ea && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $row['ea'];
                elseif($row['valor'] == $ea && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['ea'];
                endif;

                if($row['valor'] == $or && $row['estilo'] == 'ACOMODADOR'):
                        $frecuenciaAcomodador = $frecuenciaAcomodador * $row['or'];
                elseif($row['valor'] == $or && $row['estilo'] == 'ASIMILADOR'):
                        $frecuenciaAsimilador = $frecuenciaAsimilador * $row['or'];
                elseif($row['valor'] == $or && $row['estilo'] == 'CONVERGENTE'):
                        $frecuenciaConvergente = $frecuenciaConvergente * $Row['or'];
                elseif($row['valor'] == $or && $row['estilo'] == 'DIVERGENTE'):
                        $frecuenciaDivergente = $frecuenciaDivergente * $row['or'];
                endif;
        }

        $estilo = "";
        $nAcomodador = 14/77;
        $nAsimilador = 21/77;
        $nConvergente = 21/77;
        $nDivergente = 21/77;

        //Producto de frecuencia
        //Compara los totales para establecer cual es el mayor valor
        if((($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaAsimilador * $nAsimilador)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAcomodador * $nAcomodador) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'ACOMODADOR';
        elseif((($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaConvergente * $nConvergente)) && (($frecuenciaAsimilador * $nAsimilador) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'ASIMILADOR';
        elseif((($frecuenciaConvergente * $nConvergente) > ($frecuenciaDivergente * $nDivergente))):
                $estilo = 'CONVERGENTE';
        else:
                $estilo = 'DIVERGENTE';
        endif;

        return $estilo;//Retorna el valor
}

?>