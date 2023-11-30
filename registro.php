<?php
session_start();

require 'conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar si el usuario ya existe
    $check_user_sql = "SELECT * FROM usuarios WHERE username = ?";
    $check_user_stmt = $conn->prepare($check_user_sql);
    $check_user_stmt->bind_param("s", $username);
    $check_user_stmt->execute();
    $check_user_result = $check_user_stmt->get_result();

    if ($check_user_result->num_rows > 0) {
        $error_message = "El nombre de usuario ya está registrado. Por favor, elige otro.";
    } else {
        // El usuario no existe, proceder con el registro
        $insert_user_sql = "INSERT INTO usuarios (username, password, rol) VALUES (?, ?, 'usuario')";
        $insert_user_stmt = $conn->prepare($insert_user_sql);

        // Hash de la contraseña (se recomienda usar password_hash en un entorno de producción)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_user_stmt->bind_param("ss", $username, $hashed_password);

        if ($insert_user_stmt->execute()) {
            // Registro exitoso, mostrar mensaje en la misma página
            $success_message = "Usuario registrado exitosamente.";
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = 'usuario';
        } else {
            $error_message = "Error en el registro. Por favor, inténtalo de nuevo.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <div class="container">
        <h1>Registro</h1>

        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }

        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        }
        ?>

        <form action="registro.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Registrarse">
        </form>

        <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>

