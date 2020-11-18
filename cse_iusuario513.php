<!-- Inactiva/Activa Usuario del Sistema -->
<HTML>
<head>
<title>Inactiva/Activa Usuario del Sistema</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_eusuario51.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE sisbol.u_cliseb SET esta_ucs='$_GET[esta_ucs]' WHERE codi_ucs='$_GET[codi_ucs]'";
//echo $sql;
pg_query($link,$sql);
pg_close($link);
?>
<body onload='javascript:cargar()'>
</body>
</HTML>
