<?php
session_start();
?>
<HTML>
<head>
<title>Guarda Tipos</title>
<Script Language="JavaScript">
function cargar() {
var load = window.open('cse_hgrupos11.php','fr03','');
window.opener = top;
window.close();
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="SELECT desc_tip FROM tipo WHERE desc_tip='$_POST[desc_tip]'";
$consulta=pg_query($link,$sql);
if(pg_num_rows($consulta)==0){
  $consulta="SELECT max(codi_tip) AS codi_tip FROM sisbol.tipo WHERE codi_gru='".$_SESSION['gcodi_gru']."'";
  //ECHO "<br>".$consulta;
  $consulta=pg_query($link,$consulta);
  $row=pg_fetch_array($consulta);
  if(empty($row['codi_tip'])){
     $codi_tip=$_SESSION['gcodi_gru'].'001';}
  else{
    $codi_tip=substr($row['codi_tip'],2,3)+1;
	  $codi_tip=STR_PAD($row['codi_tip']+1,5,'0',STR_PAD_LEFT);
	  //echo $codi_tip;
  }
  $sql="INSERT INTO sisbol.tipo (codi_tip,codi_gru,desc_tip,valo_tip,fijo_tip) VALUES ('$codi_tip','$_SESSION[gcodi_gru]','$_POST[desc_tip]','$_POST[valo_tip]','N')";
    //ECHO "<br>".$sql;
    pg_query($link,$sql);
  }
  pg_free_result($consulta);
  pg_close($link);
?>

</head>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">

</form>
</body>
</HTML>
