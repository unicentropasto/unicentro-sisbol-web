<!-- Guarda la Edicion del  Premio -->
<HTML>
<head>
<title>Guarda la Edicion del Premio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="DELETE FROM sisbol.premio WHERE codi_pre='$_GET[codi_pre]'";
echo $sql;
pg_query($link,$sql);
pg_close($link);
?>

</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
