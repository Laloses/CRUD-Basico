<!-- Martell Hernandez Hernandez-->
<!DOCTYPE HTML>
<html>
<head>
    <meta title="crud y respaldos" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body onload="cargarCentro();">
    <header>
        <h1>CRUD Y RESPALDOS</h1>
    </header>
    <section id="centro">
                <div id="res">
                    <form id="form" action="menuP.php">
                        <input type="text" id="db" name='db' hidden>
                        <input type="submit" id="go" value="Regresar" hidden>
                    </form>
                    <?php
                        $res=false;
                        $cont=0;
                        $nombreTablas;
                        $db=$_POST['db'];
                        $dbCopia=$db."Copia";
                        $consulta="SHOW FULL TABLES FROM ".$db;
                        $conexion = new mysqli("localhost", "root", "");
                        if( $result0 = $conexion->query($consulta) ){
                            //Creamos la base de datos donde pondremos las tablas copiadas
                            $consulta = "CREATE DATABASE ".$dbCopia;
                            $conexion->query($consulta);
                            $conexion->select_db($dbCopia);
                            //Hacemos el proceso por todas las tablas encontradas
                            while($row0 = $result0->fetch_array(MYSQLI_ASSOC)){
                                //Revisamos si es una tabla y no una vista o proceso. Porque show full tables muestra 3 campos.
                                if("BASE TABLE"==$row0['Table_type']){
                                    $nombreTablas[$cont]=$row0['Tables_in_'.$db];
                                    //Se crea tablaCopia
                                    $consulta = "DROP TABLE IF EXISTS ".$nombreTablas[$cont];
                                    if( !$conexion->query($consulta) )
                                        echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                                    $consulta = "CREATE TABLE ".$nombreTablas[$cont]." LIKE ".$db.".".$nombreTablas[$cont];
                                    if( !$conexion->query($consulta) )
                                        echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
                                        
                                    //Ahora insertamos los datos
                                    $consulta="INSERT INTO ".$nombreTablas[$cont]." SELECT * FROM ".$db.".".$nombreTablas[$cont];
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
                                    "alert('Respaldo completado');".
                                    "document.getElementById('go').click()</script>";
                            }
                        }
                        else{
                            echo "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p><br>";
                            $conexion->close();
                        }
                    ?>
                </div>
    </section>
    <footer id="footer">
        <span>&copy;Programas.pro.fake.troll.mx</span>
    </footer>
    <script src="scripts.js" type="text/javascript" ></script>
</body>
</html>