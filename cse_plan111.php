<!-- Guarda los Premios -->
<HTML>
<head>
<title>Guarda Premios</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="INSERT INTO sisbol.premio(codi_ppm,desc_pre) VALUES (1,'$_POST[desc_pre]')";
pg_query($link,$sql);
pg_close($link);
?>
<script language='javascript'>
  alert("registro"+<?echo pg_affected_rows();?>);
</script>
</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
