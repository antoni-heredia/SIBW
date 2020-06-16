<?php
function conectarBD()
{
    $mysqli = new mysqli("mysql", "dev", "dev", "SIBW");
    if ($mysqli->connect_errno) {
        echo ("Fallo al conectar:  " . $mysqli->connect_error);
    }
    return $mysqli;
}
function getEvento($id, $mysqli)
{

    $id_usuario = $_POST["id"];

    if (!$sentencia = $mysqli->prepare("SELECT etiquetas, nombre, fecha, organizador,descripcion,fotos,publicado FROM eventos WHERE id = ?")) {
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

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $evento = array('id'=>$id,'etiquetas'=>$row['etiquetas'],'nombre' => $row['nombre'], 'fecha' => $row['fecha'], 'organizador' => $row['organizador'], 'descripcion' => $row['descripcion'], 'img' => $row['fotos'],'publicado' => $row['publicado']);
    }
    return $evento;
}

function getEventos($mysqli)
{
    $evento = array('id'=>-1,'nombre' => 'Nombre defecto', 'fecha' => 'fecha defecto', 'organizador' => 'organizador defecto');



    if (!$sentencia = $mysqli->prepare("SELECT id,nombre,fotos,fecha,organizador,publicado FROM eventos")) {
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
        $img = explode(":", $fila['fotos']);
        $evento = array('id' => $fila['id'],'fecha'=>$fila['fecha'], 'nombre' => $fila['nombre'], 'img' => $img[0],'publicado' => $fila['publicado']);
        array_push($eventos, $evento);
    }
    return $eventos;
}

function getEventosPublicados($mysqli)
{
    $evento = array('id'=>-1,'nombre' => 'Nombre defecto', 'fecha' => 'fecha defecto', 'organizador' => 'organizador defecto');



    if (!$sentencia = $mysqli->prepare("SELECT id,nombre,fotos,fecha,organizador FROM eventos WHERE publicado = 0")) {
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
        $img = explode(":", $fila['fotos']);
        $evento = array('id' => $fila['id'],'fecha'=>$fila['fecha'], 'nombre' => $fila['nombre'], 'img' => $img[0]);
        array_push($eventos, $evento);
    }
    return $eventos;
}

