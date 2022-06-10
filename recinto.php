<?php include("template/header.php")?>
<?php 
include "recinto_algoritmo.php";

/*Estos son los valores ingresados por el usuario*/
$estilo=(isset($_POST['estilo']))?$_POST['estilo']:"";
$promedio=(isset($_POST['promedio']))?$_POST['promedio']:"";
$sexo=(isset($_POST['sexo']))?$_POST['sexo']:"";

/*Esta variable es la que se le mostrará al usuario con el resultado del algoritmo*/
$resultado = metodo_naive_bayes1($estilo,$promedio,$sexo);


?>

<p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES SU RECINTO?</b></font></font></p>

Escoja las opciones para calcular el recinto...<big></big>
<form name="estilo" method="POST" enctype="multipart/form-data">
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top; width: 25%;">
          <select name="estilo" id="estilo">
            <option value="DIVERGENTE">divergente</option>
            <option value="CONVERGENTE">convergente</option>
            <option value="ASIMILADOR">asimilador</option>
            <option value="ACOMODADOR">acomodador</option>
          </select>Estilo de aprendizaje<br>
        </td>
        <td style="vertical-align: top;  width: 25%;">
          <input id="promedio" name="promedio" min="1" max="10" maxlength="4" type="number" step="any" value="1" ><br>
        </td>
        <td style="vertical-align: top; width: 25%;">
          <select name="sexo" id="sexo">
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
          </select>Sexo</td>
      </tr>
    </tbody>
  </table>
  <br>
  <button type="submit" name="accion" value="Calcular" >Calcular</button>
</form>

<form method="GET">

RECINTO DEL ESTUDIANTE &nbsp;&nbsp; <input type="text" name="ESTILOFINAL" value="<?php echo $resultado?>">
    <br>
    <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font>


</form>




<?php include("template/footer.php")?>