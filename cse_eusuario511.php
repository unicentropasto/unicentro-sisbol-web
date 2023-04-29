<!-- Edicion de Datos del Usuario del Sistema -->
<HTML>
<head>
<title>Edita Usuario del Sistema</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.iden_ucs.value == "") { a += " Identificación\n"; }
    if (document.form1.nomb_ucs.value == "") { a += " Nombre\n"; }
    if (document.form1.logi_ucs.value == "") { a += " Login\n"; }
	if (document.form1.tipo_ucs.value == "") { a += " Tipo de Usuario\n"; }
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
$link=conectarbd();
$consulta="select iden_ucs,nomb_ucs,logi_ucs,clav_ucs,tipo_ucs from sisbol.u_cliseb where codi_ucs='".$_GET['codi_ucs']."'";
$consulta=pg_query($link,$consulta);
$row=pg_fetch_array($consulta);
?>
</head>
<body>
<form name='form1' method='post' action='cse_eusuario5111.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Editar Usuario del Sistema</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos Del Usuario del Sistema</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='20%' align='right'>Identificación:</td>
	<td class='Td2' width='30%' align='left'><input type='text' name='iden_ucs' size='20' maxlength='20' value='<?php echo $row['iden_ucs'];?>'></td>
  </tr>
  <tr>
	<td class='Td2' width='20%' align='right'>Nombre y Apellido:</td>
    <td class='Td2' width='30%' align='left'><input type='text' name='nomb_ucs' size='50' maxlength='50' value='<?php echo $row['nomb_ucs'];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Login:</td>
    <td class='Td2' align='left'><input type='text' name='logi_ucs' size='40' maxlength='40' value='<?php echo $row['logi_ucs'];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Clave:</td>
    <td class='Td2' align='left'><input type='password' name='clav_ucs' size='20' maxlength='20'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Tipo de Usuario:</td>
	<td class='Td2' align='left'><select name='tipo_ucs'>
	  <option value='2'>Usuario</option>
	  <option value='1'>Superusuario</option>
	  </select>
	</td>
  </tr>
</table>

<input type='hidden' name='codi_ucs' value='<?php echo $_GET['codi_ucs'];?>'>
<script language='javascript'>
document.form1.tipo_ucs.value='<?php echo $row[tipo_ucs];?>';
</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
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