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

// Consulta de usuarios registrados
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Lista de usuarios registrados</h1>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["apellido1"] . "</td><td>" . $row["apellido2"] . "</td><td>" . $row["email"] . "</td><td>" . $row["login"] . "</td></tr>";
    }

    echo "</table>";
    echo '<a href="index.html">Volver al formulario</a>';
} else {
    echo "No se encontraron usuarios registrados.";
}

$conn->close();
?>
