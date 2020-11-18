<!-- Plan de premios -->
<HTML>
<head>
<title>Plan de Premios</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
  document.form1.submit();
}
function borrar(codi_pre,desc_pre){
  if(confirm("Desea eliminar el premio:\n"+desc_pre)){
    window.open("cse_plan13.php?codi_pre="+codi_pre,"fr03");
  }
//cse_plan13.php?codi_pre=$rowpre[codi_pre]
}
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.fsor_ppm.value == "") { a += " Fecha del sorteo\n";}
	  if (document.form1.nota_ppm.value == "") { a += " Nota para el sorteo\n";}
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
<form name='form1' method='post' action='cse_plan14.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Plan de Premios</td></tr>
</table>
<br>
<?php
$consultappm="SELECT codi_ppm,fsor_ppm,nota_ppm FROM sisbol.plan_premio";
$consultappm=pg_query($link,$consultappm);
$rowppm=pg_fetch_array($consultappm);
?>
<table class='Tbl0' border='0'>
  <tr>
	<td class='Td2' width='20%' align='right'>Fecha del Sorteo:</td>
	<td class='Td2'><input type='text' name='fsor_ppm' size='10' maxlength='10' value='<?php echo cambiafechadmy($rowppm['fsor_ppm']);?>'></td>
  </tr>
  <tr>
	<td class='Td2' width='20%' align='right'>Nota Para el Sorteo:</td>
	<td class='Td2'><textarea name='nota_ppm' rows='6' cols='150'><?php echo $rowppm['nota_ppm'];?></textarea>
    <!--<input type='text' name='nota_ppm' size='110' maxlength='200' value=''>-->
	<a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' title='Guardar'></a>
	</td>
  </tr>
</table>
<table class='Tbl0' border='0'>
  <th class='Th0' width='10%' colspan='3'>Opciones</th>
  <th class='Th0' width='90%'>Descripción</th>
  <?php
  $consultapre="SELECT codi_pre,desc_pre FROM sisbol.premio WHERE codi_ppm='$rowppm[codi_ppm]'";
  ECHO $consultapre;
  $consultapre=pg_query($link,$consultapre);
  while($rowpre=pg_fetch_array($consultapre)){
	echo "<tr>";
	echo "<td class='Td2'><a href='cse_plan12.php?codi_pre=$rowpre[codi_pre]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' title='Editar'></a></td>";
	echo "<td class='Td2'></td>";
	echo "<td class='Td2'><a href='#' onclick='borrar(\"$rowpre[codi_pre]\",\"$rowpre[desc_pre]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' title='Borrar'></a></td>";
	echo "<td class='Td2'>$rowpre[desc_pre]</td>";
	echo "</tr>";
  }
  ?>  
</table>
<br>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='cse_plan11.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='cse_plan11.php'>Nuevo</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
pg_close($link);
?>
</body>
</HTML>