function mostrarComentarios() {
    seccion_comentarios = document.getElementById("seccion_comentarios");


    if (seccion_comentarios.style.display != 'block') {
        seccion_comentarios.style.display = 'block';
    }
    else {
        seccion_comentarios.style.display = 'none';
    }
}

function validarEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function aniadirComentario() {
    seccion_comentarios = document.getElementById("comentarios");
    nombre = document.getElementById("nombre").value;
    email = document.getElementById("email").value;
    comentario = document.getElementById("comentario").value;
    if (nombre != "" && email != "" && comentario != "") {
        if (!validarEmail(email))
            alert("Email incorrecto")
        else {
            var d = new Date();
            seccion_comentarios.innerHTML = seccion_comentarios.innerHTML + '<div class="comentario"><div><div class="nombre-comentario">' + nombre + '</div><div class="fecha-comentario">' + d.getDate() + '/' + d.getMonth() + '/' + d.getFullYear() + '</div></div><div class="texto-comentario">' + comentario + '</div></div>'
        }
    } else {
        alert("Hay campos sin rellenar. Por favor complete todos los campos.");
    }

}