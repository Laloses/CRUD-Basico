<!-- Martell Hernandez Hernandez-->
<?php
$error = "[ERROR]: LA BASE DE DATOS SELECICONADA NO EXISTE.<br>FALLÓ LA CONEXION.<br>";
$mandarInicio = "<button onclick='location.replace(\" http://localhost/BDTest/ \")'> Seleccionar DB </button>";
    if(isset( $_POST['db'] )){
        $db = $_POST['db'];
        $conexion = new mysqli("localhost", "root", "");
        if(!$conexion->connect_error){
            if($conexion->select_db($db)){
                    echo "Se leyo correctamente la base de datos: ".$db."<br>";
                    $hayConexion=true;
            }else{
                echo $error;
                echo $conexion->connect_error."<br>".$conexion->error."<br>";
                $hayConexion=false;
                echo $mandarInicio;
            }
        }
        else{
                echo $error;
                echo $conexion->connect_error."<br>".$conexion->error."<br>";
                $hayConexion=false;
                echo $mandarInicio;
        }
    }
    else{
        echo $error;
        $hayConexion=false;
        echo $mandarInicio;
    }
?>