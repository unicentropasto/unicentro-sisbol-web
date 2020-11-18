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
  $consulta=mysql_query("SELECT codi_men,desc_men FROM menu WHERE nive_men='1'");
  while($row=mysql_fetch_array($consulta)){
    ?>
      tI1=tree.addLeafWithParams("<?echo $row[desc_men];?>","","",true,"");
	<?
	$consulta2=mysql_query("SELECT codi_men,desc_men,url_men FROM menu WHERE nive_men='2' AND depe_men=$row[codi_men]");
	while($row2=mysql_fetch_array($consulta2)){
	  ?>
	    tI7=tI1.addLeafWithParams("<?echo $row2[desc_men];?>","<?echo $row2[url_men];?>","fr03",false,"");
	    tI7.statusbarText="<?echo $row2[desc_men];?>";
	  <?
	}
  }
  
?>

tree.drawTree();
<?
echo "adf";
?>