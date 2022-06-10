<?php 

//Algoritmo que calcula la distancia euclidiana  
function metodo_distancia_euclidiana($ca,$ec,$ea,$or){
        
        $valor_minimo = 1000; //Valor para que compare en la primera iteracion del algoritmo

        //Conexión a la base de datos MySql
        $host = "163.178.107.10";
        $user = "laboratorios";
        $password = "KmZpo.2796";
        $data_base = "if7103_tarea2_b82444";
        $conexion = mysqli_connect($host,$user,$password,$data_base);
        $sql = "SELECT * FROM recintoEstilo"; //Trae los datos requeridos de la base de datos y se guardan en la variable $sql
        $data_bd = mysqli_query( $conexion, $sql );

        //Bucle para que recorra las columnas que vienen de la base de datos
        while ($row = mysqli_fetch_array( $data_bd )) {
                
                $metodo_euclides=0; //Esta variable tomará el valor euclidiano a comparar  y se reiniciará cada vez que itere el bucle

                /* Funcion matematica que me da el valor euclidiano. Saca la raíz cuadrada de la suma de las restas de dos valores elevados al cuadrado
                uno de ellos proveniente de la base de datos y el otro ingresado por el usuario*/
                $metodo_euclides= sqrt(pow(((int)$row['ec']-(int)$ec),2)+ pow(((int)$row['or_']-(int)$or),2)+pow(((int)$row['ca']-(int)$ca),2)+pow(((int)$row['ea']-(int)$ea),2)); 

                /*Compara si el valor euclidiano es menor a un minimo establecido posteriormente, en este caso lo estableci en 1000.
                En caso de que la condición se cumpla,el valor minimo remplaza al valor establecido y en la siguiente iteración vuelve a comparar
                hasta que encuentre un valor exacto o similar.
                */
                if($metodo_euclides <= $valor_minimo){
                        $valor_minimo =  $metodo_euclides;
                        $estilo = $row['estilo'];
                }
        }
        return $estilo; //Variable que retorna el valor más cercano o exacto proveniente de la base de datos. Es el valor a mostrarle al usuario.
}

?>