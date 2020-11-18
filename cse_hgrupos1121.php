<!-- Guarda el  Tipo -->
<HTML>
<head>
<title>Guarda Tipos</title>
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
$sql="UPDATE sisbol.tipo SET desc_tip='$_POST[desc_tip]',valo_tip='$_POST[valo_tip]' WHERE codi_tip='$_POST[codi_tip]'";
pg_query($link,$sql);
pg_close($link);
?>

</head>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">


</form>
</body>
</HTML>
