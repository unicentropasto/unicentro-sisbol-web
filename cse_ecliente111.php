<!-- Guarda la Edicion del Cliente -->
<HTML>
<head>
<title>Guarda Edicion de Cliente</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_ecliente1.php?codi_cli="+codi_,"fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$fnac_cli=cambiafecha($_POST['fnac_cli']);
$consultacli="SELECT codi_cli FROM sisbol.cliente WHERE tpid_cli='$_POST[tpid_cli]' AND nrod_cli='$_POST[nrod_cli]' and codi_cli<>$_POST[codi_cli]";
$consultacli=pg_query($link,$consultacli);
if(pg_num_rows($consultacli)==0){
  $sql="UPDATE sisbol.cliente SET tpid_cli='$_POST[tpid_cli]',nrod_cli='$_POST[nrod_cli]',exped_cli='$_POST[exped_cli]',nomb_cli='$_POST[nomb_cli]',apel_cli='$_POST[apel_cli]',dire_cli='$_POST[dire_cli]',tele_cli='$_POST[tele_cli]',fnac_cli='$fnac_cli',sexo_cli='$_POST[sexo_cli]',emai_cli='$_POST[emai_cli]',prof_cli='$_POST[prof_cli]',id_barrio='$_POST[id_barrio]'
               WHERE codi_cli='$_POST[codi_cli]'";
  //echo $sql;
  pg_query($link,$sql);
  pg_close($link);
  echo "<body onload='javascript:cargar(\"$_POST[codi_cli]\")'>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La identificación pertenece a otro cliente</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='cargar(\"$_POST[codi_cli]\")'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='cargar(\"$_POST[codi_cli]\")'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
</body>
</HTML>
