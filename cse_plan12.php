<!-- Edicion de premios -->
<HTML>
<head>
<title>Edicion del Premios</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_plan1.php","fr03");
}

function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.desc_pre.value == "") { a += " Descripción\n";}
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
<form name='form1' method='post' action='cse_plan121.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Editar Premio</td></tr>
</table>
<br>
<?php
$consultapre="SELECT codi_pre,desc_pre FROM sisbol.premio WHERE codi_pre='$_GET[codi_pre]'";
$consultapre=pg_query($link,$consultapre);
$rowpre=pg_fetch_array($consultapre);
?>
<table class='Tb0' width='100%' border='0'>
  <th class='Th0' width='5%'</th>
  <th class='Th0' width='10%'></th>
  <th class='Th0' width='10%'></th>
  <th class='Th0' width='75%'>Descripción</th>
  <tr>
    <td class='Td2'></td>
	<td class='Td2'></td>
	<td class='Td2'></td>
	<td class='Td2'><textarea name='desc_pre' rows='3' cols='150'><?php echo $rowpre['desc_pre'];?></textarea></td>
  </tr>
</table>
<input type='hidden' name='codi_pre' value='<?php echo $rowpre['codi_pre'];?>'>
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
pg_free_result($consultapre);
pg_close($link);
?>
</body>
</HTML>