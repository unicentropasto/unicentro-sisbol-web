<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--sisbol_ucv3 Version 3 para POSTGRESSQL-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SisBol</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="shorcut icon" type="image/x icon" href="img/logosisbol.png">
<script languaje='javascript'>
function validausu(){
var error='';
  if(document.form1.usuario.value==''){error+='Usuario \n';}
  if(document.form1.clave.value==''){error+='Clave \n';}
  if(error!=''){
    alert('Para continuar debe digitar la siguiente Información: \n'+error);
	return(false);
  }
  document.form1.submit();
}
</script>
</head>
<body>
<form name='form1' action='cse_frm0000.php' method='POST'>
<br><br><br><br><br><br><br><br>
<center>
<table class='Tb0'>
  <tr>
    <td class='Td2' align='right'><img src='img/connected_multiple_big.jpg' width='45' height='45'></td>
    <td class='Td2' align='right'>Usuario:</td>
	<td class='Td2' align='left'><input type='text' name='usuario' size='20' maxlength='20'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'><img src='img/connected_data_big.jpg' width='45' height='45'></td>
    <td class='Td2' align='right'>Clave:</td>
	<td class='Td2' align='left'><input type='password' name='clave' size='32' maxlength='10'></td>
  </tr>
</table>
</center>
<br><br>
<center><input type='button' value='Entrar' onclick="validausu()"></center>
</body>
</html>