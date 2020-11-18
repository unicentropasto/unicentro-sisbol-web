<!-- Edita Entidad -->
<HTML>
<head>
<title>Configuracion</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function atras(){
  window.open("cse_blank.html","fr03");
}

function iniciar_(opc_){
if(opc_==1){
		if(confirm("Está a punto de INICIAR la boletería en 1 (UNO)\n Desea Continuar?")){
			document.form1.opc.value=opc_;
			document.form1.submit();
		}
	}
	else{
		if(confirm("Está a punto de ELIMINAR todos los registros de Facturación\n Desea Continuar?")){
			document.form1.opc.value=opc_;
			document.form1.submit();
		}
	}
}

</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_reset.php'>
<table class='Tbl0' width='100%'>
  <tr>
    <td class='Td0' align='center'>Configurar</td></tr>
</table>
<br><br><br><br><br>
<?php
$consulta="SELECT nume_bol FROM sisbol.entidad";
$consulta=pg_query($link,$consulta);
$row=pg_fetch_array($consulta);
$consultafac="SELECT count(*) AS nfacturas FROM sisbol.compra";
$consultafac=pg_query($link,$consultafac);
$rowfac=pg_fetch_array($consultafac);
?>
<table class='Tbl0' width='100%' border='0'>
<tr>
  <td class='Td2' align='right'>Consecutivo de Boletas:</td>
  <td align='left' valign="middle" class='Td2'><input name="nume_bol" type="text" disabled value="<?php echo $row['nume_bol'];?>" size="10"><a href='#' onclick='iniciar(1)' title='Iniciar Consecutivo'><img src='img/32px-Crystal_Clear_filesystem_trashcan_full.png' border=0 height='27' width='25' alt='Iniciar Consecutivo'></a></td>
  <td class='Td2' align='right'>Facturas Registradas:</td>
  <td align='left' valign="middle" class='Td2'><input name='nfacturas' type='text' disabled value='<?php echo $rowfac['nfacturas'];?>' size='5' maxlength='5' >
    <a href='#' onclick='iniciar(2)' title='Eliminar Facturas'><img src='img/32px-Crystal_Clear_filesystem_trashcan_full.png' border=0 height='27' width='25' alt='Eliminar Facturas'></a></td>
</tr>
</table>
<input name='opc' type='hidden' value="">
<br>
<table class='Tb0' width='70%'>
  <tr>
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