function getEventosPalabras($buscador,$mysqli){
    $evento = array('id'=>-1,'nombre' => 'Nombre defecto', 'fecha' => 'fecha defecto', 'organizador' => 'organizador defecto');

    if (!$sentencia = $mysqli->prepare("SELECT id,nombre,fotos,fecha,organizador FROM eventos WHERE nombre LIKE CONCAT('%',?,'%') OR descripcion LIKE CONCAT('%',?,'%')")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("ss", $buscador,$buscador)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $eventos = array();
    while ($fila = $res->fetch_assoc()) {
        $img = explode(":", $fila['fotos']);
        $evento = array('id' => $fila['id'],'fecha'=>$fila['fecha'], 'nombre' => $fila['nombre'], 'img' => $img[0]);
        array_push($eventos, $evento);
    }
    return $eventos;
}
function getEventosBusquedaPublicado($buscador,$mysqli){
    $evento = array('id'=>-1,'nombre' => 'Nombre defecto', 'fecha' => 'fecha defecto', 'organizador' => 'organizador defecto');

    if (!$sentencia = $mysqli->prepare("SELECT id,nombre,fotos,fecha,organizador FROM eventos WHERE (descripcion LIKE CONCAT('%',?,'%') OR nombre LIKE CONCAT('%',?,'%')) AND publicado = 0")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("ss", $buscador,$buscador)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $eventos = array();
    while ($fila = $res->fetch_assoc()) {
        $img = explode(":", $fila['fotos']);
        $evento = array('id' => $fila['id'],'fecha'=>$fila['fecha'], 'nombre' => $fila['nombre'], 'img' => $img[0]);
        array_push($eventos, $evento);
    }
    return $eventos;
}
//Devuelve los comentarios de un evento
function getComentarios($id, $mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT id,autor,email,comentario,fecha FROM comentario where id_evento = ?")) {
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

    $comentarios = array();
    while ($fila = $res->fetch_assoc()) {
        $comentario = array('id'=>$fila['id'],'autor' => $fila['autor'], 'email' => $fila['email'], 'comentario' => $fila['comentario'], 'fecha' => $fila['fecha']);
        array_push($comentarios, $comentario);
    }
    return $comentarios;
}
//Devuelve los comentarios de un evento
function getTodosComentarios($mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT id,autor,email,comentario,fecha FROM comentario ")) {
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
        $comentario = array('id'=>$fila['id'],'autor' => $fila['autor'], 'email' => $fila['email'], 'comentario' => $fila['comentario'], 'fecha' => $fila['fecha']);
        array_push($comentarios, $comentario);
    }
    return $comentarios;
}
//Devuelve un comentario dado un id
function getComentario($id, $mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT id,id_evento,autor,email,comentario,fecha FROM comentario where id = ?")) {
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

    while ($fila = $res->fetch_assoc()) {
        $comentario = array('id'=>$fila['id'],'id_evento' => $fila['id_evento'],'autor' => $fila['autor'], 'email' => $fila['email'], 'comentario' => $fila['comentario'], 'fecha' => $fila['fecha']);
    }
    return $comentario;
}

function getPalabrasProhibidas($mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT palabra FROM palabrasprohibidas")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }


    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $palabras = array();
    while ($fila = $res->fetch_assoc()) {
        $palabra = array('palabra' => $fila['palabra']);
        array_push($palabras, $palabra);
    }
    return $palabras;
}
// Devuelve true si existe un usuario con esa contraseña
function checkLogin($nick, $pass, $mysqli)
{
    if (!$sentencia = $mysqli->prepare("SELECT nickname,pass FROM usuarios")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }


    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $palabras = array();

    while ($fila = $res->fetch_assoc()) {

        if ($nick   === $fila['nickname']) {
            if (password_verify($pass, $fila['pass'])) {
                return true;
            }
        }
    }


    return false;
}
//Devuelve el tipo de usuario
function getTipoUsuario($nick, $mysqli)
{
    if (!$sentencia = $mysqli->prepare("SELECT tipo FROM usuarios where nickname = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$sentencia->bind_param("s", $nick)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $palabras = array();

    $fila = $res->fetch_assoc();
    return $fila['tipo'];
}
function getIdUsuario($nick, $mysqli)
{
    if (!$sentencia = $mysqli->prepare("SELECT id FROM usuarios where nickname = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$sentencia->bind_param("s", $nick)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    $palabras = array();

    $fila = $res->fetch_assoc();
    return $fila['id'];
}
//devolver la información de todos los usuarios
function getUsuarios($mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT id,nickname,nombre,apellido,email,tipo FROM usuarios" )) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }


    $usuarios = array();
    
    while ($fila = $res->fetch_assoc()) {
        $usuario = array('id'=>$fila['id'],'nombre' => $fila['nombre'], 
        'nickname' => $fila['nickname'], 'apellido' => $fila['apellido'], 
        'email' => $fila['email'],'tipo' => $fila['tipo']);
        array_push($usuarios, $usuario);

    }
    return $usuarios;
}

//devolver la información de un usuario
function getUsuario($id, $mysqli)
{

    if (!$sentencia = $mysqli->prepare("SELECT nickname, nombre,apellido,email FROM usuarios WHERE id = ?")) {
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

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $evento = array('nombre' => $row['nombre'], 'nickname' => $row['nickname'], 'apellido' => $row['apellido'], 'email' => $row['email']);
    }
    return $evento;
}
function  subirComentario($id_evento, $id_usuario,$comentario, $mysqli){
    $usuario = getUsuario($id_usuario, $mysqli);

    if (!$sentencia = $mysqli->prepare("INSERT INTO comentario (id_evento, autor, fecha, comentario, email)  VALUES (?,?,NOW(),?,?)")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }


    if (!$sentencia->bind_param("isss", $id_evento, $usuario['nickname'],$comentario, $usuario['email'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function actualizarInformaciónUsuario($id, $nick, $nombre, $apellido, $email, $mysqli)
{
    if (!$sentencia = $mysqli->prepare("UPDATE usuarios SET nickname = ? , nombre = ? , apellido = ? , email = ?  WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("ssssi", $nick, $nombre, $apellido, $email, $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function cambiarPass($id, $pass, $mysqli)
{
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    if (!$sentencia = $mysqli->prepare("UPDATE usuarios SET pass = ? WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("si", $hash, $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function cambiarRol($id, $tipo, $mysqli){
    if (!$sentencia = $mysqli->prepare("UPDATE usuarios SET tipo = ? WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("ii", $tipo, $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function nuevoUsuario($nick,$nombre,$apellido,$email , $pass, $mysqli)
{
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    if (!$sentencia = $mysqli->prepare("INSERT INTO usuarios (nickname, nombre, apellido, email, pass, tipo)  VALUES (?,?,?,?,?,1)")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("sssss",$nick,$nombre,$apellido,$email, $hash)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function eliminarComentario($idComentario, $mysqli)
{
    if (!$sentencia = $mysqli->prepare("DELETE FROM comentario WHERE id =?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("i",$idComentario)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function actualizarComentario($id_comentario, $comentario, $mysqli)
{

    if (!$sentencia = $mysqli->prepare("UPDATE comentario SET comentario = ?  WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$sentencia->bind_param("si",$comentario,$id_comentario)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function getIdEvento($id_comentario,$mysqli){


    if (!$sentencia = $mysqli->prepare("SELECT id_evento FROM comentario WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("i", $id_comentario)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $id_evento = $row['id_evento'];
    }
    return $id_evento;
}

function modificarEvento($idEvento,$nombre,$organizador,$etiquetas,$fecha,$descripcion,$publicado,$mysqli)
{

    if (!$sentencia = $mysqli->prepare("UPDATE eventos SET nombre = ?, organizador = ?, etiquetas = ?, fecha = ?, descripcion = ?, publicado = ? WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$sentencia->bind_param("sssssii",$nombre,$organizador,$etiquetas,$fecha,$descripcion,$publicado,$idEvento)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function modificarEventoImg($idEvento,$nombre,$organizador,$etiquetas,$fecha,$descripcion,$imagenes,$publicado,$mysqli)
{

    if (!$sentencia = $mysqli->prepare("UPDATE eventos SET nombre = ?, organizador = ?, etiquetas = ?, fecha = ?, descripcion = ?, fotos = ?, publicado = ?  WHERE id = ?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$sentencia->bind_param("ssssssii",$nombre,$organizador,$etiquetas,$fecha,$descripcion,$imagenes,$publicado,$idEvento)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}
function nuevoEvento($nombre, $organizador, $etiquetas, $fecha, $descripcion, $imagenes,$publicado, $mysqli){

    if (!$sentencia = $mysqli->prepare("INSERT INTO eventos (nombre, organizador, etiquetas, fecha, descripcion, fotos,publicado)  VALUES (?,?,?,?,?,?,?)")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }


    if (!$sentencia->bind_param("sssssii",$nombre, $organizador, $etiquetas, $fecha, $descripcion, $imagenes,$publicado )) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }else{
        return $sentencia->insert_id;
    }
}
function eliminarEvento($id_evento, $mysqli){
    if (!$sentencia = $mysqli->prepare("DELETE FROM eventos WHERE id =?")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->bind_param("i",$id_evento)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function getCantidadAdmin($mysqli){
    if (!$sentencia = $mysqli->prepare("SELECT count(id) FROM usuarios WHERE tipo = 0")) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!($res = $sentencia->get_result())) {
        echo "Falló la obtención del conjunto de resultados: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $cantidad = $row['count(id)'];
    }
    return $cantidad;
}