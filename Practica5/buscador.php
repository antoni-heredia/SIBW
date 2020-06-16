<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader, ['debug' => true]);



echo $twig->render("./buscador.html", []);