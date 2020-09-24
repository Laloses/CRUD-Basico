<!-- Martell Hernandez Hernandez-->
<!DOCTYPE HTML>
<html>
<head>
    <meta title="crud y respaldos" charset="utf-8" lang="es">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body onload="cargarCentro();">>
    <header id="header">
        <h1>CRUD Y RESPALDOS</h1>
    </header>
    <section id="centro">
            <h2>BASE DE DATOS</h2>
                <button onclick="abrir('createDB')"><a>Crear base de datos</a></button><br>
                <button onclick="abrir('dropDB')"><a>Borrar base de datos</a></button>
            <h2>TABLAS</h2>
                <button onclick="abrir('createT')"><a>Crear una tabla</a></button><br>
                <button onclick="abrir('dropT')"><a>Borrar una tabla</a></button>
            <h2>REGISTROS</h2>
                <button onclick="abrir('insert')"><a>Ingresar un registro</a></button><br>
                <button onclick="abrir('update')"><a>Modificar un registro</a></button><br>
                <button onclick="abrir('delete')"><a>Borrar un registro</a></button><br><br>
                <div id="res">
            <h2>RESPALDOS</h2>
                    <?php
                        include("conectarDB.php");
                        require("buscarRespaldoDB.php");
                        if( isset($volverCargar) && $volverCargar){
                            echo "<script> history.reload() </script>";
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