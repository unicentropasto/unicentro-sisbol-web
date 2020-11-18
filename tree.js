//----------DHTML Tree Created using Likno Drop-Down Menu Trees ver 1.1-#134---------------
//D:\MENU\MENU1.awt
var ldmtAT="treeid";
tree = new LiknoTreeRoot("tree", "treeid", 0, 0, 0, 0, 16, false, "border:0; background-color:#FFFFFF;padding:4px;", "png");
tree.setImagesDir("images/macosx/");
tree.addClass("de", "font-family:Tahoma, Arial, sans-serif; font-size:11px; color:black; background-color:transparent; text-decoration:none; font-weight:normal;");
tree.addClass("mo", "font-family:Tahoma, Arial, sans-serif; font-size:11px; text-decoration:underline; color:blue;");
tree.addClass("se", "font-family:Tahoma, Arial, sans-serif; font-size:11px; color:black; background-color:#EBF2FA; border:1px solid #DFDFE1;");

tree.setClickToExpand(true);
tI1=tree.addLeafWithParams("Captura","","",true,"");
  tI7=tI1.addLeafWithParams("Compras","cliente11.php","",false,"");
  tI7.statusbarText="CLIENTE11.PHP";
  tI8=tI1.addLeafWithParams("Cliente","CLIENTE12.PHP","FRA_01",false,"");
  tI8.statusbarText="CLIENTE12.PHP";
tI2=tree.addLeafWithParams("Informes","","",true,"");
  tI4=tI2.addLeafWithParams("Clientes","INFORME21","FRA_01",false,"");
  tI4.statusbarText="INFORME21";
tI3=tree.addLeafWithParams("Herramientas","","",true,"");
  tI6=tI3.addLeafWithParams("Tipos","TIPO31","FRA_01",false,"");
  tI6.statusbarText="TIPO31";
  tI9=tI3.addLeafWithParams("Plan","TIPO32","FRA_01",false,"");
  tI9.statusbarText="TIPO32";
tree.drawTree();
