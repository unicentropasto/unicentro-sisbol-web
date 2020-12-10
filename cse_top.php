<html>
<head>
<title>SisBol</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<?php
include("funciones.php");
$link=conectarbd();
$consultatp="SELECT nomb_ent,nit_ent FROM sisbol.entidad";
//echo $consultatp;
$consultatp=pg_query($link,$consultatp);
$rowtp=pg_fetch_array($consultatp);
?>
<table class='Tbl0' width='100%'>
  <tr>
    <td align="left" width="30%"><img src='img/logo23.PNG' width='150' height='50'></td>
    <td align="center" style="font-size:14px" width="40%">
        <?php
        echo "<b>".$rowtp['nomb_ent']."<br>NIT:".$rowtp['nit_ent'];
        ?>
    </td>
    <td align='right' width="30%"><img src='img/logosisbol.PNG' width='40' height='20'></td>
  </tr>
</table>
<!--<table class='Tbl0' width='100%'>
  <tr>
    <td width='80%' class='Td2' align='left'><b><h1>BOLETAS</td>
  </tr>
</table>-->
</body>
</html>
