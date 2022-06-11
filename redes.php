<?php include("template/header.php")?>

<?php 

include "redes_algoritmo.php";

/*Estos son los valores ingresados por el usuario*/
$reliability=(isset($_POST['reliability']))?$_POST['reliability']:"";
$number_of=(isset($_POST['number_of']))?$_POST['number_of']:"";
$capacity=(isset($_POST['capacity']))?$_POST['capacity']:"";
$costo=(isset($_POST['costo']))?$_POST['costo']:"";


/*Esta variable es la que se le mostrará al usuario con el resultado del algoritmo*/
$resultado = metodo_naive_bayes($reliability,$number_of,$capacity,$costo);


?>

<p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES EL TIPO DE RED?</b></font></font></p>

Escoja las opciones para calcular el tipo de red...<big></big>
<form name="estilo" method="POST">
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="reliability" id="reliability">
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        </select>Confiabilidad de la red<br>
        </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="number_of" id="number_of">
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        </select>Número de links<br>
        </td>
        <td style="vertical-align: top;">
        <select name="capacity" id="capacity">
        <option value="Low">Baja</option>
        <option value="Medium">Media</option>
        <option value="High">Alta</option>
        </select>Capacidad total de la red</td>
        <td style="vertical-align: top;">
        <select name="costo" id="costo">
        <option value="Low">Bajo</option>
        <option value="Medium">Medio</option>
        <option value="High">Alto</option>
        </select>Costo de la red</td>
      </tr>
    </tbody>
  </table>
  <br>

<button type="submit" name="accion" value="Calcular" >Calcular</button>
</form>


<form method="GET">

CLASIFICACIÓN DE REDES &nbsp;&nbsp; <input type="text" name="ESTILOFINAL" value="<?php echo $resultado?>">
    <br>
    <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font>


</form>
<?php include("template/footer.php")?>