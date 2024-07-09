const elementos = {
    cloud: document.getElementById("cloud"),
    barraLateral: document.querySelector(".barra-lateral"),
    spans: document.querySelectorAll("span"),
    palanca: document.querySelector(".switch"),
    circulo: document.querySelector(".circulo"),
    menu: document.querySelector(".menu"),
    main: document.querySelector("main"),
};

const actualizarEstado = () => {
    document.body.classList.toggle("dark-mode", localStorage.getItem("darkMode") === "true");
    elementos.circulo.classList.toggle("prendido", localStorage.getItem("darkMode") === "true");
    elementos.barraLateral.classList.toggle("mini-barra-lateral", localStorage.getItem("miniBarraLateral") === "true");
    elementos.main.classList.toggle("min-main", localStorage.getItem("miniBarraLateral") === "true");
    elementos.spans.forEach(span => span.classList.toggle("oculto", localStorage.getItem("miniBarraLateral") === "true"));
};

elementos.menu.addEventListener("click", () => {
    elementos.barraLateral.classList.toggle("max-barra-lateral");
    localStorage.setItem("maxBarraLateral", elementos.barraLateral.classList.contains("max-barra-lateral"));
    actualizarEstado(); // Refresca el estado en cambio
});

elementos.palanca.addEventListener("click", () => {
    localStorage.setItem("darkMode", !(localStorage.getItem("darkMode") === "true"));
    actualizarEstado();
});

elementos.cloud.addEventListener("click", () => {
    localStorage.setItem("miniBarraLateral", !(localStorage.getItem("miniBarraLateral") === "true"));
    actualizarEstado();
});

// Al cargar la página, establece el estado según lo guardado
document.addEventListener("DOMContentLoaded", actualizarEstado);
