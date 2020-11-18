<!-- Edita Compra -->
<HTML>
<head>
<title>Edita de Compras</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function activar(reg_){
var cmd_="";
    cmd_="document.form1.chksel"+reg_+".checked";
    if(eval(cmd_)==true){
        cmd_="document.form1.loca_com"+reg_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.tdoc_com"+reg_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.ndoc_com"+reg_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.fech_com"+reg_+".disabled=false";
        eval(cmd_);
    }
    else{
        cmd_="document.form1.loca_com"+reg_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.tdoc_com"+reg_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.ndoc_com"+reg_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.fech_com"+reg_+".disabled=true";
        eval(cmd_);
    }
}

function valor(c_,var_,val_){
var cmd_="";
    cmd_="document.form1."+var_+c_+".value='"+val_+"'";
    eval(cmd_);
}
function validar(cont_){
var cmd_="";
var error_=0;
cmd_="document.form1.loca_com"+cont_+".disabled";
    if(eval(cmd_)==false){
        for(i_=0;i_<cont_;i_++){
            cmd_="document.form1.chksel"+i_+".checked";
            if(eval(cmd_)==true){
                cmd_="document.form1.loca_com"+i_+".value";
                if(eval(cmd_)==''){error_=1;}
                cmd_="document.form1.tdoc_com"+i_+".value";
                if(eval(cmd_)==''){error_=1;}
                cmd_="document.form1.ndoc_com"+i_+".value";
                if(eval(cmd_)==''){error_=1;}
                cmd_="document.form1.fech_com"+i_+".value";
                if(eval(cmd_)==''){error_=1;}
            }
        }    
        if(error_==0){
            cmd_="document.form1.codi_com_e.value=document.form1.codi_com"+i_+".value";
            eval(cmd_);
            cmd_="document.form1.loca_com_e.value=document.form1.loca_com"+i_+".value";
            eval(cmd_);
            cmd_="document.form1.tdoc_com_e.value=document.form1.tdoc_com"+i_+".value";
            eval(cmd_);
            cmd_="document.form1.ndoc_com_e.value=document.form1.ndoc_com"+i_+".value";
            eval(cmd_);
            cmd_="document.form1.fech_com_e.value=document.form1.fech_com"+i_+".value";
            eval(cmd_);
            //alert("validado");
            document.form1.submit();
        }
        else{
            alert("No deben quedar campos vacios para guardar la informacion");
        }
        return(false);
    }
}
function atras()
{
  history.go(-1)
}
</script>
</head>
<body>
<form name='form1' method='post' action='cse_ecompra1111.php'>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$consulta="SELECT bol.fech_bol,cl.codi_cli,cl.tpid_cli,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre,tp.desc_tip
           FROM sisbol.boleta as bol
	   INNER JOIN sisbol.cliente as cl ON cl.codi_cli=bol.codi_cli
	   INNER JOIN sisbol.tipo as tp ON tp.codi_tip=cl.tpid_cli
	   WHERE bol.codi_bol='$_GET[codi_bol]'";
//echo $consulta;
$consulta=pg_query($link,$consulta);
$row=pg_fetch_array($consulta);
?>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Edita Compra</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' align='right'>Tipo de Identificación:</td>
    <td class='Td2' align='left'><b><?php echo $row['desc_tip'];?></td>
    <td class='Td2' align='right'>Número:</td>
    <td class='Td2' align='left'><b><?php echo $row['nrod_cli'];?></td>
    <td class='Td2' align='right'>Nombre:</td>
    <td class='Td2' align='left'><b><?php echo $row['nombre'];?></td>
    <td class='Td2' align='right'>Fecha Reg:</td>
    <td class='Td2' align='left'><b><?php echo cambiafechadmy($row['fech_bol']);?></td>
  </tr>
</table>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de las Compras</td></tr>
</table>
    
