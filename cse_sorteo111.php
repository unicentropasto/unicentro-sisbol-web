<!-- Guarda el Sorteo -->
<HTML>
<head>
<title>Guarda el Sorteo</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_fondo.html","fr03");
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$fech_sor=cambiafecha(hoy());
for($c=0;$c<$cgan;$c++){
  $varppm='codi_ppm'.$c;
  $varppm=$$varppm;
  $varcom='codi_com'.$c;
  $varcom=$$varcom;
  pg_query("INSERT INTO sisbol.sorteo(fech_sor,codi_com,codi_ppm)
               VALUES ('$fech_sor',$varcom,$varppm)");
}
pg_close();
?>
</head>
<body onload="javascript:cargar('<?echo $codi_cli;?>')">

</body>
</HTML>
