<!-- Martell Hernandez Hernandez-->
<!DOCTYPE HTML>
<html>
<head>
    <meta title="crud y respaldos" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <header>
        <h1>CRUD Y RESPALDOS</h1>
    </header>
    <section id="centro">
                <div id="res">
                    <form id="form" action="menuP.php">
                        <input type="text" id="db" name='db' hidden>
                        <input type="submit" id="go" value="Regresar" hidden>
                    </form>
                <?
                    $cont =0;
                    $res=false;
                    $db=$_POST['db'];
                    $dbCopia=$db."Copia";
                    $conexion = new mysqli("localhost", "root", "");
                    $consulta="DROP DATABASE ".$db;
                    if( !$conexion->query($consulta) )
                        echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                    
                    $consulta="CREATE DATABASE ".$db;
                    if( !$conexion->query($consulta) )
                        echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                    
                    $consulta="SHOW FULL TABLES FROM ".$dbCopia;
                    if( $result0 = $conexion->query($consulta) ){

                        $conexion->select_db($db);
                        //Hacemos el proceso por todas las tablas encontradas
                        while($row0 = $result0->fetch_array(MYSQLI_ASSOC)){
                            //Revisamos si es una tabla y no una vista o proceso. Porque show full tables muestra 3 campos.
                            if("BASE TABLE"==$row0['Table_type']){
                                $nombreTablas[$cont]=$row0['Tables_in_'.$dbCopia];
                                //Se crea tablaCopia
                                $consulta = "CREATE TABLE ".$nombreTablas[$cont]." LIKE ".$dbCopia.".".$nombreTablas[$cont];
                                if( !$conexion->query($consulta) )
                                    echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                                    
                                //Ahora insertamos los datos
                                $consulta="INSERT INTO ".$nombreTablas[$i]." SELECT * FROM ".$dbCopia.".".$nombreTablas[$i];
                                if( !$conexion->query($consulta) ){
                                    echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                                    $res=false;
                                }
                                else $res = true;
                                $cont++;
                            }
                        }
                        $result0->free();
                        $conexion->close();
                        if($res){
                            echo "<script> 
                                document.getElementById('db').value ='".$db."';".
                                "alert('Respaldo cargado correctamente');".
                                "document.getElementById('go').click() </script>";
                        }
                    }
                    }
                    else  echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                ?>
                
                </div>
    </section>
    <footer id="footer">
        <span>&copy;Programas.pro.fake.troll.mx</span>
    </footer>
    <script src="scripts.js" type="text/javascript" ></script>
</body>
</html>