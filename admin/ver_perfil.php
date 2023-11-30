<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require '../conexion/conexion.php';

// Obtener información del usuario desde la sesión
$username = $_SESSION["username"];

// Consultar la base de datos para obtener más detalles del usuario
$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar la información del perfil
if ($result->num_rows > 0) {
    $profile_data = $result->fetch_assoc();
    echo "<h2>Perfil de Usuario/Administrador</h2>";
    echo "<p>ID: {$profile_data['id']}</p>";
    echo "<p>Nombre de usuario: {$profile_data['username']}</p>";
    echo "<p>Rol: {$profile_data['rol']}</p>";
    // Mostrar otros detalles del perfil según tu estructura de base de datos.
} else {
    echo "Perfil no encontrado.";
}

$conn->close();
?>

<style>
    h2, p {
        text-align: center;
    }
    p {
        margin: 10px 0;
    }
    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        text-decoration: none;
        color: #4caf50;
    }
    a:hover {
        color: #45a049;
    }
</style>

<br>
<a href="admin.php">Volver al Inicio</a>

