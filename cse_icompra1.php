<!-- Captura de parametros para el informe -->
<HTML>
<head>
<title>Informe de Comras</title>
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
?>
<body>
<form name='form1' method='post' action='cse_icompra11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros para el Informe de Compras</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
   <tr>
	<td class='Td2' width='10%' align='right'>Campaña:</td>
	<td class='Td2' align='left' colspan="5"><select name='id_camp'>
	  <?php
	    $consultacamp="SELECT id_camp,nombre_camp FROM sisbol.campania ORDER BY estado_camp";
	    $consultacamp=pg_query($link,$consultacamp);
	    while($rowcamp=pg_fetch_array($consultacamp)){
	      echo "<option value='$rowcamp[id_camp]'>".$rowcamp['nombre_camp']."</option>";
	    }
	  ?>
	  </select>
	</td>
  </tr>
  <tr>
	<td class='Td2' width='10%' align='right'>Identificación:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25'></td>
	<!--<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25'></td>-->
	<td class='Td2' width='10%' align='right'>Orden:</td>
	<td class='Td2' width='30%' align='left'><select name='orden'>
		<option value='cl.nombre'>Nombres</option>
		<option value='cl.nrod_cli'>Identificación</option>
		<option value='co.fech_com'>Fecha Compra</option>
	  </select>	  
	  <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
  <tr>
	<td class='Td2' width='10%' align='right'>Local:</td>
	<td class='Td2' width='10%' align='left'><select name='loca_com'>
	  <option value=''>
	  <?php
	    $consultalo="SELECT codi_tip,desc_tip,valo_tip FROM sisbol.tipo WHERE codi_gru='03' ORDER BY valo_tip";
	    $consultalo=pg_query($link,$consultalo);
	    while($rowlo=pg_fetch_array($consultalo)){
	      echo "<option value='$rowlo[codi_tip]'>".$rowlo['valo_tip']." ".substr($rowlo['desc_tip'],0,15)."</option>";
	    }
	  ?>
	  </select>
	</td>
	<td class='Td2' width='10%' align='right'>Documento:</td>
    <td class='Td2' width='10%' align='left'><select name='tdoc_com'>
	<option value=''>
	<?php
	  $consultado="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='02'";
	  $consultado=pg_query($link,$consultado);
	  while($rowdo=pg_fetch_array($consultado)){
	    echo "<option value='$rowdo[codi_tip]'>$rowdo[desc_tip]"."</option>";
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Fecha Inicial:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='fechaini' size='10' maxlength='10'></td>
	<td class='Td2' width='10%' align='right'>Fecha Final:</td>
	<td class='Td2' width='30%' align='left'><input type='text' name='fechafin' size='10' maxlength='10'></td>
  </tr>
</table>

</form>
</body>
</HTML>