<!-- Busca Clientes -->
<HTML>
<head>
<title>Busca Clientes</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras()
{
  window.open("cse_ccompra1.php","fr03");
}
function cargar(codigo_){
  window.open("cse_ccompra1.php?codi_cli="+codigo_,"fr03");
}
function buscar(){
  document.form1.submit();
}

</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_ccompra12.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Busqueda de Clientes</td></tr>
</table>
<br>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' onblur='recarga()' value='<?php echo $_POST['nrod_cli'];?>'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
    <td class='Td2' width='20%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $_POST['nomb_cli'];?>'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='40%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $_POST['apel_cli'];?>'><a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a></td>
  </tr>
</table>

<?php
$condicion='';
if(!empty($_POST['nrod_cli'])){
  $condicion=$condicion."nrod_cli='$_POST[nrod_cli]' and ";}
if(!empty($_POST['nomb_cli'])){
  $condicion=$condicion."nomb_cli like '$_POST[nomb_cli]%' and ";}
if(!empty($_POST['apel_cli'])){
  $condicion=$condicion."apel_cli like '$_POST[apel_cli]%' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
if(empty($condicion)){$condicion="codi_cli=1 ";}
$consulta="SELECT codi_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli FROM sisbol.cliente";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
$consulta=$consulta."ORDER BY nomb_cli";
//echo $consulta;
$consultacli=pg_query($link,$consulta);
if(pg_num_rows($consultacli)==0){
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrado</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0' width='100%'>
    <tr><td class='Td1' align='center'>Clientes Encontrados</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' width='5%'>Sel</th>
    <th class='Th0' width='15%'>Nro Identif</th>
    <th class='Th0' width='15%'>Nombres</th>
    <th class='Th0' width='20'>Apellidos</th>
    <th class='Th0' width='25%'>Dirección</th>
    <th class='Th0' width='20%'>Teléfono</th>
    
	<?php
	while($rowcli=pg_fetch_array($consultacli)){
	  echo "<tr>";
	  echo "<td class='Td2'><input type='checkbox' name='codigo' onclick='cargar(\"$rowcli[codi_cli]\")'></td>";
	  echo "<td class='Td2'>".$rowcli['nrod_cli']."</td>";
	  echo "<td class='Td2'>".$rowcli['nomb_cli']."</td>";
	  echo "<td class='Td2'>".$rowcli['apel_cli']."</td>";
	  echo "<td class='Td2'>".$rowcli['dire_cli']."</td>";
	  echo "<td class='Td2'>".$rowcli['tele_cli']."</td>";
	  echo "</tr>";
	}
	?>
    
  </table>
  <?php
}
?>  
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>

<br>
<table class='Tbl0' width='70%'>
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