<?php
//ob_end_clean();
require('fpdf.php');

include("funciones.php");
$link=conectarbd();
$consultaemp="SELECT nomb_ent,nit_ent FROM sisbol.entidad";
$consultaemp=pg_query($link,$consultaemp);
$rowent=pg_fetch_array($consultaemp);


/*$consultaplan="SELECT codi_ppm,fsor_ppm,nota_ppm FROM plan_premio";
$consultaplan=pg_query($link,$consultaplan);
$rowplan=pg_fetch_array($consultaplan);*/


$consultacom="SELECT com.ndoc_com,com.fech_com,com.valo_com,tip.desc_tip
    FROM sisbol.compra AS com
    INNER JOIN sisbol.tipo AS tip ON tip.codi_tip=loca_com
    WHERE com.codi_bol='".$_GET['codi_bol']."'";
//echo "<br>".$consultacom;

$consultacom=pg_query($link,$consultacom);
$consulta="SELECT codi_bol,id_camp,nume_dbo,tpid_cli,nrod_cli,exped_cli,nombre,tele_cli,direccion,emai_cli,tipo_ident,nombre_camp,mecanica_camp,fechafin_camp
FROM sisbol.vw_boleta
WHERE codi_bol='".$_GET['codi_bol']."'";
//echo "<br>".$consulta;
$consulta=pg_query($link,$consulta);

$pdf=new FPDF('P','mm','p1');
//$pdf->AddPage();
//$pdf->SetFont('Arial','',8);
while($row=pg_fetch_array($consulta)){
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $pdf->Image('img\logo23.png',25,2,25,10,'','');

    $f=15;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,$rowent['nomb_ent'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"NIT ".$rowent['nit_ent'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(42,$f);
    $pdf->Cell(20,4,"BOLETA Nro: ".str_pad($row['nume_dbo'],6,'0',STR_PAD_LEFT),0,0,'R');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"CAMPAÑA PUBLICITARIA",0,0,'C');

    $pdf->SetFont('Arial','',6);

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->MultiCell(68,3,$row['nombre_camp'],0,'C');
    $f=$pdf->GetY();

    //$f=$f+3;
    $pdf->SetXY(2,$f);
    $pdf->MultiCell(68,3,utf8_decode($row['mecanica_camp']),0,'J');
    $f=$pdf->GetY();

    //$f=$f+3;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Sorteo: ".cambiafechadmy($row['fechafin_camp']),0,0,'L');

    $pdf->SetFont('Arial','',8);
	
	$f=$pdf->GetY();
    $f=$f+6;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,$row['nombre'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,utf8_decode($row['tipo_ident'])." ".$row['nrod_cli'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Expedida en: ".utf8_decode($row['exped_cli']),0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Dir: ".$row['direccion'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Correo: ".$row['emai_cli'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Telefono: ".$row['tele_cli'],0,0,'C');

    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,"Datos de la Compra",0,0,'C');
    
    $f++;
    $pdf->SetFont('Arial','',6);
    $f=$f+3;
    $pdf->SetXY(2,$f);
    $pdf->Cell(8,3,"Num",1,0,'C');
    $pdf->SetXY(10,$f);
    $pdf->Cell(12,3,"Fecha",1,0,'C');
    $pdf->SetXY(22,$f);
    $pdf->Cell(30,3,"Local",1,0,'C');
    $pdf->SetXY(52,$f);
    $pdf->Cell(16,3,"Valor",1,0,'R');
    $total=0;
    //mysql_data_seek($consultacom,0);
    pg_result_seek($consultacom,0);
    while($rowcom=pg_fetch_array($consultacom)){
        $f=$f+3;
        $pdf->SetXY(2,$f);
        $pdf->Cell(8,3,$rowcom['ndoc_com'],0,0,'L');
        $pdf->SetXY(10,$f);
        $pdf->Cell(12,3,cambiafechadmy($rowcom['fech_com']),0,0,'L');
        $pdf->SetXY(22,$f);
        $pdf->Cell(30,3,substr($rowcom['desc_tip'],0,25),0,0,'L');
        $pdf->SetXY(52,$f);
        $pdf->Cell(16,3,$rowcom['valo_com'],0,0,'R');
        $total=$total+$rowcom['valo_com'];
    }
    $f=$f+3;
    $pdf->SetXY(22,$f);
    $pdf->Cell(30,3,"TOTAL:",0,0,'R');
    $pdf->SetXY(52,$f);
    $pdf->Cell(16,3,$total,0,0,'R');
    
    $pdf->SetFont('Arial','',8);

    $f=$f+7;
    $pdf->SetXY(0,$f);
    $pdf->Cell(68,2,"°<",0,0,'L');
    $f=$f+1;
    $pdf->SetXY(0,$f);
    $pdf->Cell(68,2,"°",0,0,'L');
}
$sql="UPDATE sisbol.boleta SET impr_bol='S' WHERE codi_bol='".$_GET['codi_bol']."'";
//echo $sql;
pg_query($link,$sql);
pg_free_result($consultaemp);
//pg_free_result($consultaplan);
pg_free_result($consultacom);
pg_free_result($consulta);
//mysql_free_result($consultado);
pg_close($link);
$pdf->Output();
?> 

