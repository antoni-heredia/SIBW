<?php
    function conectarBD(){
        $mysqli = new mysqli("mysql","dev","dev","SIBW");
        if($mysqli->connect_errno){
            echo("Fallo al conectar:  ".$mysqli->connect_error);
        }
        return $mysqli;
    }
    function getEvento($id,$mysqli){



        $id_usuario = $_POST["id"];

        if (!$sentencia = $mysqli->prepare("SELECT nombre, fecha, organizador,descripcion,fotos FROM eventos WHERE id = ?")) {
            echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$sentencia->bind_param("i", $id)) {
            echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }
       
        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if (!($res = $sentencia->get_result())) {
            echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $evento = array('nombre' => $row['nombre'], 'fecha' => $row['fecha'],'organizador' => $row['organizador'],'descripcion' => $row['descripcion'],'img' => $row['fotos']);
        }
        return $evento;
    }

    function getEventos($mysqli){
        $evento = array('nombre' => 'Nombre defecto', 'fecha' => 'fecha defecto','organizador'=>'organizador defecto');

    

        if (!$sentencia = $mysqli->prepare("SELECT id,nombre,fotos FROM eventos")) {
            echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
        }

       
        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if (!($res = $sentencia->get_result())) {
            echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
        }
       
        $eventos = array();
        while ($fila = $res->fetch_assoc()) {
            $img = explode(":",$fila['fotos']);
            $evento = array('id'=>$fila['id'],'nombre' => $fila['nombre'],'img'=>$img[0]);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
    function getComentarios($mysqli){

    

        if (!$sentencia = $mysqli->prepare("SELECT autor,email,comentario,fecha FROM comentario")) {
            echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
        }

       
        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if (!($res = $sentencia->get_result())) {
            echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
        }
       
        $comentarios = array();
        while ($fila = $res->fetch_assoc()) {
            $comentario = array('autor'=>$fila['autor'],'email' => $fila['email'],'comentario'=>$fila['comentario'],'fecha'=>$fila['fecha']);
            array_push($comentarios, $comentario);
        }
        return $comentarios;
    }
?>