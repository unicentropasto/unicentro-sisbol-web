<?php 
session_start();
$valo_tip="";
$categoria="";
//$disp="";
?>
<!-- Modificacion de Tipos -->
<HTML>
<head>
<title>Modificacion de Tipos</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.desc_tip.value == "") { a += " Descripción\n"; }
    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
if($_SESSION['gcodi_gru']=='03'){
  $concateg="SELECT vw_categoria.codi_tip,vw_categoria.desc_tip FROM sisbol.vw_categoria
  INNER JOIN sisbol.tipo ON tipo.valo_tip=vw_categoria.codi_tip WHERE tipo.codi_tip='$_GET[codi_tip]'";
  $concateg=pg_query($link,$concateg);
  if(pg_num_rows($concateg)<>0){
    $rowcat=pg_fetch_array($concateg);
    $valo_tip=$rowcat['codi_tip'];
    $categoria=$rowcat['desc_tip'];
  }
}
?>
</head>
<body>
<form name='form1' method='post' action='cse_hgrupos1121.php'>
<table class='Tb0' width='70%'>
  <tr><td class='Td0' align='center'>Modificar</td></tr>
</table>
<br>
<input type='hidden' name='codi_tip' value='<?php echo $_GET['codi_tip'];?>'>
<table class='Tb0' width='70%'>
  <th class='Th0' colspan=1>Descripción</th>
  <th class='Th0' colspan=1>Valor</th>
  <tr>
    <td class='Td2' width='70%' align='center'><input type='text' name='desc_tip' size='50' maxlength='50' value='<?php echo $_GET['desc_tip'];?>'></td>
    <td class='Td2' width='30%' align='center'>
    <?php
    if($_SESSION['gcodi_gru']=='03'){
      ?>
      <input type='text' id="categoria" name="categoria" size='50' maxlength='50' value="<?php echo $categoria;?>">
      <input type="hidden" id="valo_tip" name="valo_tip" value='<?php echo $valo_tip;?>'>
      <?php
    }
    else{
      echo"<input type='text' name='valo_tip' size='10' maxlength='10' value='$_GET[valo_tip]'>";
    }
    ?>
	  
    </td>
  </tr>
</table>
<br>
<table class='Tb0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='25' width='25' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='25' width='25' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
</body>
</HTML>

<script type="text/javascript">
    $().ready(function() {
      
        $("#categoria").autocomplete("autocomp_categoria.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#categoria").result(function(event, data, formatted) {
            $("#valo_tip").val(data[1]);
        });

        
    });
</script>