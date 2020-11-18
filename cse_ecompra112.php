<!-- Cambia el estado de la compra para imprimir la boleta -->
<HTML>
<head>
<title>Activa la compra para impresion de las boletas</title>
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
$sql_="UPDATE sisbol.boleta SET impr_bol='N' WHERE codi_bol='$_GET[codi_bol]'";
//echo $sql_;
pg_query($link,$sql_);
pg_close($link);
echo "<body onload='javascript:cargar($_GET[codi_bol],$_GET[id_camp])'>";
?>
</body>
</HTML>
