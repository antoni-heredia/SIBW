<?php

include("bd.php");
//get the q parameter from URL
$q=$_GET["q"];
$mysqli = conectarBD();
session_start();

if(isset($_SESSION['nickUsuario'])  && ($_SESSION['tipo_usuario'] == 3 || $_SESSION['tipo_usuario'] == 0)){
  $eventos=getEventosPalabras($q,$mysqli);
}else{
  $eventos=getEventosBusquedaPublicado($q,$mysqli);
}
//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";

    foreach($eventos as $evento){
        $hint = $hint."<a class='panel'  href='evento.php?ev=" .$evento['id'].
        "' target='_blank'>" .$evento['nombre']. "</a>";
    }
  
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no hay coincidencias";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>