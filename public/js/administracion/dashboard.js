
function actualizarReloj() {
    const ahora = new Date();
    const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    let fechaTexto = ahora.toLocaleDateString('es-ES', opcionesFecha);
    const opcionesHora = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
    let horaTexto = ahora.toLocaleTimeString('es-ES', opcionesHora);

    document.getElementById('fechaActual').innerText = fechaTexto;
    document.getElementById('horaActual').innerText = horaTexto;
}
actualizarReloj();
setInterval(actualizarReloj, 1000);

