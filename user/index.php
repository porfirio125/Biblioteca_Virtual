<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}

require '../conexion/conexion.php';

// Realiza la consulta SQL
$result = $conn->query("SELECT * FROM libros");

// Verifica si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Biblioteca ATL</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Biblioteca Virtual Alfoso Torres Luna</h1>

    <div class="row">
        <div class="categoria">
            <h2 style="border: 1px solid #ccc; padding: 10px; border-radius: 8px; background-color: #f4f4f4;">Panel</h2>
            <div class="button-container">
                <br><a href="index.php" class="row" class="categoria">Todo</a><br><hr><br>
                <br><hr><a href="logout.php" class="button">Cerrar Sesión</a>
                <br><a href="ver_perfil.php" class="button">Ver Perfil</a>
            </div>
        </div>

        <div class="libro" id="books-container">
            <h2 style="border: 1px solid #ccc; padding: 10px; border-radius: 8px; background-color: #f4f4f4;">Libros</h2>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='libro-item'>";
                    echo "<h3>Título: {$row['titulo']}</h3>";
                    echo "<p>Descripción: {$row['descripcion']}</p>";
                    echo "<img src='../uploads/{$row['portada']}' alt='Portada'>";
                    echo "<a href='../uploads/{$row['pdf']}' target='_blank'>Ver PDF</a>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='libro_id' value='{$row['id']}'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No hay libros disponibles.";
            }
            ?>
        </div>
        </div>
    </div>

    <script>
    </script>

</body>
</html>

