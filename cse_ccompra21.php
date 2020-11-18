<!-- Guarda las Clientes -->
<HTML>
<head>
<title>Guarda Clientes</title>
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
<form name='form1' action='cse_ccompra2.php' method='post' target='fr03'>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
if(!empty($_POST['fnac_cli'])){
  $fnac_cli=cambiafecha($_POST['fnac_cli']);
}
else{
  $fnac_cli='0000-00-00';
}
$hoy=cambiafecha(hoy());
//$puntos=floor($valo_com/1000);
$consulta="SELECT codi_cli FROM sisbol.cliente WHERE tpid_cli='$_POST[tpid_cli]' and nrod_cli='$_POST[nrod_cli]'";
$consulta=pg_query($link,$consulta);
if(pg_num_rows($consulta)==0){
  $sql="INSERT INTO sisbol.cliente (tpid_cli,nrod_cli,exped_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,id_barrio)
               VALUES ('$_POST[tpid_cli]','$_POST[nrod_cli]','$_POST[exped_cli]','$_POST[nomb_cli]','$_POST[apel_cli]','$_POST[dire_cli]','$_POST[tele_cli]','$fnac_cli','$_POST[sexo_cli]','$_POST[emai_cli]','$_POST[prof_cli]','$_POST[id_barrio]')";
  //echo $sql;
  $res=pg_query($link,$sql);
  $insert_row=pg_fetch_row($res);
  $codi_cli=$insert_row[0];
  echo "<input type='hidden' name='tpid_cli' value='$_POST[tpid_cli]'>";
  echo "<input type='hidden' name='nrod_cli' value='$_POST[nrod_cli]'>";
}
else{
  //$codi_cli=$codigo;
  echo "<input type='hidden' name='codi_cli' value='$_POST[codigo]'>";
}
pg_free_result($consulta);
pg_close($link);
?>

</form>
</body>
</HTML>
<script language='javascript'>cargar()</script>
