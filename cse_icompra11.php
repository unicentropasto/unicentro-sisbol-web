<!-- Informe de Compras -->
<HTML>
<head>
<title>Informe de Compras</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action=''>
<?php
$concampani="SELECT nombre_camp FROM sisbol.campania WHERE id_camp='$_POST[id_camp]'";
$concampani=pg_query($link,$concampani);
$rowcamp=pg_fetch_array($concampani);
$nombre_camp=$rowcamp['nombre_camp'];

$condicion="anul_bol='N' and ";
if(!empty($_POST['nrod_cli'])){
  $condicion=$condicion."nrod_cli='$_POST[nrod_cli]' and ";}
if(!empty($_POST['id_camp'])){
  $condicion=$condicion."id_camp='$_POST[id_camp]' and ";}
if(!empty($_POST['nomb_cli'])){
  $condicion=$condicion."nombre like '$_POST[nomb_cli]%' and ";}
//if(!empty($_POST['apel_cli'])){
//  $condicion=$condicion."apel_cli like '$_POST[apel_cli]%' and ";}
if(!empty($_POST['loca_com'])){
  $condicion=$condicion."loca_com='$_POST[loca_com]' and ";}
if(!empty($_POST['tdoc_com'])){
  $condicion=$condicion."tdoc_com='$_POST[tdoc_com]' and ";}
if(!empty($_POST['fechaini'])){
    $fechaini=cambiafecha($_POST['fechaini']);
    $condicion=$condicion."fech_com>='$fechaini' and ";}
if(!empty($_POST['fechafin'])){
    $fechafin=cambiafecha($_POST['fechafin']);
    $condicion=$condicion."fech_com<='$fechafin' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
/*$consulta="SELECT cl.codi_cli,cl.nrod_cli,cl.nomb_cli,cl.apel_cli,cl.dire_cli,cl.tele_cli,sexo_cli,fnac_cli,
           tp.valo_tip,co.ndoc_com,co.fech_com,co.valo_com,loc.desc_tip AS local 
           FROM compra as co
           INNER JOIN boleta AS bol ON bol.codi_bol=co.codi_bol
           INNER JOIN cliente as cl ON cl.codi_cli=bol.codi_cli
           INNER JOIN tipo as tp ON tp.codi_tip=co.tdoc_com
           INNER JOIN tipo AS loc ON loc.codi_tip=co.loca_com";*/
$consulta="SELECT codi_cli,nrod_cli,nombre,CONCAT(dire_cli,' ',nombre_bar) as direccion,tele_cli,sexo_cli,fnac_cli,
           tipo_doc_comp,ndoc_com,fech_com,valo_com,local 
           FROM sisbol.vw_compra";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='nombre';
}
//echo $consulta;
$consultacom=pg_query($link,$consulta);
if(pg_num_rows($consultacom)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Compras No Encontradas</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Listado Compras</td></tr>
  </table>
  Campaña:<?php echo $nombre_camp;?>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0'>Nro Identif</th>
    <th class='Th0'>Nombres</th>
	  <th class='Th0'>Direccion</th>
    <th class='Th0'>Teléfono</th>
	  <th class='Th0'>Sexo</th>
	  <th class='Th0'>Fecha Nac</th>
    <th class='Th0'>Local</th>
    <th class='Th0'>Docum</th>
    <th class='Th0'>Número</th>
    <th class='Th0'>Fecha</th>
    <th class='Th0'>Valor</th>    
	<?php
	while($rowcom=pg_fetch_array($consultacom)){
	  echo "<tr>";
	  echo "<td class='Td2'>$rowcom[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcom[nombre]</td>";
	  echo "<td class='Td2'>$rowcom[direccion]</td>";
	  echo "<td class='Td2'>$rowcom[tele_cli]</td>";
	  echo "<td class='Td2'>$rowcom[sexo_cli]</td>";
	  echo "<td class='Td2'>$rowcom[fnac_cli]</td>";
    echo "<td class='Td2'>$rowcom[local]</td>";
	  echo "<td class='Td2'>$rowcom[tipo_doc_comp]</td>";
	  echo "<td class='Td2'>$rowcom[ndoc_com]</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowcom['fech_com'])."</td>";
	  echo "<td class='Td2'>$rowcom[valo_com]</td>";
	  echo "</tr>";
	}
	?>
  </table>
  <?php
}
?>  
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>
</form>
<?php
pg_close($link);
?>
</body>
</HTML>