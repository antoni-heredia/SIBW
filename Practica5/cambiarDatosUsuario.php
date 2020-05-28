<?php
//  el motor de plantillas
include("bd.php");


session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    exit();
}elseif($_SESSION['tipo_usuario'] != 0){
    echo $twig->render("notienesacceso.html");
    exit();
}


$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id =  $_POST['id'];
    $nick = $_POST['nick'];
    $nombre = $_POST['fname'];
    $apellido = $_POST['lname'];
    $email = $_POST['email'];
    actualizarInformaciónUsuario($id,$nick,$nombre,$apellido,$email,$mysqli);
    $tipo_anterior = getTipoUsuario($nick,$mysqli);
    $tipo = $_POST['tipo'];

    if($tipo_anterior == 0){
        $cantidad = getCantidadAdmin($mysqli);
        if($cantidad > 1 | $tipo == 0)
            cambiarRol($id, $tipo, $mysqli);
    }else{
        cambiarRol($id, $tipo, $mysqli);
    }

    header("Location: administracion.php");
    exit();
}
