<!--Elimina el  Tipo -->
<HTML>
<head>
<title>Elimina Tipos</title>
<Script Language="JavaScript">
function cargar() {
var load = window.open('cse_hgrupos11.php','fr03','');
window.opener = top;
window.close();
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="DELETE FROM sisbol.tipo WHERE codi_tip='$_GET[codi_tip]'";
pg_query($link,$sql);
pg_close($link);
?>

</head>
<body onload="javascript:cargar()">


</form>
</body>
</HTML>
