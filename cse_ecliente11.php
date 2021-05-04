<!-- Edicion de Datos del Cliente -->
<HTML>
<head>
<title>Edita Cliente</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
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
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificación\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificación\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    //if (document.form1.sexo_cli.value == "") { a += " Sexo\n"; }
    //if (document.form1.fnac_cli.value == "") { a += " Fecha de Nacimiento\n"; }
    //if (document.form1.tele_cli.value == "") { a += " Teléfono\n"; }
    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
function recarga(){
  document.form1.action='cse_ccompra1.php';
  document.form1.submit();
}
function buscar(){
  document.form1.action='cse_ccompra12.php';
  document.form1.submit();
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$consultacli="select codi_cli,tpid_cli,nrod_cli,exped_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli,cliente.id_barrio,descripcion
                          from sisbol.cliente 
                          LEFT JOIN sisbol.vw_barrio ON vw_barrio.id_barrio=cliente.id_barrio
                          where codi_cli='$_GET[codi_cli]'";
//echo $consultacli;
$consultacli=pg_query($link,$consultacli);
$rowcli=pg_fetch_array($consultacli);

$codi_cli=$_GET['codi_cli'];
$tpid_cli=$rowcli['tpid_cli'];
$fnac_cli=cambiafechadmy($rowcli['fnac_cli']);
$nrod_cli=$rowcli['nrod_cli'];
$exped_cli=$rowcli['exped_cli'];
$nomb_cli=$rowcli['nomb_cli'];
$apel_cli=$rowcli['apel_cli'];
$dire_cli=$rowcli['dire_cli'];
$tele_cli=$rowcli['tele_cli'];
$emai_cli=$rowcli['emai_cli'];
$sexo_cli=$rowcli['sexo_cli'];
$prof_cli=$rowcli['prof_cli'];
$id_barrio=$rowcli['id_barrio'];
$barrio=$rowcli['descripcion'];

?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente111.php'>
<table class='Tbl0' w=$rowcli[apel_cli];;dth='100%'>
  <tr><td class='Td0' align='center'>Editar Clienteeee</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos Personales</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	<option value=''>
	<?php
	  $consultatp="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='01'";
    $consultatp=pg_query($link,$consultatp);
	  while($rowtp=pg_fetch_array($consultatp)){
	    echo "<option value='$rowtp[codi_tip]'>$rowtp[desc_tip]";
	  }
	?>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' value='<?php echo $nrod_cli;?>'></td>
    <td class='Td2' width='10%' align='right'>Expedida en:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='exped_cli' size='40' maxlength='40' value='<?php echo $exped_cli;?>'></td>
    </tr>
    <tr>

	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $nomb_cli;?>'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $apel_cli;?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli'>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	 </td>
	 <td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	 <td class='Td2' align='left'><input type='text' name='fnac_cli' size='10' maxlength='10' value='<?php echo $fnac_cli;?>'></td>
  </tr>
  <tr>
	   <td class='Td2' align='right'>Dirección:</td>
     <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?php echo $dire_cli;?>'></td>
     <td class='Td2' align='right'>Barrio:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' id="barrio" name="barrio" size='50' maxlength='50' value="<?php echo $barrio;?>">
      <input type="hidden" id="id_barrio" name="id_barrio" value='<?php echo $id_barrio;?>'>
    </td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?php echo $tele_cli;?>'></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?php echo $emai_cli;?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesión:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?php echo $disp;?>>
	<option value=''>
	<?php
	  $consultapr="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='04'";
    $consultapr=pg_query($link,$consultapr);
	  while($rowpr=pg_fetch_array($consultapr)){
	    echo "<option value='$rowpr[codi_tip]'>$rowpr[desc_tip]";
	  }
	?>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?echo $rowcli[punt_cli];?></font></td>
  </tr>
</table>

<input type='hidden' name='codi_cli' value='<?php echo $codi_cli?>'>
<script language='javascript'>
document.form1.tpid_cli.value='<?php echo $tpid_cli;?>';
document.form1.sexo_cli.value='<?php echo $sexo_cli;?>';
document.form1.prof_cli.value='<?php echo $prof_cli;?>';

</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?
pg_free_result($consultatp);
pg_free_result($consultacli);
pg_close($link);
?>
</body>
</HTML>

<script type="text/javascript">
    $().ready(function() {
      
        $("#barrio").autocomplete("autocomp_barrio.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#barrio").result(function(event, data, formatted) {
            $("#id_barrio").val(data[1]);
        });

        
    });
</script>
