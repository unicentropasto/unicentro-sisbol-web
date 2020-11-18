<!-- Guarda los Premios -->
<HTML>
<head>
<title>Guarda Barrio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_barrio1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="INSERT INTO sisbol.barrio(comuna_bar,nombre_bar) VALUES ('$_POST[comuna_bar]','$_POST[nombre_bar]')";
//echo $sql;
pg_query($link,$sql);
pg_close($link);
?>
<script language='javascript'>
  alert("registro"+<?echo mysql_affected_rows();?>);
</script>
</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
