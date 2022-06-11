<?php include("template/header.php")?>
<?php 

include "profesor_algoritmo.php";

/*Estos son los valores ingresados por el usuario*/
$a=(isset($_POST['a']))?$_POST['a']:"";
$b=(isset($_POST['b']))?$_POST['b']:"";
$c=(isset($_POST['c']))?$_POST['c']:"";
$d=(isset($_POST['d']))?$_POST['d']:"";
$e=(isset($_POST['e']))?$_POST['e']:"";
$f=(isset($_POST['f']))?$_POST['f']:"";
$g=(isset($_POST['g']))?$_POST['g']:"";
$h=(isset($_POST['h']))?$_POST['h']:"";

/*Esta variable es la que se le mostrará al usuario con el resultado del algoritmo*/
$resultado = metodo_naive_bayes($a,$b,$c,$d,$e,$f,$g,$h);

?>
<p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES EL TIPO DE PROFESOR?</b></font></font></p>

Escoja las opciones para calcular el tipo de profesor...<big></big>
<form name="estilo" method = "POST">
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
        <tr>
            <td style="vertical-align: top; width: 25%;">
                <select name="a" id="a">
                    <option value="1">Profesor <= 30</option>
                    <option value="2">Profesor > 30 y <=55 </option>
                    <option value="3">Profesor < 55</option>
                </select>Edad del profesor<br>
            </td>
            <td style="vertical-align: top; width: 25%;">
                <select name="b" id="b">
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                    <option value="NA">NA</option>
                </select>Sexo<br>
            </td>
            <td style="vertical-align: top;">
                <select name="c" id="c">
                    <option value="B">Principiante</option>
                    <option value="I">Intermedio</option>
                    <option value="A">Avanzado</option>
                </select>Criterio de experienca<br>
            </td>
            <td style="vertical-align: top;">
                <select name="d" id="d">
                    <option value="1">Nunca</option>
                    <option value="2">1 a 5</option>
                    <option value="3">Mas de 5</option>
                </select>Veces que impartio el curso<br>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                <select name="e" id="e">
                    <option value="DM">Toma de decision</option>
                    <option value="ND">Diseño de red</option>
                    <option value="O">Otro</option>
                </select>Especialización<br>
            </td>
            <td style="vertical-align: top;">
                <select name="f" id="f">
                    <option value="L">Bajo</option>
                    <option value="A">Promedio</option>
                    <option value="H">Alto</option>
                </select>Habilidades computacionales<br>
            </td>
            <td style="vertical-align: top;">
                <select name="g" id="g">
                    <option value="N">Nunca</option>
                    <option value="S">A veces</option>
                    <option value="O">A menudo</option>
                </select>Experiencia en tecnología para la enseñanza<br>
            </td>
            <td style="vertical-align: top;">
                <select name="h" id="h">
                    <option value="N">Nunca</option>
                    <option value="S">A veces</option>
                    <option value="O">A menudo</option>
                </select>Experiencia usando un sitio web
            </td>
        </tr>
    </tbody>
</table>
<br>

<button type="submit" name="accion" value="Calcular" >Calcular</button>
</form>


<form method="GET">

TIPO DE PROFESOR &nbsp;&nbsp; <input type="text" name="ESTILOFINAL" value="<?php echo $resultado?>">
    <br>
    <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font>


</form>

<?php include("template/footer.php")?>