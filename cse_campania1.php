<!-- Campañas -->
<HTML>
<head>
<title>Campaña</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function buscar(){
  document.form1.submit();
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$id_camp="";
$nombre_camp="";

if(isset($_POST['id_camp'])){$id_camp=$_POST['id_camp'];}
if(isset($_POST['nombre_camp'])){$nombre_camp=$_POST['nombre_camp'];}
echo $nombre_camp;
?>
</head>
<body>
<form name='form1' method='post' action='cse_campania1.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Campañas</td></tr>
</table>
<br>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Nombre de la Campaña:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nombre_camp' size='150' maxlength='150' value='<?php echo $nombre_camp;?>'>
    <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
    </td>
  </tr>
</table>

<?php
$condicion='';
if(!empty($id_camp)){
  $condicion=$condicion."id_camp = '".$id_camp."'";
}
if(!empty($nombre_camp)){
  $condicion=$condicion."nombre_camp LIKE '%".$nombre_camp."%'";
}

$consulta="SELECT id_camp,nombre_camp,fechafin_camp,numpersonas_camp,valor_camp,numeroboleta_camp,estado_camp
FROM sisbol.campania";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
//echo $consulta;
$consulta=pg_query($link,$consulta);
if(pg_num_rows($consulta)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Sin Registros</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Listado de Campañas</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0'>Opciones</th>
    <th class='Th0'>Nombre de la Campaña</th>
    <th class='Th0'>Fecha Final</th>
    <th class='Th0'>Número de Personas</th>
    <th class='Th0'>Valor</th>
    <th class='Th0'>Boleta</th>
    <th class='Th0'>Estado</th>
  <?php
  while($row=pg_fetch_array($consulta)){
    echo "<tr>";
    echo "<td class='Td2'><a href='cse_campania12.php?id_camp=$row[id_camp]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' title='Editar'></a></td>";
    echo "<td class='Td2'>$row[nombre_camp]</td>";
    echo "<td class='Td2'>$row[fechafin_camp]</td>";
    echo "<td class='Td2' align='right'>$row[numpersonas_camp]</td>";
    echo "<td class='Td2' align='right'>$row[valor_camp]</td>";
    echo "<td class='Td2' align='right'>$row[numeroboleta_camp]</td>";
    echo "<td class='Td2' align='center'>$row[estado_camp]</td>";
    echo "</tr>";
  }
  ?>
  </table>
  <?php
}
?>
<br>
<table class='Tb0' width='70%'>
  <tr>
    <td class='Td2' width='25%' align='right'><a href='cse_campania11.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Regresar' title="Crear nueva Campaña"></a></td>
    <td class='Td2' width='25%' align='left'><a href='cse_campania11.php' title="Crear nueva Campaña">Nueva Campaña</a></td>
  </tr>
</table>

</form>
<?php
pg_close($link);
?>
</body>
</HTML>