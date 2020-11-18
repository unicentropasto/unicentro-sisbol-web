<!-- Captura de compras -->
<HTML>
<head>
<title>SisBol</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();




?>
</head>
<body>
<form name='form1' method='post' action='cse_ccompra11.php'>
    <h4>Generando Vistas</h4>
    <?php
    $error=0;
    $cont=1;

    $sql="CREATE OR REPLACE VIEW sisbol.vw_barrio AS
    SELECT id_barrio,CONCAT(nombre_bar,' ',comuna_bar) AS descripcion FROM sisbol.barrio";
    $res=pg_query($link,$sql);
    echo $res[0];
    if(!$res){
        echo "<div class='col-sm-12'>vw_barrio NO CREADA</div>";
        $error++;
    }
    incrementar($cont);
    $cont++;


    $sql="CREATE OR REPLACE VIEW sisbol.vw_boleta AS
    SELECT boleta.codi_bol,boleta.id_camp,detalle_bol.nume_dbo,cliente.tpid_cli,cliente.nrod_cli,cliente.exped_cli,concat(cliente.nomb_cli,' ',cliente.apel_cli) as nombre,cliente.tele_cli,CONCAT(cliente.dire_cli,' ',barrio.nombre_bar) AS direccion,cliente.emai_cli,tipo.desc_tip AS tipo_ident,campania.nombre_camp,campania.mecanica_camp,campania.fechafin_camp
    FROM sisbol.boleta
    INNER JOIN sisbol.detalle_bol ON detalle_bol.codi_bol=boleta.codi_bol
    INNER JOIN sisbol.cliente ON cliente.codi_cli=boleta.codi_cli
    INNER JOIN sisbol.campania ON campania.id_camp=boleta.id_camp
    INNER JOIN sisbol.tipo ON tipo.codi_tip=cliente.tpid_cli
    INNER JOIN sisbol.barrio ON barrio.id_barrio=cliente.id_barrio";
    $res=pg_query($link,$sql);
    if(!$res){
        echo "<div class='col-sm-12'>vw_boleta NO CREADA</div>";
        $error++;
    }
    incrementar($cont);
    $cont++;

    $sql="CREATE OR REPLACE VIEW sisbol.vw_compra AS
    SELECT cliente.codi_cli,cliente.nrod_cli,CONCAT(cliente.nomb_cli,' ',cliente.apel_cli) AS nombre,cliente.dire_cli,cliente.tele_cli,cliente.sexo_cli,cliente.fnac_cli,compra.tdoc_com,
        tp.valo_tip AS tipo_doc_comp,compra.ndoc_com,compra.fech_com,compra.valo_com,compra.loca_com,loc.desc_tip AS local,barrio.nombre_bar,boleta.id_camp,boleta.anul_bol
           FROM sisbol.compra
           INNER JOIN sisbol.boleta ON boleta.codi_bol=compra.codi_bol
           INNER JOIN sisbol.cliente ON cliente.codi_cli=boleta.codi_cli
           INNER JOIN sisbol.barrio ON barrio.id_barrio=cliente.id_barrio
           INNER JOIN sisbol.tipo as tp ON tp.codi_tip=compra.tdoc_com
           INNER JOIN sisbol.tipo AS loc ON loc.codi_tip=compra.loca_com";
    //echo $sql;       
    $res=pg_query($link,$sql);
    if(!$res){
        echo "<div class='col-sm-12'>vw_compra NO CREADA</div>";
        $error++;
    }
    incrementar($cont);
    $cont++;

    $sql="CREATE OR REPLACE VIEW sisbol.vw_categoria AS
    SELECT tipo.codi_tip,tipo.desc_tip FROM sisbol.tipo WHERE tipo.codi_gru='05'";
    $res=pg_query($link,$sql);
    if(!$res){
        echo "<div class='col-sm-12'>vw_categoria NO CREADA</div>";
        $error++;
    }
    incrementar($cont);
    $cont++;
    

    if($error<>0){
        ?>
        <b>Atención:</b>
        <br>Comunique los anteriores errores al personal de soporte técnico de MEDINET
        <?php
    }

    //actbarrios();
    ?>                            
    <br>Proceso finalizado
</form>

</body>
</HTML>


    


<?php
function incrementar($c_){
    $totvistas=14;
    $por_vistas=($c_*100)/$totvistas;
    if($por_vistas>98){
        $por_vistas=100;
    }    
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            incrementabarra(<?php echo $por_vistas;?>);
        });
    </script>
    <?php
}

function actbarrios(){
    $link=conectarbd();
    $consbarrio="SELECT id_barrio,nombre_bar FROM barrio";
    //echo $consbarrio;
    $consbarrio=pg_query($link,$consbarrio);
    while($row=pg_fetch_array($consbarrio)){
        $nombre_bar=strtoupper($row['nombre_bar']);
        echo "<br>".$nombre_bar;

        $concli="SELECT * FROM cliente WHERE dire_cli LIKE '%$nombre_bar%'";
        //echo "<br>".$concli;
        $concli=pg_query($link,$concli);
        //echo "<br>Coincidencias: ".pg_num_rows($concli);
        $sql="UPDATE sisbol.cliente SET dire_cli = REPLACE (dire_cli, '$nombre_bar', '' ),id_barrio='$row[id_barrio]' WHERE dire_cli LIKE '%$nombre_bar%'";
        //echo "<br>sql: ".$sql;
        pg_query($link,$sql);
        //echo "<br>Reemplazos: ".pg_affected_rows();
    }
}

?>
<script type="text/javascript">
    function incrementabarra(valor){
        valor=valor+"%";        
        $(".progress-bar").animate({
        width: valor
        },1);        
    }

</script>