<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");
$twig = new Twig\Environment($loader, ['debug' => true]);

// Averiguo que la p´agina que se quiere mostrar es la del evento 12,
// porque hemos accedido desde http://localhost/?evento=12
// Busco en la base de datos la informaci´on del evento y lo
// almaceno en las variables $eventoNombre, $eventoFecha, $eventoFoto...

$mysqli = conectarBD();
$eventos = getEventosPublicados($mysqli);

echo $twig->render("./principal.html", ['eventos' => $eventos]);
