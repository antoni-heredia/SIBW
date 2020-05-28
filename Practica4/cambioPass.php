<?php
include("bd.php");


session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    exit();
}

$id =  $_SESSION['id_usuario'];
$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $pass = $_POST['pass1'];
    cambiarPass($id,$pass,$mysqli);
    header("Location: administracion.php");
    exit();
}


?>