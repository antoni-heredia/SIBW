<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new Twig_Loader_Filesystem("./templates");
$twig = new Twig_Environment($loader,['debug' => true]);

$mysqli = conectarBD();

if(isset($_GET ['ev'])){
    $id = $_GET['ev'];
}else{
    $id = -1;
}
$evento = getEvento($id,$mysqli);
$descripcion =  explode(PHP_EOL, $evento['descripcion']);
$img = explode(":", $evento['img']);

$comentarios = getComentarios($mysqli);
$palabras = getPalabrasProhibidas($mysqli);
echo $twig->render("evento.html", ['evento' => $evento,'descripcion' => $descripcion, '
                    img'=>$img, 'comentarios'=>$comentarios, 'palabras'=>$palabras]);
?>