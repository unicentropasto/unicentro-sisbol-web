<!-- Captura de compras -->
<HTML>
<head>
<title>Captura de Compras</title>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(opc_)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = "";
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificación\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificación\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    
	
    if(opc_==0){
        if (document.form1.loca_com.value==""){
            a += " Debe seleccionar el local\n";
        }
		
      	if (document.form1.tdoc_com.value==""){
            a += " Debe seleccionar el tipo de documento\n";
        }
        if (document.form1.ndoc_com.value==""){
            a += " Debe digitar el numero del documento\n";
        }
        if (document.form1.valo_com.value==""){
            a += " Debe digitar el valor de la compra\n";
        }
		
    }
    if (a != "") 
    { alert(error + a);return true;}
    document.form1.placavehi_bol.disabled=false;
    document.form1.opc.value=opc_;
    document.form1.submit()
}

function atras()
{
  history.go(-1)
}
function recarga(){
  document.form1.action='cse_ccompra1.php';
  document.form1.submit();
}
function buscar(){
  document.form1.action='cse_ccompra12.php';
  document.form1.submit();
}

</script>

<script language='vBscript'>
'Funcion que retorna true si la fecha es válida y false si la fecha no es válida
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

'Funcion que retorna true si la fecha es menor a la fecha actual
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function

'Funcion que retorna true si la fecha es mayor a 1900
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=-1
  end if
  if(diferencia>=39911) then
    validafechamen=true
  else
    validafechamen=false
  end if
end function

'Funcion que retorna true si la fecha esta entre las fechas validas del sorteo
'Parámetros: fecha_ : Es la fecha que se va a validar,fini_,ffin_: Son las fechas del rango a validaf; deben llegar en formato dd/mm/aaaa
function validafechaentre(fecha_,fini_,ffin_)
    'MsgBox("hola")
    if(DateDiff("d",fini_,fecha_)>=0 and DateDiff("d",fecha_,ffin_)>=0) then
        validafechaentre=true
    else
        validafechaentre=false
    end if
end function
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();

require("abre_campania.php");

$consbol="SELECT valxb_ent,fini_sor,ffin_sor FROM sisbol.entidad";
$consbol=pg_query($link,$consbol);
$rowbol=pg_fetch_array($consbol);
$valxb_ent=$rowbol['valxb_ent'];
$fini_sor=$rowbol['fini_sor'];
$ffin_sor=$rowbol['ffin_sor'];
$disp='';
$codi_cli='';
$nrod_cli='';
$tpid_cli='';
$sexo_cli='';
$exped_cli='';
$nomb_cli='';
$apel_cli='';
$fnac_cli='';
$dire_cli='';
$tele_cli='';
$emai_cli='';
$prof_cli='';
$loca_com='';
$tdoc_com='';
$ndoc_com='';
$valo_com='';
$id_barrio='';
$barrio="";
$placavehi_bol="";

if(isset($_POST['codi_cli'])){$codi_cli=$_POST['codi_cli'];}
if(isset($_GET['codi_cli'])){$codi_cli=$_GET['codi_cli'];}
if(isset($_POST['nrod_cli'])){$nrod_cli=$_POST['nrod_cli'];}
if(isset($_POST['tpid_cli'])){$tpid_cli=$_POST['tpid_cli'];}
if(isset($_POST['sexo_cli'])){$sexo_cli=$_POST['sexo_cli'];}
if(isset($_POST['exped_cli'])){$exped_cli=$_POST['exped_cli'];}
if(isset($_POST['nomb_cli'])){$nomb_cli=$_POST['nomb_cli'];}
if(isset($_POST['apel_cli'])){$apel_cli=$_POST['apel_cli'];}
if(isset($_POST['fnac_cli'])){$fnac_cli=$_POST['fnac_cli'];}
if(isset($_POST['dire_cli'])){$dire_cli=$_POST['dire_cli'];}
if(isset($_POST['tele_cli'])){$tele_cli=$_POST['tele_cli'];}
if(isset($_POST['emai_cli'])){$emai_cli=$_POST['emai_cli'];}
if(isset($_POST['prof_cli'])){$prof_cli=$_POST['prof_cli'];}
if(isset($_POST['loca_com'])){$loca_com=$_POST['loca_com'];}
if(isset($_POST['tdoc_com'])){$tdoc_com=$_POST['tdoc_com'];}
if(isset($_POST['ndoc_com'])){$ndoc_com=$_POST['ndoc_com'];}
if(isset($_POST['valo_com'])){$valo_com=$_POST['valo_com'];}
if(isset($_POST['id_barrio'])){$id_barrop=$_POST['id_barrio'];}

