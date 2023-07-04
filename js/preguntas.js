function verificarRespuesta(elemento, respuestaSeleccionada, preguntaId) {
    // Obtener todas las opciones
    var opciones = document.getElementsByClassName("opcion");

    // Quitar la clase seleccionada a todas las opciones
    for (var i = 0; i < opciones.length; i++) {
        opciones[i].classList.remove("seleccionada");
    }

    // Agregar la clase seleccionada a la opción clicada
    elemento.classList.add("seleccionada");

    // Enviar la respuesta seleccionada al servidor
    var formulario = document.createElement("form");
    formulario.method = "post";
    formulario.action = "";

    var preguntaIdInput = document.createElement("input");
    preguntaIdInput.type = "hidden";
    preguntaIdInput.name = "pregunta_id";
    preguntaIdInput.value = preguntaId;
    formulario.appendChild(preguntaIdInput);

    var respuestaSeleccionadaInput = document.createElement("input");
    respuestaSeleccionadaInput.type = "hidden";
    respuestaSeleccionadaInput.name = "respuesta_seleccionada";
    respuestaSeleccionadaInput.value = respuestaSeleccionada;
    formulario.appendChild(respuestaSeleccionadaInput);

    document.body.appendChild(formulario);
    formulario.submit();
}
function animatePoints() {
    var puntosAnimation = document.querySelector('.puntos-animation');
    puntosAnimation.classList.add('active');
    setTimeout(function() {
        puntosAnimation.classList.remove('active');
    }, 2000);
}

// Obtener el formulario y las alternativas
var alternativasForm = document.getElementById('alternativas-form');
var alternativas = alternativasForm.elements.respuesta_seleccionada;

// Agregar el evento de cambio a cada alternativa
for (var i = 0; i < alternativas.length; i++) {
    alternativas[i].addEventListener('change', function() {
        alternativasForm.submit();
    });
}
