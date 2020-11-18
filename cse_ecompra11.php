<!-- Listado de compras para su edicion -->
<HTML>
<head>
<title>Listado de Edicion de Compras</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
<script language='javascript'>
function expandir(codi_bol){
    document.form1.expan_.value=codi_bol;
    document.form1.submit();
}
function anular(codi_,camp_){
var url=''
	if(confirm('Desea anular el registro: ')){
		url="cse_ecompra113.php?codi_bol="+codi_+"&id_camp="+camp_;
		window.open(url,'fr05');
	}
}
</script>
</head>
<body>
<form name='form1' method='post' action='cse_ecompra11.php'>
<?php
$nrod_cli="";
$nombre="";
$orden="";
$fech_bol="";
$id_camp="";

if(isset($_POST['nrod_cli'])){$nrod_cli=$_POST['nrod_cli'];}
if(isset($_POST['nomb_cli'])){$nombre=$_POST['nomb_cli'];}
if(isset($_POST['orden'])){$orden=$_POST['orden'];}
if(isset($_POST['fech_bol'])){$fech_bol=$_POST['fech_bol'];}
if(isset($_POST['id_camp'])){$id_camp=$_POST['id_camp'];}
if(isset($_GET['id_camp'])){$id_camp=$_GET['id_camp'];}

$expan_='';
if(isset($_POST['expan_'])){$expan_=$_POST['expan_'];}

$condicion="id_camp='$id_camp' and ";
if(!empty($_POST['nrod_cli'])){
  $condicion=$condicion."cl.nrod_cli='$_POST[nrod_cli]' and ";}
if(!empty($_POST['nomb_cli'])){
  $condicion=$condicion."cl.nomb_cli like '$_POST[nomb_cli]%' and ";}
/*if(!empty($_POST['apel_cli'])){
  $condicion=$condicion."cl.apel_cli like '$_POST[apel_cli]%' and ";}*/
if(!empty($_POST['fech_bol'])){
  $condicion=$condicion."bol.fech_bol = '$_POST[fech_bol]' and ";}
if(!empty($_POST['codi_bol'])){//Esta variable viene de cse_ecompra1111.php
  $condicion=$condicion."bol.codi_bol='$_POST[codi_bol]' and ";}
if(!empty($_GET['codi_bol'])){//Esta variable viene de cse_ecompra1111.php
  $condicion=$condicion."bol.codi_bol='$_GET[codi_bol]' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));

$consulta="SELECT bol.codi_bol,bol.fech_bol,bol.impr_bol,bol.anul_bol,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre FROM sisbol.boleta as bol INNER JOIN sisbol.cliente as cl ON cl.codi_cli=bol.codi_cli";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='cl.nomb_cli';
}
$consulta=$consulta." ORDER BY $orden";
//echo "<br>".$consulta;
$consultacom=pg_query($link,$consulta);
if(pg_num_rows($consultacom)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrados</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Compras</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' width='20%' colspan='4'>Opcion</th>
    <th class='Th0' width='10%'>Ident/Doc</th>
    <th class='Th0' width='40%'>Nombre/Local</th>
    <th class='Th0' width='10%'>Fecha</th>
    <th class='Th0' width='10%'>Valor</th>
    <th class='Th0' width='10%'>Estado</th>
	<?php
	while($rowcom=pg_fetch_array($consultacom)){
          $valor=0;
          $consultacom2="SELECT SUM(valo_com) AS valor FROM sisbol.compra WHERE codi_bol='$rowcom[codi_bol]'";
          //echo $consultacom2;
          $consultacom2=pg_query($link,$consultacom2);
          if(pg_num_rows($consultacom2)<>0){
              $rowcom2=pg_fetch_array($consultacom2);
              $valor=$rowcom2['valor'];
          }
	  echo "<tr>";
	  if($rowcom['anul_bol']=='S'){
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></td>";
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' title='Boleta Impresa Anteriormente'></td>";
              echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' title='Anular Documento'></td>";
	  }
	  else{
              echo "<td class='Td2'><a href='cse_ecompra111.php?codi_bol=$rowcom[codi_bol]&id_camp=$id_camp'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' title='Editar'></a></td>";
	      if($rowcom['impr_bol']=='S'){
                  echo "<td class='Td2'><a href='cse_ecompra112.php?codi_bol=$rowcom[codi_bol]&id_camp=$id_camp'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' title='Activar Impresion de Boleta'></a></td>";
              }
              else{
                    echo "<td class='Td2'><a href='cse_prnboleta.php?codi_bol=$rowcom[codi_bol]' target='blank'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' title='Imprimir Boletas'></a></td>";
	      }
              echo "<td class='Td2'><a href='#' onclick='anular(\"$rowcom[codi_bol]\",\"$id_camp\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' title='Anular Registro'></a></td>";
	  }
          echo "<td class='Td2'><a href='#' onclick='expandir(\"$rowcom[codi_bol]\")'><img src='img/32px-Crystal_Clear_action_tab_new.png' border=0 height='20' width='20' title='Expandir Compras'></a></td>";
	  echo "<td class='Td2'>$rowcom[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcom[nombre]</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowcom['fech_bol'])."</td>";
          echo "<td class='Td2' align='right'>$valor</td>";
	  if($rowcom['anul_bol']=='S'){echo "<td class='Td2' align='center'>Anulada</td>";}
	  else{echo "<td class='Td2' align='right'></td>";}	  
	  echo "</tr>";
          if($rowcom['codi_bol']==$expan_){
              $consultadoc="SELECT com.ndoc_com,com.fech_com,com.valo_com,loc.desc_tip as local
                  FROM sisbol.compra AS com
                  INNER JOIN sisbol.tipo AS loc ON loc.codi_tip=com.loca_com
                  WHERE codi_bol='$rowcom[codi_bol]'";
              //echo "<br>".$consultadoc;
              $consultadoc=pg_query($link,$consultadoc);
              if(pg_num_rows($consultadoc)<>0){
                  while($rowdoc=pg_fetch_array($consultadoc)){
                      echo "<tr>";
                      echo "<td class='Td2' align='right' colspan='4'></td>";
                      echo "<td class='Td2' align='right'>$rowdoc[ndoc_com]</td>";
                      echo "<td class='Td2' align='right'>$rowdoc[local]</td>";
                      echo "<td class='Td2' align='right'>".cambiafechadmy($rowdoc['fech_com'])."</td>";
                      echo "<td class='Td2' align='right'>$rowdoc[valo_com]</td>";
                      echo "</tr>";
                  }
              }
          }
          
	}
	?>
  </table>
  <?php
}

echo "<input type='hidden' name='nrod_cli' value='$nrod_cli'>";
echo "<input type='hidden' name='nomb_cli' value='$nombre'>";
//echo "<input type='hidden' name='apel_cli' value='$apel_cli'>";
echo "<input type='hidden' name='orden' value='$orden'>";
echo "<input type='hidden' name='fech_bol' value='$fech_bol'>";
echo "<input type='hidden' name='codi_bol' value=''>";
echo "<input type='hidden' name='expan_' value=0>";
echo "<input type='hidden' name='id_camp' value='$id_camp'>";
?>
</form>
<?php
pg_close($link);
?>
</body>
</HTML>