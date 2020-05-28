<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");


$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader,['debug' => true]);

$mysqli = conectarBD();
session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {   
    header("Location: login.php");
    exit();
}elseif($_SESSION['tipo_usuario'] != 0  && $_SESSION['tipo_usuario'] != 3){
    echo $twig->render("notienesacceso.html");
    exit();
}
$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $twig->render("notienesacceso.html");
    exit();
}else{
    $id_evento = $_GET['idEvento'];
    $evento = getEvento($id_evento,$mysqli);
    echo $twig->render("nuevoEvento.html", ['evento' => $evento]);
}
