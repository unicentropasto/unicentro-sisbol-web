<!-- Edita Entidad -->
<HTML>
<head>
<title>Configuracion</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function atras(){
  window.open("cse_blank.html","fr03");
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_configurar.php'>
<table class='Tbl0' width='100%'>
  <tr>
    <td class='Td0' align='center'>Configurar</td></tr>
</table>
<br><br><br><br><br>
<?php
if($_POST['opc']==1){
	//echo $opc;
	$sql="UPDATE sisbol.entidad SET nume_bol='1'";
	//echo $sql;
	pg_query($link,$sql);
}
else{
	$sql="UPDATE sisbol.entidad SET nume_bol='1'";
	//echo $sql;
	pg_query($link,$sql);
	$sql="TRUNCATE TABLE compra";
	//echo $sql;
	pg_query($link,$sql);
	$sql="TRUNCATE TABLE boleta";
	//echo $sql;
	pg_query($link,$sql);
	$sql="TRUNCATE TABLE detalle_bol";
	//echo $sql;
	pg_query($link,$sql);
}
?>
</form>
<?php
pg_close($link);
?>
<script language='JavaScript'>
	document.form1.submit();
</script>
</body>
</HTML>