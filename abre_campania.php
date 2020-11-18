<!-- Valida la campaña activa -->
<?php
//Aqui consulto la campaña
$concampa="SELECT id_camp,nombre_camp FROM sisbol.campania WHERE estado_camp='A'";
$concampa=pg_query($link,$concampa);
if(pg_num_rows($concampa)>1){
  alert("Existe mas de una campaña activa");
  exit();
}
if(pg_num_rows($concampa)==0){
  alert("NO existe una campaña activa");
  exit();
}
$rowcamp=pg_fetch_array($concampa);
$id_camp=$rowcamp['id_camp'];
$nombre_camp=$rowcamp['nombre_camp'];
?>
