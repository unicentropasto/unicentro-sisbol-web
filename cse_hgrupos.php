<!-- Tipos -->
<HTML>
<head>
<title>Grupos</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
?>
</head>
<body>
<table class='Tb0' width='70%'>
  <tr><td class='Td0' align='center'>Grupos</td></tr>
</table>
<br>
<?php
  $link=conectarbd();
  $consulta="SELECT codi_gru,desc_gru FROM sisbol.grupo";
  $consulta=pg_query($link,$consulta);
  if(pg_num_rows($consulta)<>0){
    echo "<table class='Tb0' width='70%'>";
    echo "<th class='Th0'>Opción</th>";
	  echo "<th class='Th0'>Descripción</th>";
    while($row=pg_fetch_array($consulta)){
      echo "<tr>";
      echo "<td class='Td2' width=10%><a href='cse_hgrupos11.php?codi_gru=$row[codi_gru]&desc_gru=$row[desc_gru]'><img src='img/32px-Crystal_Clear_action_player_play.png' border=0 height='20' width='20' alt='Abrir'></a></td>";
	  echo "<td class='Td2' width=90%>$row[desc_gru]</td>";
	  echo "</tr>";
      echo "<tr>";
	}
	echo "</table>";
  }
  pg_free_result($consulta);
  pg_close($link);
?>
</body>
</HTML>
