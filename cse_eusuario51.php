<!-- Busca Usuarios -->
<HTML>
<head>
<title>Edicion de Usuarios del Sistema</title>
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
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente1.php'>
<?php
$consulta="SELECT codi_ucs,iden_ucs,nomb_ucs,logi_ucs,esta_ucs FROM sisbol.u_cliseb ORDER BY nomb_ucs";
$consulta=pg_query($link,$consulta);
?>
<table class='Tbl0'>
  <tr><td class='Td1' align='center'>Listado de Usuarios del Sistema</td></tr>
</table>
<table class='Tbl0' width='70%' border='0'>
  <th class='Th0' width='10%' colspan='2'>Opciones</th>
  <th class='Th0' width='20%'>Nro Identif</th>
  <th class='Th0' width='40%'>Nombres</th>
  <th class='Th0' width='20%'>Login</th>
  <th class='Th0' width='10%'>Estado</th>
  <?php
  while($row=pg_fetch_array($consulta)){
    if($row['esta_ucs']=='A'){
  	  $estado='Activo';
  	  $nuevoest_usu='I';
  	  $tit='Inactivar';
  	  $img='img/32px-Crystal_Clear_action_tab_remove.png';
  	}
  	else{
  	  $estado='Inactivo';
  	  $nuevoest_usu='A';
  	  $tit='Activar';
  	  $img='img/32px-Crystal_Clear_action_tab_new.png';
    }
  echo "<tr>";
	echo "<td class='Td2'><a href='cse_eusuario511.php?codi_ucs=$row[codi_ucs]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' title='Editar'></a></td>";
	echo "<td class='Td2'><a href='cse_iusuario513.php?codi_ucs=$row[codi_ucs]&esta_ucs=$nuevoest_usu'><img src='$img' border=0 height='20' width='20' alt='".$tit."'></a></td>";
	echo "<td class='Td2'>$row[iden_ucs]</td>";
	echo "<td class='Td2'>$row[nomb_ucs]</td>";
	echo "<td class='Td2'>$row[logi_ucs]</td>";
	echo "<td class='Td2'>$estado</td>";
	echo "</tr>";
  }
  ECHO "aQUI";
  ?>  
</table>
<!--<input type='text' name='codi_cli' value="<?php echo $_GET[codi_cli];?>">-->
<br>
<table class='Tb0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='cse_nusuario512.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Crear Nuevo Usuario'></a></td>
  <td class='Td2' width='25%' align='left'><a href='cse_nusuario512.php'>Nuevo</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
pg_free_result($consulta);
pg_close($link);
?>
</body>
</HTML>