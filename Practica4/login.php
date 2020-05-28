<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader,['debug' => true]);

$mysqli = conectarBD();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $pass = $_POST['contraseña'];
  
    if (checkLogin($nick, $pass,$mysqli)) {
        $tipo_usuario = getTipoUsuario($nick,$mysqli);
        $id_usuario = getIdUsuario($nick,$mysqli);
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nickUsuario'] = $nick;
        $_SESSION['tipo_usuario'] = $tipo_usuario;
        header("Location: administracion.php");
        exit();
    }   
    
    
  }
echo $twig->render("./login.html", );
?>