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
$sql="UPDATE sisbol.premio SET desc_pre='$_POST[desc_pre]' WHERE codi_pre='$_POST[codi_pre]'";

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
