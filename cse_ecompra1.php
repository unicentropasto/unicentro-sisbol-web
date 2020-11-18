<!-- Captura de parametros para la edicion de las compras -->
<HTML>
<head>
<title>Edicion de Compras</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
  document.form1.submit();
}
</script>

</head>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
require("abre_campania.php");
?>
<body>
<form name='form1' method='post' action='cse_ecompra11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'><h1>CAMPAÑA: <?php echo $nombre_camp;?></h1></td></tr>
</table>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros Editar Compras</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='10%' align='right'>Identificación:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
        <td class='Td2' width='10%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25'><a href='#' onclick='buscar()'></td>
	<td class='Td2' width='10%' align='right'>Orden:</td>
	<td class='Td2' width='30%' align='left'><select name='orden'>
		<option value='bol.fech_bol'>Fecha de Registro
                <option value='cl.apel_cli'>Apellidos
		<option value='cl.nomb_cli'>Nombres
		<option value='cl.nrod_cli'>Identificación
	  </select>
	</td>
  </tr>
   <tr>
	<td class='Td2' align='right'>Fecha de Registro:</td>
	<td class='Td2' align='left'><input type='text' name='fech_bol' size='10' maxlength='10'></td>
        <td class='Td2' align='left'><a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
  </tr>
  <input type="hidden" name="id_camp" value='<?php echo $id_camp;?>'>
</table>
</form>
</body>
</HTML>