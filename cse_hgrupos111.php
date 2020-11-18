<?php
session_start();
?>
<HTML>
<head>
<title>Captura de Tipos</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.desc_tip.value == "") { a += " Descripción\n"; }
    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
?>
</head>
<body>
<form name='form1' method='post' action='cse_hgrupos1111.php'>
<table class='Tb0' width='70%'>
  <tr><td class='Td0' align='center'>Crear Nuevo(a) <?echo $gdesc_gru;?></td></tr>
</table>
<br>
<table class='Tb0' width='70%'>
  <th class='Th0'>Descripción</th>
  <th class='Th0'>Valor</th>
  <tr>
    <td class='Td2' width='70%' align='center'><input type='text' name='desc_tip' size='50' maxlength='50'></td>
	<td class='Td2' width='30%' align='center'><input type='text' name='valo_tip' size='10' maxlength='10'></td>
  </tr>
</table>
<br>
<table class='Tb0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='25' width='25' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='25' width='25' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>


</form>
</body>
</HTML>
