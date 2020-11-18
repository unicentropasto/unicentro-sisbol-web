<!-- Captura de parametros para el informe -->
<HTML>
<head>
<title>Informe de Clientes</title>
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
<body>
<form name='form1' method='post' action='cse_icliente11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros para el Informe de Clientes</td></tr>
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
	    <option value='apel_cli'>Apellidos
		<option value='nomb_cli'>Nombres
		<option value='nrod_cli'>Identificación
	  </select>	  
	  <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
  <tr>
	<td class='Td2' align='right'><input type='checkbox' name='correo'></td>
	<td class='Td2' align='left' colspan='2'>Generar Grupo de Correos</td>
  </tr>
</table>

</form>
</body>
</HTML>