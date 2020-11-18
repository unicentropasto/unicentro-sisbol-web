<!-- Barrios -->
<HTML>
<head>
<title>Barrios</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
  document.form1.submit();
}
function borrar(id_barrio,nombre_bar){
  if(confirm("Desea borrar este barrio:\n"+nombre_bar)){
    window.open("cse_barrio13.php?id_barrio="+id_barrio,"fr03");
  }

}

</script>
<?php
$comuna="";
$nombre="";
if(isset($_POST['comuna'])){$comuna=$_POST['comuna'];}
if(isset($_POST['nombre'])){$nombre=$_POST['nombre'];}
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_barrio1.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Barrios</td></tr>
</table>
<br>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Comuna/Corregimiento:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='comuna' size='10' maxlength='20' value='<?php echo $comuna;?>'></td>
    <td class='Td2' width='10%' align='right'>Nombre del Barrio:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nombre' size='25' maxlength='25' value='<?php echo $nombre;?>'>
    <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
    </td>
  </tr>
</table>

<table class='Tbl0' border='0'>
  <th class='Th0' width='10%' colspan='3'>Opciones</th>
  <th class='Th0' width='45%'>Comuna/Corregimiento</th>
  <th class='Th0' width='45%'>Nombre</th>
  <?php
  $condicion="";
  if(!empty($comuna)){$condicion=$condicion."comuna_bar LIKE '%$comuna%' AND ";}
  if(!empty($nombre)){$condicion=$condicion."nombre_bar LIKE '%$nombre%' AND ";}
  if(!empty($condicion)){
    $condicion=substr($condicion,0,-5);
    $condicion=" WHERE ".$condicion;
  }
  //echo "<br>condicion: ".$condicion;
  $consulta="SELECT id_barrio,comuna_bar,nombre_bar FROM sisbol.barrio ".$condicion."ORDER BY nombre_bar";
  //echo $consulta;
  $consulta=pg_query($link,$consulta);
  while($row=pg_fetch_array($consulta)){
  	echo "<tr>";
  	echo "<td class='Td2'><a href='cse_barrio12.php?id_barrio=$row[id_barrio]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' title='Editar'></a></td>";
  	echo "<td class='Td2'></td>";
  	echo "<td class='Td2'><a href='#' onclick='borrar(\"$row[id_barrio]\",\"$row[nombre_bar]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' title='Borrar'></a></td>";
  	echo "<td class='Td2'>$row[comuna_bar]</td>";
    echo "<td class='Td2'>$row[nombre_bar]</td>";
  	echo "</tr>";
  }
  ?>  
</table>
<br>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='cse_barrio11.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='cse_barrio11.php'>Nuevo</a></td>
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