<!-- Guarda la Edicion del  Premio -->
<HTML>
<head>
<title>Guarda la Edicion del Premio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_barrio1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE sisbol.barrio SET comuna_bar='$_POST[comuna_bar]',nombre_bar='$_POST[nombre_bar]' WHERE id_barrio='$_POST[id_barrio]'";
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
