<!-- Martell Hernandez Hernandez-->
<!DOCTYPE=html>
<html>
<head>
    <meta title="CREAR DATABSE" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body onload="cargarCentro();">>
    <header>
            <h1>CREAR UNA BASE DE DATOS</h1>
    </header>
    <section id="centro">
        <article>
            <form method="post">
                <label>Nombre de la base de datos</label><input type="text" name="db" required><br>
                <button type="submit">Aceptar</button>
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
    }
    if(!empty($nombreBD) ){
        $conexion = new mysqli("localhost", "root", "");
        if(!$conexion->connect_error){
            $consulta="CREATE DATABASE $nombreBD;";
            if( $conexion->query($consulta) ) {
                $conexion->select_db($nombreBD);
                $res = "La consulta se puede ejecutar correctamente con: ".$consulta."";
                echo "<script> 
                    if( confirm('$res') ){ window.open('index.html');  window.close();}
                    </script>";
            }
            else {
                $res = "<p> Error en la consulta<br> Usando ".$consulta."<br>".$conexion->error." </p>";
            }
        }
        else $res = "Falló la conexión<br>".$conexion->connect_error."<br/>";
            
    echo "<script>
        document.getElementById('result').innerHTML = '".$res."'; </script>";
    $conexion->close();
    }
?>