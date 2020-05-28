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
}elseif($_SESSION['tipo_usuario'] != 0  && $_SESSION['tipo_usuario'] != 2){
    echo $twig->render("notienesacceso.html");
    exit();
}

$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_comentario = $_POST['id_comentario'];
    $comentario = $_POST['comentario'];
    $comentario = $comentario . "\n----Mensaje editado por el moderador----";
    actualizarComentario($id_comentario, $comentario, $mysqli);
    header("Location: administracion.php");
    exit();
}else{

    $id_comentario = $_GET['id_comentario'];
    $comentario = getComentario($id_comentario,$mysqli);
    echo $twig->render("editarComentario.html", ['id_comentario' => $id_comentario, 'comentario' => $comentario['comentario']]);
}
