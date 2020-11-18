<!--Anula el documento -->
<HTML>
<head>
<title>Anula el documento</title>
<Script Language="JavaScript">
function cargar(codi_,camp_) {
  window.open("cse_ecompra11.php?codi_bol="+codi_+"&id_camp="+camp_,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE sisbol.boleta SET anul_bol='S' WHERE codi_bol='$_GET[codi_bol]'";
//echo $sql;
pg_query($link,$sql);
//echo mysql_affected_rows();
pg_close($link);
echo "<body onload='javascript:cargar($_GET[codi_bol],$_GET[id_camp])'>";
?>
</body>
</HTML>