<table class='Tbl0' width='100%' border='0'>
    <th class='Th0'>Sel</th>
    <th class='Th0'>Local</th>
    <th class='Th0'>Documento</th>
    <th class='Th0'>Numero</th>
    <th class='Th0'>Fecha</th>
    <th class='Th0'>Valor</th>
    <th class='Th0'>Guardar</th>
    <?php
    $consultacom="SELECT * FROM sisbol.compra WHERE codi_bol='$_GET[codi_bol]'";
    //echo "<br>".$consultacom;
    $consultacom=pg_query($link,$consultacom);
    if(pg_num_rows($consultacom)){
        $cont_=0;
        while($rowcom=pg_fetch_array($consultacom)){
            $var_='codi_com'.$cont_;
            echo "<input type='hidden' name='$var_' value='$rowcom[codi_com]'>";
            echo "<tr>";
            $var_='chksel'.$cont_;
            echo "<td class='Td2' align='center'><input type='checkbox' name='$var_' onclick='activar($cont_)'></td>";
            $var_='loca_com'.$cont_;
            //echo $var_;
            echo "<td class='Td2' align='center'><select name='$var_' disabled>";
            echo "<option value=''>";
            $consultalo="SELECT codi_tip,desc_tip,valo_tip FROM sisbol.tipo WHERE codi_gru='03' ORDER BY valo_tip";
            $consultalo=pg_query($link,$consultalo);
            while($rowlo=pg_fetch_array($consultalo)){
                echo "<option value='$rowlo[codi_tip]'>".$rowlo['valo_tip'].substr($rowlo['desc_tip'],0,15)."</option>";
            }
            echo "</select>";
            $var_='tdoc_com'.$cont_;
            echo "<td class='Td2' align='left'><select name='$var_' disabled>";
            echo "<option value=''>";
            $consultado="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='02'";
            $consultado=pg_query($link,$consultado);
            while($rowdo=pg_fetch_array($consultado)){
                echo "<option value='$rowdo[codi_tip]'>".$rowdo['desc_tip']."</option>";
            }
            echo "</select>";
            echo "</td>";
            $var_='ndoc_com'.$cont_;
            echo "<td class='Td2' align='left'><input type='text' name='$var_' size='6' maxlength='6' value='$rowcom[ndoc_com]' disabled></td>";
            $var_='fech_com'.$cont_;
            echo "<td class='Td2' align='left'><input type='text' name='$var_' size='10' maxlength='10' value='".cambiafechadmy($rowcom['fech_com'])."' disabled></td>";
            echo "<td class='Td2' align='left'><input type='text' name='valo_com' size='8' maxlength='8' value='$rowcom[valo_com]' disabled></td>";
            echo "<td class='Td2' align='center'><a href='#' onclick='validar($cont_)'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Guardar' title='Guardar'></a></td>";
            echo "</tr>";
            $loca_com=$rowcom['loca_com'];
            $tdoc_com=$rowcom['tdoc_com'];
            ?>
            <script language='javascript'>
                valor('<?php echo $cont_;?>','loca_com','<?php echo $loca_com;?>');
                valor('<?php echo $cont_;?>','tdoc_com','<?php echo $tdoc_com;?>');
            </script>
            <?php
            $cont_++;
        }
        pg_free_result($consultalo);
        pg_free_result($consultado);
    }
    ?>
</table>
<input type='hidden' name='codi_bol' value="<?php echo $_GET['codi_bol'];?>">
<input type='hidden' name='cont_' value='<?php echo $cont_;?>'>
<input type='hidden' name='codi_com_e'>
<input type='hidden' name='loca_com_e'>
<input type='hidden' name='tdoc_com_e'>
<input type='hidden' name='ndoc_com_e'>
<input type='hidden' name='fech_com_e'>
<input type='hidden' name='id_camp' value="<?php echo $_GET['id_camp'];?>">

<table class='Tbl0' width='100%' border='0'>
    <tr>
        <!--<td class='Td2' align='center'><a href='#' onclick='validar(<?php echo $cont_;?>)'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border='0' height='20' width='20' alt='Guardar'><b>Guardar</a></td>-->
        <td class='Td2' align='center'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border='0' height='20' width='20' alt='Regresar'><b>Regresar</a></td>
    </tr>
</table>
</form>
<?php
pg_free_result($consulta);
pg_free_result($consultacom);
pg_close($link);
?>
</body>
</HTML>