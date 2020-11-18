<?php
session_start();
?>
<!-- Guarda las Compras -->
<HTML>
<head>
<title>Guarda Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar(codi_) {
  window.open('cse_ccompra1.php?codi_cli='+codi_,'fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
if(!empty($_POST['fnac_cli'])){
  $fnac_cli=cambiafecha($_POST['fnac_cli']);
}
else{
  $fnac_cli='0000-00-00';
}
$fech_com=cambiafecha($_POST['fech_com']);
$hoy=cambiafecha(hoy());
//$puntos=floor($valo_com/1000);
//echo $_POST['codigo'];
if(empty($_POST['codigo'])){
    $sql_="INSERT INTO sisbol.cliente (tpid_cli,nrod_cli,exped_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,id_barrio)
               VALUES ('$_POST[tpid_cli]','$_POST[nrod_cli]','$_POST[exped_cli]','$_POST[nomb_cli]','$_POST[apel_cli]','$_POST[dire_cli]','$_POST[tele_cli]','$fnac_cli','$_POST[sexo_cli]','$_POST[emai_cli]','$_POST[prof_cli]','$_POST[id_barrio]') RETURNING codi_cli";
    //echo $sql_;
    $res=pg_query($link,$sql_);
    $insert_row = pg_fetch_row($res);
    $codi_cli = $insert_row[0];
}
else{
    $codi_cli=$_POST['codigo'];
}
?>
</head>
<?php
if($_POST['opc']==0){
    $cadena=$_POST['placavehi_bol'].',';
    $cadena=$cadena.$_POST['loca_com'].',';
    $cadena=$cadena.$_POST['tdoc_com'].',';
    $cadena=$cadena.$_POST['ndoc_com'].',';
    $cadena=$cadena.$fech_com.',';
    $cadena=$cadena.$_POST['valo_com']."\n";
    //echo $cadena;
    $archivo="tmp/bol_".$codi_cli.".txt";
    //echo $archivo;
    $fp_=fopen($archivo,"a");
    fwrite($fp_,$cadena);
    fclose($fp_);
    echo "<body onload='javascript:cargar($codi_cli)'>";
}
else{
    $archivo="tmp/bol_".$_POST['codigo'].".txt";
    if(file_exists($archivo)){
        $sql="INSERT INTO sisbol.boleta (codi_cli,id_camp,esta_bol,impr_bol,anul_bol,fech_bol,usua_bol)
                   VALUES ('$codi_cli','$_POST[id_camp]','A','N','N','$hoy','$_SESSION[Gcodi_ucs]') RETURNING codi_bol";
        //echo "<BR>".$sql;
        $res=pg_query($link,$sql);
        $insert_row=pg_fetch_row($res);
        $codi_bol=$insert_row[0];
        //echo "<br>codigo boleta:   ".$codi_bol;

        $total=0;
        $fp = fopen ($archivo, "r" );
        //$reg=0;
        while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
            //$reg++;
            $i = 0;
            foreach($data as $dato){
                $campo[$i]=$dato;
                $i++ ;
            }
            $placavehi_bol=$campo[0];
            $sql_="INSERT INTO sisbol.compra(codi_bol,tdoc_com,ndoc_com,fech_com,valo_com,loca_com)
                VALUES($codi_bol,'$campo[2]','$campo[3]','$campo[4]','$campo[5]','$campo[1]')";
            //echo $sql_;    
            pg_query($link,$sql_);
            $total=$total+$campo[5];
        }
        fclose ($fp);
        unlink($archivo);
        //echo $total;
        //$consultaent="SELECT valxb_ent,nume_bol FROM entidad";
        $consultaent="SELECT valxb_ent FROM sisbol.entidad";
        
        $consultaent=pg_query($link,$consultaent);
        $rowent=pg_fetch_array($consultaent);        
        $nbol=intval($total/$rowent['valxb_ent']);

        $consboleta="SELECT numeroboleta_camp FROM sisbol.campania WHERE id_camp='$_POST[id_camp]'";
        $consboleta=pg_query($link,$consboleta);
        $rowbol=pg_fetch_array($consboleta);

        $sql_="UPDATE sisbol.campania SET numeroboleta_camp=numeroboleta_camp+$nbol WHERE id_camp='$_POST[id_camp]'";
        //echo "<br>".$sql_;
        pg_query($link,$sql_);

        for($i_=0;$i_<$nbol;$i_++){
            $nume_bol=$rowbol['numeroboleta_camp']+$i_;
            $sql_="INSERT INTO sisbol.detalle_bol(codi_bol,nume_dbo) values($codi_bol,$nume_bol)";
            pg_query($link,$sql_);
        }
        pg_free_result($consultaent);
        $sql="UPDATE sisbol.boleta SET placavehi_bol='$placavehi_bol' WHERE codi_bol='$codi_bol'";
        //echo $sql;
        pg_query($link,$sql);

    }
    echo "<body>";
    echo "<table class='Tbl0' width='100%'>";
    echo "<tr><td class='Td0' align='center'>Compra Guardada</td></tr>";
    echo "</table>";
    echo "<br><br><br><br><br><br><br><br><br>";
    echo "<table class='Tb0' width='70%'>";
    echo "<tr>";
    //echo $codi_bol;
    echo "<td class='Td2' width='25%' align='right'><a href='cse_prnboleta.php?codi_bol=$codi_bol' target='blank' onclick='cargar(0)'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas'></a></td>";
    echo "<td class='Td2' width='25%' align='left'><a href='cse_prnboleta.php?codi_bol=$codi_bol' target='blank' onclick='cargar(0)'>Imprimir Boletas</a></td>";
    echo "</tr>";
    echo "</table>";
}
pg_close($link);
?>
</body>
</HTML>
