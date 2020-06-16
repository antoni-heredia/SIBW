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
    $tipo_usuario = -1;
}else{
    $tipo_usuario = $_SESSION['tipo_usuario'];
}

if(isset($_GET ['ev'])){
    $id = $_GET['ev'];
}else{
    $id = -1;
}

$evento = getEvento($id,$mysqli);
if($evento['publicado'] != 0 && $tipo_usuario != 3 && $tipo_usuario != 0){
    echo $twig->render("notienesacceso.html");
    exit();
}
$descripcion =  explode(PHP_EOL, $evento['descripcion']);
$img = explode(":", $evento['img']);

$comentarios = getComentarios($id,$mysqli);
$palabras = getPalabrasProhibidas($mysqli);
echo $twig->render("impresion.html", ['evento' => $evento,'descripcion' => $descripcion, 
                    'img'=>$img, 'comentarios'=>$comentarios, 'palabras'=>$palabras, 'tipo_usuario'=>$tipo_usuario]);
                
?>