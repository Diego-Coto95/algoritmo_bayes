<?php include("template/header.php")?>
<?php 
include "aprendizaje1_algoritmo.php";

/*Estos son los valores ingresados por el usuario*/
$ca = (isset($_POST['c7']))+(isset($_POST['c11']))+(isset($_POST['c15']))+(isset($_POST['c19']))+(isset($_POST['c31']))+(isset($_POST['c35']));
$ec = (isset($_POST['c5']))+(isset($_POST['c9']))+(isset($_POST['c13']))+(isset($_POST['c17']))+(isset($_POST['c25']))+(isset($_POST['c29']));
$ea = (isset($_POST['c4']))+(isset($_POST['c12']))+(isset($_POST['c24']))+(isset($_POST['c28']))+(isset($_POST['c32']))+(isset($_POST['c36']));
$or = (isset($_POST['c2']))+(isset($_POST['c10']))+(isset($_POST['c22']))+(isset($_POST['c26']))+(isset($_POST['c30']))+(isset($_POST['c34']));

/*Esta variable es la que se le mostrará al usuario con el resultado del algoritmo*/
$resultado = metodo_distancia_euclidiana($ca,$ec,$ea,$or);

?>



<p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES SU ESTILO DE APRENDIZAJE?</b></font></font></p>
<p class="western" align="justify" lang="es-ES"><font color="#FFFFFF"><font size="3"><b>Instrucciones:</b></font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#FFFFFF"><font size="3"> </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#FFFFFF"><font size="3"> Para
utilizar el instrumento usted debe conceder una calificación alta a
aquellas palabras que mejor caracterizan la forma en que usted
aprende, y una calificación baja a las palabras que menos
caracterizan su estilo de aprendizaje.</font></font></p>

<p class="western" lang="es-ES"> Le puede ser difícil seleccionar
las palabras que mejor describen su estilo de aprendizaje, ya que no
hay respuestas correctas o incorrectas.</p>

<p class="western" align="justify" lang="es-ES"><font color="#FFFFFF"><font size="3"> Todas
las respuestas son buenas, ya que el fin del instrumento es describir
cómo y no juzgar su habilidad para aprender.</font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#FFFFFF"><font size="3"> De
inmediato encontrará nueve series o líneas de cuatro palabras cada una.
Ordene de mayor a menor cada serie o juego de cuatro palabras que hay en cada línea,
ubicando 4 en la palabra que mejor caracteriza su estilo de
aprendizaje, un 3 en la palabra siguiente en cuanto a la
correspondencia con su estilo; a la siguiente un 2, y un 1 a la
palabra que menos caracteriza su estilo. Tenga cuidado de ubicar un
número distinto al lado de cada palabra en la misma línea. </font></font></p>

<big><big><br>
Yo aprendo...</big></big>
<form id="estilo "name="estilo" method="POST" >
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c1" name="c1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
discerniendo<br>
        </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c2" name="c2">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
ensayando<br>
        </td>
        <td style="vertical-align: top;">
        <select id="c3" name="c3">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
involucrándome</td>
        <td style="vertical-align: top;">
        <select id="c4" name="c4">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
practicando</td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c5" name="c5">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
receptivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c6" name="c6">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
relacionando </td>
        <td style="vertical-align: top;">
        <select id="c7" name="c7">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
analíticamente </td>
        <td style="vertical-align: top;">
        <select id="c18" name="c8">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
imparcialmente </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c9" name="c9">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
sintiendo </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c10" name="c10">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select id="c11" name="c11">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pensando </td>
        <td style="vertical-align: top;">
        <select id="c12" name="c12">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
haciendo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c13" name="c13">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aceptando </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c14" name="c14">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
arriesgando </td>
        <td style="vertical-align: top;">
        <select id="c15" name="c15">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
evaluando </td>
        <td style="vertical-align: top;">
        <select id="c16" name="c16">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
con cautela </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c17" name="c17">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
intuitivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c18" name="c18">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
productivamente </td>
        <td style="vertical-align: top;">
        <select id="c19" name="c19">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
lógicamente </td>
        <td style="vertical-align: top;">
        <select id="c20" name="c20">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
cuestionando </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c21" name="c21">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abstracto </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c22" name="c22">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select id="c23" name="c23">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
concreto </td>
        <td style="vertical-align: top;">
        <select id="c24" name="c24">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
activo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c25" name="c25">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado al presente </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c26" name="c26">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reflexivamente </td>
        <td style="vertical-align: top;">
        <select id="c27" name="c27">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado hacia el futuro </td>
        <td style="vertical-align: top;">
        <select id="c28" name="c28">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pragmático </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c29" name="c29">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experiencia </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c30" name="c30">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la observación </td>
        <td style="vertical-align: top;">
        <select id="c31" name="c31">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la conceptualización </td>
        <td style="vertical-align: top;">
        <select id="c32" name="c32">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experimentación </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select id="c33" name="c33">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
emotivo </td>
        <td style="vertical-align: top; width: 25%;">
        <select id="c34" name="c34">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reservado </td>
        <td style="vertical-align: top;">
        <select id="c35" name="c35">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
racional </td>
        <td style="vertical-align: top;">
        <select id="c36" name="c36">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abierto </td>
      </tr>

    </tbody>
  </table>
  <br>

  <button type="submit" name="accion" value="Calcular" >Calcular</button>
</form>


<form method="GET">

ESTILO DE APRENDIZAJE &nbsp;&nbsp; <input type="text" name="ESTILOFINAL" value="<?php echo $resultado?>">
    <br>
    <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font>


</form>

<?php include("template/footer.php")?>