if(!empty($_POST['nrod_cli'])||!empty($codi_cli)){
  if(!empty($codi_cli)){
    $consultacli="select codi_cli,tpid_cli,nrod_cli,exped_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli,cliente.id_barrio,vw_barrio.descripcion
                              from sisbol.cliente
                              LEFT JOIN sisbol.vw_barrio ON sisbol.vw_barrio.id_barrio=sisbol.cliente.id_barrio where codi_cli='$codi_cli'";
    //echo $consultacli;
      $consultacli=pg_query($link,$consultacli);
  }
  else{
    $consultacli="select 	codi_cli,tpid_cli,nrod_cli,exped_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli,cliente.id_barrio,vw_barrio.descripcion
                              from sisbol.cliente
                              LEFT JOIN sisbol.vw_barrio ON vw_barrio.id_barrio=cliente.id_barrio where tpid_cli='$tpid_cli' and nrod_cli='$nrod_cli'";
    //echo $consultacli;
    $consultacli=pg_query($link,$consultacli);
  }
  if(pg_num_rows($consultacli)<>0){
    $rowcli=pg_fetch_array($consultacli);
    $codi_cli=$rowcli['codi_cli'];
    $tpid_cli=$rowcli['tpid_cli'];
    $nrod_cli=$rowcli['nrod_cli'];
    $exped_cli=$rowcli['exped_cli'];
    $nomb_cli=$rowcli['nomb_cli'];
    $apel_cli=$rowcli['apel_cli'];
    $dire_cli=$rowcli['dire_cli'];
    $tele_cli=$rowcli['tele_cli'];
    $fnac_cli=cambiafechadmy($rowcli['fnac_cli']);
    $sexo_cli=$rowcli['sexo_cli'];
    $emai_cli=$rowcli['emai_cli'];
    $prof_cli=$rowcli['prof_cli'];
    $punt_cli=$rowcli['punt_cli'];
    $id_barrio=$rowcli['id_barrio'];
    $barrio=$rowcli['descripcion'];
    $disp='disabled';
  }
}
?>
</head>
<body>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'><h1>CAMPAÑA: <?php echo $nombre_camp;?></h1></td></tr>
</table>

<form name='form1' method='post' action='cse_ccompra11.php'>
<table class='Tbl0' width='100%'>
  <th class='Th0'>OPC</th>
    <th class='Th0'>LOCAL</th>
    <th class='Th0'>DOCUM</th>
    <th class='Th0'>NUMERO</th>
    <th class='Th0'>FECHA</th>
    <th class='Th0'>VALOR</th>
    <?php
    $archivo="tmp/bol_".$codi_cli.".txt";
    //echo $archivo;
    $reg=0;
    if(file_exists($archivo)){
        $fp = fopen ($archivo, "r" );
        $total=0;
        while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
            $reg++;
            $i = 0;
            foreach($data as $dato){
                $campo[$i]=$dato;
                $i++ ;
            }
            $placavehi_bol=$campo[0];
            echo "<tr>";
            echo "<td class='Td2' align='center'><a href='borracom.php?borrar_=$reg&codi_cli=$codi_cli'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' title='Borrar'></a></td>";            
            $consultalo="SELECT desc_tip AS local FROM sisbol.tipo WHERE codi_tip='$campo[1]'";
            $consultalo=pg_query($link,$consultalo);
	          $rowlo=pg_fetch_array($consultalo);
            echo "<td class='Td2' align='left'>$rowlo[local]</td>";
            $consultado="SELECT desc_tip AS docum FROM sisbol.tipo WHERE codi_tip='$campo[2]'";
            //ECHO $consultado;
            $consultado=pg_query($link,$consultado);
	          $rowdo=pg_fetch_array($consultado);
            echo "<td class='Td2' align='left'>".$rowdo['docum']."</td>";
            echo "<td class='Td2' align='right'>".$campo[3]."</td>";
            echo "<td class='Td2' align='center'>".$campo[4]."</td>";
            echo "<td class='Td2' align='right'>".$campo[5]."</td>";
            echo "</tr>";
            $total=$total+$campo[5];
        }
        //ECHO "<BR>".$total;
        //ECHO "<BR>".$valxb_ent;
        $nbol=intval($total/$valxb_ent);
        echo "<tr>";
        echo "<td class='Td0' align='left'colspan='2'><b>Nro Boletas: $nbol</td>";
        echo "<td class='Td0' align='right' colspan='3'><b>Total</td>";
        echo "<td class='Td0' align='right'><b>$total</td>";
        echo "</tr>";
        fclose ($fp);
    }
