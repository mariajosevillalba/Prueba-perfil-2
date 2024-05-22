document.getElementById("registerForm").addEventListener("submit", function(event) {
    const nombre = document.getElementById("nombre").value;
    const email = document.getElementById("email").value;
    const contrasena = document.getElementById("contrasena").value;

    if (nombre === "" || email === "" || contrasena === "") {
        event.preventDefault();
        alert("Todos los campos son obligatorios.");
    }
});
