<?php
// Inicializamos el motor de plantillas
require_once "./vendor/autoload.php";
$loader = new Twig_Loader_Filesystem("./templates");
$twig = new Twig_Environment($loader, ["cache" => "./cache",]);
// Averiguo que la p´agina que se quiere mostrar es la del evento 12,
// porque hemos accedido desde http://localhost/?evento=12
// Busco en la base de datos la informaci´on del evento y lo
// almaceno en las variables $eventoNombre, $eventoFecha, $eventoFoto...
echo $twig->render("plantillaEvento.html", ["nombre-" => $eventoNombre,
"fecha" => $eventoFecha, "foto" => $eventoFoto]);
?>