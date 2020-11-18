<html>
<?php
$cadena='';
$archivo="tmp/bol_".$_GET['codi_cli'].".txt";
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        if($reg<>$_GET['borrar_']){
            $cadena=$cadena.$campo[0].',';
            $cadena=$cadena.$campo[1].',';
            $cadena=$cadena.$campo[2].',';
            $cadena=$cadena.$campo[3].',';
            $cadena=$cadena.$campo[4].',';
            $cadena=$cadena."$campo[5]\n";
        }
    }
    fclose ($fp);
    unlink($archivo);
    $fp=fopen($archivo,"a");
    fwrite($fp,$cadena);
    fclose($fp);
}
?>
<head>
</head>
<body onload=window.open("cse_ccompra1.php?codi_cli=<?php echo $_GET['codi_cli'];?>","_self")>
</body>
</html>
