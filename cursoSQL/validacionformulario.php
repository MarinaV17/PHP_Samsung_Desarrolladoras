<?php
//Validación del formulario del lado del servidor
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

// Validación para que los campos no estén vacíos
if (empty($nombre) || empty($apellido) || empty($email)) {
  alert("Es necesario completar todos los campos.");
  return;
}

//Validación para que el nombre y apellido solo contengan letras
if (!(preg_match('/^[A-Za-zÀ-ȕ ñÑ]*$/', $nombre) && preg_match('/^[A-Za-zÀ-ȕ ñÑ]*$/', $apellido))) {
    alert("El nombre y el apellido solo pueden estar formados por letras.");
    return;
  }

// Validación del formato del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  alert("Por favor, ingresa un correo electrónico válido.");
  return;
}


if($_POST) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practicasql";

//Creamos la conexión a la BD con los campos necesarios
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
    alert("Ha ocurrido un error al conectarse a la base de datos");
}

//Query a ejecutar
$sqlInsertQuery = "INSERT INTO usuario (nombre, apellido, email) VALUES ('$nombre', '$apellido', '$email')";

//Intentamos ejecutar la query
if ($conn->query ($sqlInsertQuery) === TRUE) {
     alert("¡Te has registrado exitosamente!");
} else {
    alert("Ha ocurrido el siguiente error al registrarte: " . $sqlInsertQuery . "<br>" . $conn->error);
}

//Cerramos la conexión a la BD
$conn->close();

}

//Función para sacar un alert con PHP y devolver a index.html
function alert($msg) {
  echo "<script type='text/javascript'>alert('$msg');
  window.location.replace('http://localhost/cursoSQL/index.html');
  </script>";
}
?>