<?php
// Definir la contraseña correcta
$correct_password = "tu_clave_segura"; // Cambia esto por tu contraseña

// Verificar si el formulario fue enviado y si la contraseña es correcta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_password = $_POST['password'];

    if ($entered_password === $correct_password) {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "tu_usuario";
        $password = "tu_contraseña";
        $dbname = "registro_visitas";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        // Consulta para obtener las visitas
        $sql = "SELECT ip_address, user_agent, referer, visit_time FROM visitas ORDER BY visit_time DESC";
        $result = $conn->query($sql);
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Visitas Registradas</title>
        </head>
        <body>
            <h1>Visitas Registradas</h1>
            <table border="1">
                <tr>
                    <th>IP</th>
                    <th>Navegador</th>
                    <th>Referer</th>
                    <th>Hora de Visita</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['ip_address'] . "</td>
                                <td>" . $row['user_agent'] . "</td>
                                <td>" . $row['referer'] . "</td>
                                <td>" . $row['visit_time'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay visitas registradas</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        // Si la contraseña es incorrecta, mostrar un mensaje de error
        echo "Clave incorrecta. No tienes acceso a esta página.";
    }
} else {
    // Si no se ha enviado el formulario, redirigir al inicio
    header("Location: index.php");
    exit();
}
?>
