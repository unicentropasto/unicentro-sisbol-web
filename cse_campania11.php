<!-- Captura de campañas -->
<HTML>
<head>
<title>Captura de Campaña</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script> -->

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(){
  var error = "Para continuar, debe completar los siguientes campos:\n\n";
  var a = "";
    if (document.form1.nombre_camp.value == "") { a += " Nombre de la Campaña\n";}
    if (document.form1.mecanica_camp.value == "") { a += " Mecánica de la Campaña\n";}
    if (document.form1.fechafin_camp.value == "") { a += " Fecha final de la Campaña\n";}
    if (a != ""){
      alert(error + a);return true;}
    //alert();
    document.form1.submit();
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
?>

</head>
<body>
<form name='form1' method='post' action='cse_campania111.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Captura de Campaña</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de la Campaña</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='40%' align='right'>Nombre de la Campaña:</td>
    <td class='Td2' width='60%' align='left'><input type='text' name='nombre_camp' size='120' maxlength='200'>
    </td>
  </tr>
  <tr>
    <td class='Td2' width='40%' align='right'>Mecánica:</td>
    <td class='Td2' width='60%' align='left'>
      <textarea name="mecanica_camp" id="mecanica_camp" cols="150" rows="5"></textarea>
    </td>
  </tr>
  <tr>
    <td class='Td2' width='40%' align='right'>Fecha Final de la Campaña: aaaa/mm/dd</td>
    <td class='Td2' width='60%' align='left'><input type='date' name='fechafin_camp'></td>
  </tr>
  <tr>
    <td class='Td2' width='40%' align='right'>Actividad:</td>
    <td class='Td2' width='60%' align='left'><textarea name="actividad_camp" id="actividad_camp" cols="150" rows="5"></textarea>
    </td>
  </tr>
  <tr>
    <td class='Td2' width='40%' align='right'>Número de Personas:</td>
    <td class='Td2' width='60%' align='left'><input type='text' name='numpersonas_camp' size='11' maxlength='11'>
    </td>
  </tr>
  <tr>
    <td class='Td2' width='40%' align='right'>Valor:</td>
    <td class='Td2' width='60%' align='left'><input type='text' name='valor_camp' size='11' maxlength='11'>
    </td>
  </tr>
</table>

<br>
<table class='Tbl0' width='70%'>
  <tr>
    <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border='0' height='20' width='20' alt='Nuevo'></a></td>
    <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>

    <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
    <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
pg_close($link);
?>
</body>
</HTML>
