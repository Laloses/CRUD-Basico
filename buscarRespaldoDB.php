<!-- Martell Hernandez Hernandez-->
<?php
    //BUSCAR RESPALDO
    if( isset($hayConexion) && $hayConexion==true ){

        //Mostramos los botones para hacer respaldos o cargar uno
        if( $conexion->select_db($db."Copia") ){
            echo "Hay respaldo de la base de datos.<br>";
            echo "<form action='cargarCopia.php' >".
                "<input type='text' name='db' value='".$db."' hidden>".
                "<input id='uCopia' type='submit' value='USAR COPIA'>".
                "</form>";

                echo "<form action='hacerCopia.php' method='post'>".
                "<input type='text' name='db' value='".$db."' hidden>".
                "<input id='nCopia' type='submit' value='REESCRIBIR COPIA'>".
                "</form>";
        }
        else{
            echo "No hay respaldo de la base de datos.<br>";
            echo "<form action='hacerCopia.php' method='post'>".
                "<input type='text' name='db' value='".$db."' hidden>".
                "<input id='nCopia' type='submit' value='NUEVA COPIA'>".
                "</form>";

                //Verificamos si ya es otro dia, si sí se debe hacer automaticamente un respaldo del inicio del dia
                $row = $conexion->query("SELECT NOW() as date");
                $fecha = $row ->fetch_array(MYSQLI_ASSOC);
                $file = "ultimoRespaldo.txt";
                $ultimaF = file_get_contents($file);
        
                //Si ya es otro dia
                if($fecha['date'] != $ultimaF){
                    //guardamos la nueva fecha
                    if( file_put_contents($file,$fecha['date']) == FALSE){
                        echo "<script>alert('Error al escribir en el archivo ultimoRespaldo.txt'); </script>";
                    }
                    else{
                        echo "<script> if( confirm('¿Realizar la copia del dia de hoy?') ) document.getElementById('nCopia').click(); </script>";
                    }
                }
        }

    }
?>