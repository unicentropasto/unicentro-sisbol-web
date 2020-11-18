<!-- Guarda las Campañas -->
<HTML>
<head>
<title>Guarda Campañas</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<Script Language="JavaScript">
function cargar() {
    form1.submit();
}
function regresar(){
  history.go(-1);
}
</Script>
<form name='form1' action='cse_campania1.php' method='post' target='fr03'>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();

$sql="INSERT INTO sisbol.campania (nombre_camp,mecanica_camp,fechafin_camp,actividad_camp,numpersonas_camp,valor_camp,numeroboleta_camp)
    VALUES ('$_POST[nombre_camp]','$_POST[mecanica_camp]','$_POST[fechafin_camp]','$_POST[actividad_camp]','$_POST[numpersonas_camp]','$_POST[valor_camp]','1')";
//echo $sql;
$res=pg_query($link,$sql);
$insert_row = pg_fetch_row($res);
$id_camp = $insert_row[0];

echo "<input type='hidden' name='id_camp' value='$id_camp'>";
pg_close($link);

?>

</form>
</body>
</HTML>
<script language='javascript'>cargar()</script>;