<?php
include("bd.php");


session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    exit();
}

$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'];   
    $id_evento = $_POST['idEvento'];
    $comentario = $_POST['comentario'];
    subirComentario($id_evento, $id_usuario,$comentario, $mysqli);

    header("Location: evento.php?ev=".$id_evento);
    exit();
}
