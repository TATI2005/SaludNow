setInterval(() => {
    const ahora = new Date();
    document.getElementById("reloj").innerText = ahora.toLocaleTimeString("es-CO", {
        timeZone: "America/Bogota"
    });
}, 1000);
