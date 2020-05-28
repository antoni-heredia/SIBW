<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader,['debug' => true]);
session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    
}

$id =  $_SESSION['id_usuario'];
$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $nombre = $_POST['fname'];
    $apellido = $_POST['lname'];
    $email = $_POST['email'];
    actualizarInformaciónUsuario($id,$nick,$nombre,$apellido,$email,$mysqli);
}
$usuario = getUsuario($id,$mysqli);

if($_SESSION['tipo_usuario']== 0){
    $usuarios = getUsuarios($mysqli);
    $comentarios = getTodosComentarios($mysqli);
    if (isset($_GET['buscador'])) {
        $buscador = $_GET['buscador'];
        $eventos = getEventosPalabras($buscador,$mysqli);
    }else{
        $eventos = getEventos($mysqli);
    }
    echo $twig->render("root.html",['usuario' => $usuario, 'usuarios' => $usuarios, 'comentarios'=>$comentarios,'eventos'=>$eventos]);
}elseif($_SESSION['tipo_usuario']== 1){
    #Usuario solo registrado
    echo $twig->render("registrado.html",['usuario' => $usuario]);
}elseif($_SESSION['tipo_usuario']== 2){
    #moderador
    $comentarios = getTodosComentarios($mysqli);
    echo $twig->render("moderador.html",['usuario' => $usuario, 'comentarios'=>$comentarios]);
    
}elseif($_SESSION['tipo_usuario']== 3){
    #gestor
    $eventos = getEventos($mysqli);
    echo $twig->render("gestor.html",['usuario' => $usuario, 'eventos'=>$eventos]);
}


?>