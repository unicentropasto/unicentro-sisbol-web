<!-- Sorteo -->
<HTML>
<head>
<title>Sorteo</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function validar(){
  document.form1.submit();
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
srand(time());
?>
</head>
<body>
<form name='form1' method='post' action='cse_sorteo111.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Sorteo</td></tr>
</table>
<br>

<?php
$fecha_ini=cambiafecha($_POST['fecha_ini']);
$fecha_fin=cambiafecha($_POST['fecha_fin']);
$sql="SELECT min(codi_com) as minimo,max(codi_com) as maximo 
      FROM compra  
      WHERE fech_com>='$fecha_ini' and fech_com<='$fecha_fin' and esta_com='A'";
$consultapar=pg_query($link,$sql);
$rowpar=pg_fetch_array($consultapar);

echo "<table class='Tbl0' border='0'>";
echo "<th class='Th0'>Orden</th>";
echo "<th class='Th0'>Premio / Ganador</th>";

$consultaplan="SELECT codi_ppm,orde_ppm,desc_ppm
               FROM sisbol.plan_premio 
			         WHERE peri_ppm='$_POST[peri_ppm]' and esta_ppm='AC' ORDER BY $orde_ppm");

$consultaplan=pg_query($link,$consultaplan);
$cgan=0;
while($rowplan=pg_fetch_array($consultaplan)){
  echo "<tr>";
  echo "<td class='Td2'><b>".$rowplan['orde_ppm']."</td>";
  echo "<td class='Td2'><b>".$rowplan['desc_ppm']."</td>";
  echo "</tr>";
  $encontrado=0;
  while($encontrado==0){
    $ganador=rand($rowpar['minimo'],$rowpar['maximo']);
	  $consultagan="SELECT com.codi_com,com.tdoc_com,com.ndoc_com,com.fech_com,com.valo_com,
                cli.nrod_cli,cli.nomb_cli,cli.apel_cli,cli.tele_cli
                FROM sisbol.compra AS com 
				        INNER JOIN sisbol.cliente AS cli ON cli.codi_cli=com.codi_cli 
                WHERE com.codi_com=$ganador and esta_com='A'";
    $consultagan=pg_query($link,$consultagan);
		$encontrado=pg_num_rows($consultagan);
	  if($encontrado<>0){
  	  $rowgan=pg_fetch_array($consultagan);
  	  echo "<tr>";
  	  echo "<td class='Td2'></td>";
  	  echo "<td class='Td0'>".$rowgan['nrod_cli']." ".$rowgan['nomb_cli']." ".$rowgan['ape_cli']." ".$rowgan['tele_cli']."</td>";
  	  echo "</tr>";
  	  $var='codi_ppm'.$cgan;
  	  echo "<input type='hidden' name='$var' value='$rowplan[codi_ppm]'>";
  	  $var='codi_com'.$cgan;
  	  echo "<input type='hidden' name='$var' value='$rowgan[codi_com]'>";
	  }
  }
  $cgan++;
}
echo "</table>";
echo "<input type='hidden' name='cgan' value='$cgan'>";
?>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>
</form>
</body>
</HTML>