?>
</table>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Captura de Compras</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos del Cliente</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	<option value=''>
	<?php
	  $consultatp="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='01'";
    $consultatp=pg_query($link,$consultatp);
	  while($rowtp=pg_fetch_array($consultatp)){
	    echo "<option value='$rowtp[codi_tip]'>".$rowtp['desc_tip'];
	  }
	?>
	</select><strong></strong>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' onblur='recarga()' value='<?php echo $nrod_cli;?>'></td>
	<td class='Td2' width='10%' align='right'>Expedida en:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='exped_cli' size='40' maxlength='40'  value='<?php echo $exped_cli;?>' <?php echo $disp;?>></td>
	
	</tr>
	<tr>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
        <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $nomb_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $apel_cli;?>' <?php echo $disp;?>>
	  <!-- <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a> -->
	</td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli' <?php echo $disp;?>>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	  </select>
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	<td class='Td2' align='left'><input type='text' name='fnac_cli' size='10' maxlength='10' value='<?php echo $fnac_cli;?>' <?php echo $disp;?>></td>
  </tr>
  <tr>
      <td class='Td2' align='right'>Dirección:</td>
      <td class='Td2' align='left' colspan='2'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?php echo $dire_cli;?>' <?php echo $disp;?>></td>
      <td class='Td2' align='right'>Barrio:</td>
      <td class='Td2' align='left'><input type='text' id="barrio" name="barrio" size='50' maxlength='50' value="<?php echo $barrio;?>" <?php echo $disp;?>>
      <input type="hidden" id="id_barrio" name="id_barrio" value='<?php echo $id_barrio;?>'>
      </td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?php echo $tele_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?php echo $emai_cli;?>' <?php echo $disp;?>></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesión:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?php echo $disp;?>>
	<option value=''>
	<?php
	  $consultapr="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='04'";
    $consultapr=pg_query($link,$consultapr);
	  while($rowpr=pg_fetch_array($consultapr)){
	    echo "<option value='$rowpr[codi_tip]'>".$rowpr['desc_tip'];
	  }
	?>
	</select>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<!--<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?//echo $punt_cli;?></font></td>-->
  </tr>
</table>

<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de la Compra</td></tr>
</table>
<?php
$hoy=hoy();
$disponible2="";
if($placavehi_bol<>''){
  $disponible2="disabled";
}
?>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Placa del Vehículo:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='placavehi_bol' size='7' maxlength='7' value='<?php echo $placavehi_bol;?>' <?php echo $disponible2;?>></td>
  </tr>
  <tr>
    <td class='Td2' width='10%' align='right'>Local:</td>
    <td class='Td2' width='15%' align='left'><select name='loca_com'>
	<option value=''>
	<?php
	  $consultalo="SELECT codi_tip,desc_tip,valo_tip FROM sisbol.tipo WHERE codi_gru='03' ORDER BY desc_tip";
    $consultalo=pg_query($link,$consultalo);
	  while($rowlo=pg_fetch_array($consultalo)){
	    echo "<option value='$rowlo[codi_tip]'>".$rowlo['valo_tip'].substr($rowlo['desc_tip'],0,15);
	  }
	?>
	</select>
  </tr>
  <tr>
    <td class='Td2' width='10%' align='right'>Documento:</td>
    <td class='Td2' width='15%' align='left'><select name='tdoc_com'>
	<option value=''>
	<?php
	  $consultado="SELECT codi_tip,desc_tip FROM sisbol.tipo WHERE codi_gru='02'";
    $consultado=pg_query($link,$consultado);
	  while($rowdo=pg_fetch_array($consultado)){
	    echo "<option value='$rowdo[codi_tip]'>".$rowdo['desc_tip'];
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='ndoc_com' size='6' maxlength='6' value='<?php echo $ndoc_com;?>'></td>
	<td class='Td2' width='10%' align='right'>Fecha:</td>
        <td class='Td2' width='15%' align='left'><input type='text' name='fech_com' size='10' maxlength='10' value='<?php echo $hoy;?>'></td>
	<td class='Td2' width='10%' align='right'>Valor:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='valo_com' size='8' maxlength='8' value='<?php echo $valo_com;?>'>
            <a href='#' onclick='validar(0)'><img src='img/32px-Crystal_Clear_action_tab_new.png' border=0 height='20' width='20' title='Agregar'></a>
        </td>
  </tr>
</table>
<input type='hidden' name='codigo' value='<?php echo $codi_cli?>'>
<input type='hidden' name='opc' value=''>

<script language='javascript'>
document.form1.tpid_cli.value='<?php echo $tpid_cli;?>';
document.form1.sexo_cli.value='<?php echo $sexo_cli;?>';
document.form1.prof_cli.value='<?php echo $prof_cli;?>';
document.form1.loca_com.value='<?php echo $loca_com;?>';
document.form1.tdoc_com.value='<?php echo $tdoc_com;?>';
</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <?php
  if($reg<>0){
      echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='validar(1)'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' title='Guardar'></a></td>";
      echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='validar(1)'>Guardar</a></td>";
  }
  ?>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' title='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>
<input type="hidden" name="fini_" value="<?php echo cambiafechadmy($fini_sor);?>">
<input type="hidden" name="ffin_" value="<?php echo cambiafechadmy($ffin_sor);?>">
<input type="hidden" name="id_camp" value="<?php echo $id_camp;?>">
</form>
<?
pg_free_result($consbol);
pg_free_result($consultatp);
pg_free_result($consultalo);
pg_free_result($consultado);
pg_free_result($consultapr);
mysql_close($link);
?>
</body>
</HTML>

<script type="text/javascript">
    $().ready(function() {
      
        $("#barrio").autocomplete("autocomp_barrio.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#barrio").result(function(event, data, formatted) {
            $("#id_barrio").val(data[1]);
        });

        
    });
</script>

<?php
function alert($aler_){
  ?>
    <script language="javascript">
      alert('<?php echo $aler_;?>');
    </script>
  <?php
}
?>