<!-- Guarda la Edicion de la entidad -->
<HTML>
<head>
<title>Guarda Edicion de la Entidad</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_enti1.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones
include("funciones.php");
$fini_sor=cambiafecha($_POST['fini_sor']);
$ffin_sor=cambiafecha($_POST['ffin_sor']);
$link=conectarbd();
$sql_="UPDATE sisbol.entidad SET nit_ent='$_POST[nit_ent]',nomb_ent='$_POST[nomb_ent]',valxb_ent='$_POST[valxb_ent]',fini_sor='$fini_sor',ffin_sor='$ffin_sor'";
pg_query($link,$sql_);
pg_close($link);
?>
<body onload='javascript:cargar()'>
</body>
</HTML>
