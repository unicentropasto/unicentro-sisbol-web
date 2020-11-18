<?
session_register('Gcodi_ucs');
?>
//----------DHTML Tree Created using Likno Drop-Down Menu Trees ver 1.1-#134---------------
//D:\MENU\MENU1.awt
var ldmtAT="treeid";
tree = new LiknoTreeRoot("tree", "treeid", 0, 0, 0, 0, 16, false, "border:0; background-color:#FFFFFF;padding:4px;", "png");
tree.setImagesDir("images/macosx/");
tree.addClass("de", "font-family:Tahoma, Arial, sans-serif; font-size:11px; color:black; background-color:transparent; text-decoration:none; font-weight:normal;");
tree.addClass("mo", "font-family:Tahoma, Arial, sans-serif; font-size:11px; text-decoration:underline; color:blue;");
tree.addClass("se", "font-family:Tahoma, Arial, sans-serif; font-size:11px; color:black; background-color:#EBF2FA; border:1px solid #DFDFE1;");
tree.setClickToExpand(true);
<?
  //Aqui cargo las funciones 
  include("funciones.php");
  conectarbd();
  $consultatp=mysql_query("SELECT tipo_ucs FROM u_cliseb WHERE codi_ucs=$Gcodi_ucs");
  $rowtp=mysql_fetch_array($consultatp);
  $tipo_ucs=$rowtp[tipo_ucs];
  $consulta=mysql_query("SELECT codi_men,desc_men FROM menu WHERE nive_men='1'");
  while($row=mysql_fetch_array($consulta)){
    ?>
      tI1=tree.addLeafWithParams("<?echo $row[desc_men];?>","","",true,"");
	<?
	if($tipo_ucs=='1'){
	  $consulta2=mysql_query("SELECT codi_men,desc_men,url_men FROM menu WHERE nive_men='2' AND depe_men=$row[codi_men]");
	}
	else{
	  $consulta2=mysql_query("SELECT m.codi_men,m.desc_men,m.url_men FROM menu AS m
	                        INNER JOIN um_cliseb AS um ON um.codi_men=m.codi_men
							INNER JOIN u_cliseb AS u ON u.codi_ucs=um.codi_ucs
	                        WHERE m.nive_men='2' AND um.codi_ucs=$Gcodi_ucs AND m.depe_men=$row[codi_men]");
	}
	//echo $row[codi_men];
	//$consulta2=mysql_query("SELECT codi_men,desc_men,url_men FROM menu WHERE nive_men='2' AND depe_men=$row[codi_men]");
	while($row2=mysql_fetch_array($consulta2)){
	  ?>
	    tI7=tI1.addLeafWithParams("<?echo $row2[desc_men];?>","<?echo $row2[url_men];?>","fr03",false,"");
	    tI7.statusbarText="<?echo $row2[desc_men];?>";
	  <?
	}
  }
mysql_free_result($consulta);
mysql_free_result($consulta2);
mysql_free_result($consultatp);
mysql_close();
?>
tree.drawTree();
