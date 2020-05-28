<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");


$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader, ['debug' => true]);
$mysqli = conectarBD();
session_start();

//Si no esta loggeado tiene se le redirige al login
if (!isset($_SESSION['nickUsuario'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['tipo_usuario'] != 0  && $_SESSION['tipo_usuario'] != 2) {
    echo $twig->render("notienesacceso.html");
    exit();
}

$mysqli = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEvento = $_POST['idEvento'];
    $nombre = $_POST['nombre'];
    $organizador = $_POST['organizador'];
    $etiquetas = $_POST['etiquetas'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    // Contamos cuantas fotos hay
    $countfiles = count($_FILES['fotos']['name']);
    // Looping all files
    if (is_uploaded_file($_FILES['fotos']['tmp_name'][0]))
        for ($i = 0; $i < $countfiles; $i++) {
            if ($i > 0)
                $imagenes = $imagenes . ":";
            $filename = $_FILES['fotos']['name'][$i];
            $ruta = 'img/subidas/' . $filename;
            $imagenes = $imagenes . $ruta;
            // Upload file
            move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $ruta);
        }
    $publicado = 1;
    if (isset($_POST['publicado']))
        $publicado = 0;

    
    #Si es algo nuevo se creara el evento, si no sera editado
    if ($idEvento != -1) {
        if (!isset($imagenes))
            modificarEvento($idEvento, $nombre, $organizador, $etiquetas, $fecha, $descripcion, $publicado, $mysqli);
        else
            modificarEventoImg($idEvento, $nombre, $organizador, $etiquetas, $fecha, $descripcion, $imagenes,$publicado, $mysqli);
    } else {
        $idEvento = nuevoEvento($nombre, $organizador, $etiquetas, $fecha, $descripcion, $imagenes,$publicado, $mysqli);
    }

    header("Location: evento.php?ev=" . $idEvento);
    exit();
} else {
    echo $twig->render("notienesacceso.html");
    exit();
}
