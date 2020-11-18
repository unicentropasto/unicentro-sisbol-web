<!-- Guarda la Edicion del  Premio -->
<HTML>
<head>
<title>Elimina Barrio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_barrio1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();

$consulta="SELECT id_barrio FROM sisbol.cliente WHERE id_barrio='$_GET[id_barrio]'";
//echo $consulta;
$consulta=pg_query($link,$consulta);
if(pg_num_rows($consulta)==0){
	$sql="DELETE FROM sisbol.barrio WHERE id_barrio='$_GET[id_barrio]'";
	//echo $sql;
	pg_query($link,$sql);	
}
pg_close($link);
?>

</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
