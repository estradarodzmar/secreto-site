<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "registro_visitas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener datos del visitante
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Directo';

// Insertar datos en la base de datos
$sql = "INSERT INTO visitas (ip_address, user_agent, referer) VALUES ('$ip_address', '$user_agent', '$referer')";

if ($conn->query($sql) === TRUE) {
    echo "Visita registrada correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Visitas</title>
</head>
<body>
    <h1>Bienvenido a mi sitio web</h1>
    <p>Visita registrada. Gracias por tu visita.</p>

    <!-- Formulario para acceder a las visitas registradas -->
    <form action="ver_visitas.php" method="post">
        <label for="password">Introduce la clave para ver las visitas:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Ver Visitas</button>
    </form>
</body>
</html>
