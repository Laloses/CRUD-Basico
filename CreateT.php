<!-- Martell Hernandez Hernandez-->
<!DOCTYPE=html>
<html>
<head>
    <meta title="CREAR TABLA" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body onload="cargarCentro();">>
    <header>
            <h1>CREAR UNA TABLA</h1>
    </header>
    <section id="centro">
        <article>
            <form method="post">
                <label>Nombre de la base de datos</label><input type="text" name="db" required autofocus><br>
                <label>Nombre de la nueva tabla</label><input type="text" name="tbName" required><br>
                <label>Número de atributos: </label><input type="number" id="numAtr" name="numAtributos" onchange="revisarAtr()" required><br>
                <div id="atr"></div>
                <button  type="submit">Aceptar</button>
            </form>
            <div id="result"></div>
        </article>
    </section>
    <footer>
            <p>&copy;Programas.pro.mx.fake.troll.com</p>
    </footer>
    <script src="scripts.js" type="text/javascript" ></script>
</body>
</html>
<?php
    if( isset( $_POST['db']) ){
        $nombreBD = $_POST['db'];
        $nombreTB = $_POST['tbName'];
        $numAtr = $_POST['numAtributos'];
    }
    if( !empty($nombreBD) && !empty($nombreTB) ){
        $conexion = new mysqli("localhost", "root", "");
        if(!$conexion->connect_error && $conexion->select_db($nombreBD)){
            $consulta="CREATE TABLE $nombreTB(";
            for($i=0; $i<$numAtr; $i++){
                $atrNom="atr".$i;
                $atrValue="atrVal".$i;
                if($i<$numAtr-1){
                    $consulta.=$_POST[$atrNom]." ";
                    $consulta.=$_POST[$atrValue].",";
                }else{
                    $consulta.=$_POST[$atrNom]." ";
                    $consulta.=$_POST[$atrValue];
                }
            }
            $consulta.=");";
            if( $conexion->query($consulta) ) {
                $res = "La consulta se puede ejecutar correctamente con: ".$consulta."";
                echo "<script> 
                    if( confirm('$res') ) window.close(); 
                    </script>";
            }
            else {
                $res = "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
            }
        }
        else $res = "Falló la conexión<br>".$conexion->connect_error."<br/>";
            
    echo '<script>
        document.getElementById("result").innerHTML = "'.$res.'"; </script>';
    $conexion->close();
    }
?>