document.getElementById('formularioReserva').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const pelicula = document.getElementById('pelicula').value;
    const horario = document.getElementById('horario').value;
    const cantidad = document.getElementById('cantidad').value;

    alert(`Reserva exitosa para ${nombre}.
Película: ${pelicula}
Horario: ${horario}
Cantidad de entradas: ${cantidad}`);

    // Opcionalmente aquí podrías enviar la información a un servidor o almacenarla.
});
// Toggle dropdown menu visibility
document.getElementById('cityToggle').addEventListener('click', function() {
    const cityList = document.getElementById('cityList');
    cityList.classList.toggle('show'); // Toggle the "show" class
});








