function addProducto() {
  var producto = document.getElementById("producto").value;

  var precio = document.getElementById("precio").value;

  sessionStorage.setItem(producto, precio); //ó sessionStorage[producto]=precio

  mostrarDatos(producto);
}

function mostrarDatos() {
  var datosDisponibles = document.getElementById("datosDisponibles");

  datosDisponibles.innerHTML = "";

  for (var i = 0; i < sessionStorage.length; i++) {
    var producto = sessionStorage.key(i);

    var precio = sessionStorage.getItem(producto);

    datosDisponibles.innerHTML +=
      "<div>" + producto + " - " + precio + "</div>";
  }
}

function limpiarVista() {
  var datosDisponibles = document.getElementById("datosDisponibles");

  datosDisponibles.innerHTML = "Limpiada vista. Los datos permanecen.";
}

function borrarTodo() {
  sessionStorage.clear();
  mostrarDatos();
}
