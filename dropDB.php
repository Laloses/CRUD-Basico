<!-- Martell Hernandez Hernandez-->
<!DOCTYPE=html>
<html>
<head>
    <meta title="ELIMINAR DATABSE" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body onload="cargarCentro();">
    <header id="header">
            <h1>ELIMINAR UNA BASE DE DATOS</h1>
    </header>
    <section id="centro">
        <article>
            <form method="post">
            <br><br>
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
            $consulta="DROP DATABASE $nombreBD;";
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
            
    echo "<script>
        document.getElementById('result').innerHTML = '".$res."'; </script>";
    $conexion->close();
    }
?>