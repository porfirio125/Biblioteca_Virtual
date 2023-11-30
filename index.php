<?php
session_start();

require 'conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña (usar password_verify si las contraseñas están almacenadas de manera segura)
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = $row["rol"];

            if ($row["rol"] == "admin") {
                header("Location: admin/admin.php"); // Redirigir al administrador
            } else {
                header("Location: user/index.php"); // Redirigir al usuario regular
            }
            exit();
        } else {
            $error_message = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        $error_message = "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
<div class="container">
    <h1>Iniciar sesión</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
        <form action="index.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Iniciar sesión">
        </form>

        <p>No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
