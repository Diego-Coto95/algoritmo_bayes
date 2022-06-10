<?php
//Coneccion a la base de datos
$host = "163.178.107.10";
$user = "laboratorios";
$pass = "KmZpo.2796";
$bd = "if7103_tarea1_b82444";

try {
  $conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$pass);
  if($conexion){echo "Conectado... a sistema";}
} catch (Exception $ex) {
  echo $ex -> getMessage();
}
    
?>