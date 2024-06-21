<?php
//Aqui valido que las fechas sean v�lidas
function validafecha($xfecha_)
{
  $xdia_=substr($xfecha_,0,2);
  $xmes_=substr($xfecha_,3,2);
  $xanio_=substr($xfecha_,6,4);
  if ($xdia_*1==0 or $xmes_*1==0 or $xanio_*1==0)
    {return 0;}
  else{
    if (checkdate($xmes_,$xdia_,$xanio_))
      {return 1;}
    else{
      return 0;}
  }
}

//Funcion que retorna la fecha actual en el formato "dd/mm/aaaa"
function hoy()
{
   $hoy_=date("d").'/'.date("m").'/'.date("Y");
   return $hoy_;
}

//Funcion que cambia el formato de la fecha que recibe
//la recibe en formato "dd/mm/yyyy" y la retorna en formato "yyyy/mm/dd"
function cambiafecha($xfecha_)
{
  $xdia_=substr($xfecha_,0,2);
  $xmes_=substr($xfecha_,3,2);
  $xanio_=substr($xfecha_,6,4);
  $xfecha_=$xanio_."/".$xmes_."/".$xdia_;
  return $xfecha_;
}

//Funcion que cambia el formato de la fecha que recibe
//la recibe en formato "yyyy/mm/dd" y la retorna en formato  "dd/mm/yyyy"
function cambiafechadmy($xfecha_)
{
  $xanio_=substr($xfecha_,0,4);
  $xmes_=substr($xfecha_,5,2);
  $xdia_=substr($xfecha_,8,2);

  $xfecha_=$xdia_."/".$xmes_."/".$xanio_;
  return $xfecha_;
}

//Conexion con la base
function conectarbd()
{
  //conexion local
  //$conexion = pg_connect("host='127.0.0.1' port='5432' dbname='sisbolbd_uc' user='postgres' password='12996873'") or die('No se ha podido conectar: ' . pg_last_error());
  //conexion cloud
  $conexion=pg_connect("host='ccqnant9i80rgh.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com' port='5432' dbname='d7kmu10ihe35b8' user='u7vrtllppvssi9' password='p9946f49472d3d7bf499aa8f17266c4f12309aa1451a1120dd6c6a322c1d0e2c2'") or die('No se ha podido conectar: ' . pg_last_error());
  if(!$conexion){
    echo "No hay conexión con la BD";
  }
  //pg_set_charset($conexion,"utf8");
  return $conexion;
}

//Conexion con la base
function conectarbdg()
{
   mysql_connect("localhost","root");
   //selecci�n de la base de datos con la que vamos a trabajar 
   mysql_select_db("lyr_general");
}

//Funcion que debuelve el estado de las personas en la relacion comercial
function estadocom($xestado_)
{
  switch($xestado_){
    case 'A':
	  $nestado_='Activ@';
	  break;
    case 'I':
	  $nestado_='Inactiv@';
	  break;
    case 'E':
	  $nestado_='Espor�dic@';
	  break;
  }
  return $nestado_;  
}

//Funcion que debuelve el estado de los movimientos de facturaci�n
function estadofac($xestado_)
{
  switch($xestado_){
    case 'A':
	  $nestado_='Activ@';
	  break;
    case 'C':
	  $nestado_='Cerrad@';
	  break;
    case 'N':
	  $nestado_='Anulad@';
	  break;
  }
  return $nestado_;  
}

function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}

?>
