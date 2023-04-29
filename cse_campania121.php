<!-- Guarda la Edicion de la Campaña -->
<HTML>
<head>
<title>Guarda Edicion de la Campaña</title>
<Script Language="JavaScript">
function cargar(id_) {
  window.open("cse_campania1.php?id_camp="+id_,"fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE sisbol.campania SET nombre_camp='$_POST[nombre_camp]',
mecanica_camp='$_POST[mecanica_camp]',
fechafin_camp='$_POST[fechafin_camp]',
actividad_camp ='$_POST[actividad_camp]',
numpersonas_camp ='$_POST[numpersonas_camp]',
valor_camp ='$_POST[valor_camp]',
estado_camp='$_POST[estado_camp]'
WHERE id_camp='$_POST[id_camp]'";
//echo $sql;
pg_query($link,$sql);
pg_close($link);

echo "<body onload='javascript:cargar(\"$_POST[id_camp]\")'>";

?>
</body>
</HTML>
