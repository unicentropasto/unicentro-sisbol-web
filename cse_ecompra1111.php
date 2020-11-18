<!-- Guarda la Edicion de la Compra -->
<HTML>
<head>
<title>Guarda Edicion de la Compra</title>
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

$fech_=cambiafecha($_POST['fech_com_e']);

$sql_="UPDATE sisbol.compra SET loca_com='$_POST[loca_com_e]',tdoc_com='$_POST[tdoc_com_e]',ndoc_com='$_POST[ndoc_com_e]',fech_com='$fech_' WHERE codi_com='$_POST[codi_com_e]'";
//echo "<br>".$sql_;
pg_query($link,$sql_);
pg_close($link);
echo "<body onload='javascript:cargar($_POST[codi_bol],$_POST[id_camp])'>";
?>
</body>
</HTML>
