<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cursosql";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$email = $_POST["email"];
$login = $_POST["login"];
$clave = $_POST["clave"];

// Validación del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico ingresado no es válido. Por favor, intenta nuevamente.");
}

// Validación de la contraseña
if (strlen($clave) < 4 || strlen($clave) > 8) {
    die("La contraseña debe tener entre 4 y 8 caracteres. Por favor, intenta nuevamente.");
}

// Verificar si el correo electrónico ya está registrado
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("El correo electrónico ingresado ya está registrado. Por favor, utiliza otro correo electrónico.");
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, clave) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$clave')";

if ($conn->query($sql) === TRUE) {
    echo "Registro completado con éxito<br><br>";
    echo '<a href="consulta.php">Consultar usuarios registrados</a>';
    echo '<br/><br/>';
    echo '<a href="index.html">Volver al formulario</a>';
} else {
    echo "Error al registrar los datos: " . $conn->error;
}

$conn->close();
?>