<?php
session_start();
$_SESSION['Gcodi_ucs']='';
?>
<!-- Aqui se definen los frames para la búsqueda del usuarios y de la solicitud -->
<HTML>
<HEAD>
<title>SisBol</title>
<link rel="shorcut icon" type="image/x icon" href="img/logosisbol.png">
<script languaje='javascript'>
function validar(){
  alert("Acceso Denegado");
  window.open("index.php");
  window.close();
}
</script>
</HEAD>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
//echo $link;

$clave=MD5($_POST['clave']);
$consulta="SELECT codi_ucs,logi_ucs,clav_ucs,tipo_ucs FROM sisbol.u_cliseb WHERE logi_ucs='$_POST[usuario]' and clav_ucs='$clave' and esta_ucs='A'";
//echo $consulta;
$consulta=pg_query($link,$consulta);

if(pg_num_rows($consulta)==1){
  $row=pg_fetch_array($consulta);
  $_SESSION['Gcodi_ucs']=$row['codi_ucs'];
  ?>
    <FRAMESET rows="15%,*" framespacing="0" border="1" frameborder="0"> 
      <FRAME SRC=cse_top.php NAME=fr01>
        <FRAMESET cols="15%,*" framespacing="0" border="1" frameborder="0"> 
          <FRAME SRC=cse_left2.php NAME=fr02>
          <FRAME SRC=cse_fondo.html NAME=fr03>
        </FRAMESET><noframes></noframes> 
    </FRAMESET><noframes></noframes>
  <?php
}
else{
  ?>
    <script languaje='javascript'>
      validar();
	</script>
  <?php
}
pg_free_result($consulta);
pg_close($link);
?>
</HTML>
