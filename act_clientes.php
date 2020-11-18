<!-- Captura de compras -->
<HTML>
<head>
</head>
<body>
    <?
    set_time_limit(0);
    include("funciones.php");
    conectarbd();
    $archivo="tmp/clientes.csv";
    //echo $archivo;
    
    if(file_exists($archivo)){
        $fp = fopen ($archivo, "r" );
        while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
            $reg++;
            $i = 0;
            foreach($data as $dato){
                $campo[$i]=$dato;
                //echo $campo[$i].'  ';
                $i++ ;
            }
            //echo "<br>";
            $consultalo="SELECT nrod_cli FROM sisbol.cliente WHERE nrod_cli='$campo[3]'";
            //echo "<br>".$consultalo;
            $consultalo=pg_query($consultalo);
            if(pg_num_rows($consultalo)==0){
                $telefono=$campo[5].'-'.$campo[6];
                $sql_="INSERT INTO sisbol.cliente(tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli,fuco_cli)
                VALUES('01001','$campo[3]','$campo[1]','$campo[2]','$campo[4]',$telefono,'0000-00-00','','$campo[7]','04001','0','0000-00-00')";
                //echo "<br>".$sql_;
                pg_query($sql_);
                echo "<br>".$campo[3];
            }
        }
        fclose ($fp);
        echo "Fin";
    }
?>

</body>
</HTML>