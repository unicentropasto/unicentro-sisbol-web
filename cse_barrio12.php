<!-- Edicion de barrios -->
<HTML>
<head>
<title>Edicion del Barrio</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_barrio.php","fr03");
}

function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = "";
    if (document.form1.comuna_bar.value == "") { a += " Comuna o Corregimiento\n";}
    if (document.form1.nombre_bar.value == "") { a += " Nombre del barrio\n";}
    if (a != "") 
    { alert(error + a);return true;}
    document.form1.submit()
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_barrio121.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Editar Barrio</td></tr>
</table>
<br>
<?php
$consulta="SELECT id_barrio,comuna_bar,nombre_bar FROM sisbol.barrio WHERE id_barrio='$_GET[id_barrio]'";
//echo $consulta;
$consulta=pg_query($link,$consulta);
$row=pg_fetch_array($consulta);
?>
<table class='Tb0' width='100%' border='0'>
  <th class='Th0' width='10%' colspan="3"></th>
  <th class='Th0' width='45%'>Comuna o Corregimiento</th>
  <th class='Th0' width='45%'>Nombre</th>
  <tr>
    <td class='Td2'></td>
    <td class='Td2'></td>
    <td class='Td2'></td>
    <td class='Td2'><input type="text" name="comuna_bar" size="30" maxlength="30" value="<?php echo $row['comuna_bar'];?>"></td>
    <td class='Td2'><input type="text" name="nombre_bar" size="45" maxlength="45" value="<?php echo $row['nombre_bar'];?>"></td>
  </tr>
</table>
<input type='hidden' name='id_barrio' value='<?php echo $row['id_barrio'];?>'>
<br>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
pg_free_result($consulta);
pg_close($link);
?>
</body>
</HTML>