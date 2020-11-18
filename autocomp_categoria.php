<?php
require_once "funciones.php";
$link=conectarbd();

$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT codi_tip,desc_tip FROM sisbol.vw_categoria WHERE desc_tip LIKE '%$q%'";
//echo $sql;
$rsd=pg_query($link,$sql);
if($rsd){
    while($rs=pg_fetch_row($rsd)){
        $id_= $rs[0];
        $cname = $rs[1];
        echo "$cname|$id_\n";
    }
}
?>
<p><font color="#000000">no encontrado</font></p>
