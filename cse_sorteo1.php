<!-- Sorteo -->
<HTML>
<head>
<title>Sorteo</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function validar(){
  var error='';
  if(document.form1.peri_ppm.value==''){
    error+=' Periodo\n';}
  if(document.form1.fecha_ini.value==''){
    error+=' Fecha Inicial\n';}
  if(document.form1.fecha_fin.value==''){
    error+=' Fecha Final\n';}
  if(document.form1.clave.value==''){
    error+=' Clave\n';}
  if(error!=''){
    alert("Para el sorteo, debe digitar la siguiente información\n"+error);}
  else{
    document.form1.submit()}
}
</script>

</head>
<body>
<form name='form1' method='post' action='cse_sorteo11.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Sorteo</td></tr>
</table>
<br>
<table class='Tbl0' border='0'>
  <th class='Th0' width='10%'>R e c u e r d e  !</th>
  <tr></tr>
  <tr><td class='Td2'>Esta opción realiza el sorteo de los premios programados en el periodo, para confirmar el sorteo, digite la siguiente información</td></tr>
</table>
<br><br><br>
<table class='Tbl0' border='0'>
  <th class='Th0' width='10%'>Periodo</th>
  <th class='Th0' width='15%'>Fecha Inicial</th>
  <th class='Th0' width='15%'>Fecha Final</th>
  <th class='Th0' width='15%'>Clave</th>
  <th class='Th0' width='45%'></th>
  <tr>
    <td class='Td2'><input type='text' name='peri_ppm' size='4' maxlength='4'></td>
	<td class='Td2'><input type='text' name='fecha_ini' size='10' maxlength='10'></td>
	<td class='Td2'><input type='text' name='fecha_fin' size='10' maxlength='10'></td>
	<td class='Td2'><input type='password' name='clave' size='10' maxlength='10'></td>
    <td class='Td2'>
	  <a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_app_access.png' border=0 height='20' width='20' alt='Sortear'></a>
	  <a href='#' onclick='validar()'>Sortear</a>
	</td>
  </tr>
</table>

</form>
</body>
</HTML>