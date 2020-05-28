<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader,['debug' => true]);

session_start();

//Si  esta loggeado tiene se le redirige al login
if (isset($_SESSION['nickUsuario'])) {
    header("Location: administracion.php");
    exit();
}

$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $nombre = $_POST['fname'];
    $apellido = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass1'];
    nuevoUsuario($nick,$nombre,$apellido,$email,$pass,$mysqli);
    header("Location: administracion.php");
    exit();
}

echo $twig->render("registrarse.html",);


?>