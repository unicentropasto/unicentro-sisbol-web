<?php
session_start();
if(isset($_GET['codi_gru'])){
  $_SESSION['gcodi_gru']=$_GET['codi_gru'];
  $_SESSION['gdesc_gru']=$_GET['desc_gru'];
}
?>
<!-- Muestra de Tipos Seleccionados -->
<HTML>
<head>
<title>Muestra Grupos</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function nuevo()
{
  document.form1.submit();
}

function eliminar(codigo,descrip)
{
  if(window.confirm("Desea borrar este registro?\n\n"+descrip)){
	location.href = "cse_hgrupos113.php?codi_tip="+codigo;
  }
}
</script>

<?php
//Aqui cargo las funciones 
include("funciones.php");
?>
</head>
<body>
<form name='form1' method='post' action='cse_hgrupos111.php'>
<table class='Tb0' width='70%'>
  <tr><td class='Td0' align='center'><?php echo $_SESSION['gdesc_gru'];?></td></tr>
</table>
<br>
<?php
  $link=conectarbd();
  if($_SESSION['gcodi_gru']=='03'){
      $consulta="SELECT tipo.codi_tip,tipo.desc_tip,vw_categoria.desc_tip AS valo_tip,tipo.fijo_tip FROM sisbol.tipo 
      LEFT JOIN sisbol.vw_categoria ON vw_categoria.codi_tip=tipo.valo_tip
      WHERE codi_gru='$_SESSION[gcodi_gru]' ORDER BY desc_tip";
  }
  else{
    $consulta="SELECT codi_tip,desc_tip,valo_tip,fijo_tip FROM sisbol.tipo WHERE codi_gru='$_SESSION[gcodi_gru]' ORDER BY desc_tip";  
  }
  
  $consulta=pg_query($link,$consulta);
  if(pg_num_rows($consulta)<>0){
    echo "<table class='Tb0' width='70%'>";
	   echo "<th class='Th0' colspan=2>Opciones</th>
	      <th class='Th0'>Descripción</th>
		  <th class='Th0'>Valor</th>";
    while($row=pg_fetch_array($consulta)){
      echo "<tr>";	  
      echo "<td class='Td2'><a href='cse_hgrupos112.php?codi_tip=$row[codi_tip]&desc_tip=$row[desc_tip]&valo_tip=$row[valo_tip]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Modificar'></a></td>";
	    if($row['fijo_tip']=="N"){
		    ?>
	      <td class='Td2' width='10%'><a href='#' onclick="eliminar('<?php echo $row['codi_tip'];?>','<?php echo $row['desc_tip'];?>')"><img src='img/32px-Crystal_Clear_filesystem_trashcan_full.png' border=0 height='20' width='20' alt='Eliminar'></a></td>
		    <?php
		  }
	    else{
	     echo "<td class='Td2' width='10%'><img src='img/32px-Crystal_Clear_action_1uparrow.png' border=0 height='20' width='20' alt='Fijo'></td>";}
	   echo "<td class='Td2' width='60%'>$row[desc_tip]</td>";
	   echo "<td class='Td2' width='20%'>$row[valo_tip]</td>";
	   echo "</tr>";
	   }
	   echo "</table>";
  }
  echo "<br><table class='Tb0' width='70%'>";
  echo "<tr><td class='Td2' width='25%' align='right'><a href='#' onclick='nuevo()'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='25' width='25' alt='Nuevo'></a></td>";
  echo "<td class='Td2' width='25%'><a href='#' onclick='nuevo()'>Nuevo</a></td>";
  echo "<td class='Td2' width='25%' align='right'><a href='cse_hgrupos.php'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='25' width='25' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%'><a href='cse_hgrupos.php'>Regresar</a></td></tr>";
  echo "</table>";
  
  pg_free_result($consulta);
  pg_close($link);
?>
</form>
</body>
</HTML>
