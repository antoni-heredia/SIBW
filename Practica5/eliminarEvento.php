<?php
include("bd.php");


session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    exit();
}elseif($_SESSION['tipo_usuario'] != 0  && $_SESSION['tipo_usuario'] != 2){
    echo $twig->render("notienesacceso.html");
    exit();
}


$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_evento = $_POST['idEvento'];   

    eliminarEvento($id_evento, $mysqli);

    header("Location: administracion.php");
    exit();
}
