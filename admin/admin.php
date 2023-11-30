<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../conexion/conexion.php';

    if (isset($_POST["add_category"])) {
        $nombre = $_POST["nombre"];

        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
    } elseif (isset($_POST["add_book"])) {
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $portada = $_FILES["portada"]["name"];
        $pdf = $_FILES["pdf"]["name"];
        $categoria_id = $_POST["categoria_id"];

        move_uploaded_file($_FILES["portada"]["tmp_name"], "../uploads/".$portada);
        move_uploaded_file($_FILES["pdf"]["tmp_name"], "../uploads/".$pdf);

        $sql = "INSERT INTO libros (titulo, descripcion, portada, pdf, categoria_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $titulo, $descripcion, $portada, $pdf, $categoria_id);
        $stmt->execute();
        
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administración de la biblioteca</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <h1>Administración de la biblioteca</h1>
    <a href="ver_perfil.php" class="button">Ver Perfil</a>
    <br><a href="logout.php" class="button">Cerrar Sesion</a>
    <h2>Agregar categoría</h2>
    <form action="admin.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <input type="submit" name="add_category" value="Agregar categoría">
    </form>

    <h2>Agregar libro</h2>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
        <br>
        <label for="portada">Portada:</label>
        <input type="file" name="portada" id="portada" required>
        <br>
        <label for="pdf">PDF:</label>
        <input type="file" name="pdf" id="pdf" required>
        <br>
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" id="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            <?php
            require '../conexion/conexion.php';

            $sql = "SELECT * FROM categorias";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"".$row["id"]."\">".$row["nombre"]."</option>";
                }
            }

            $conn->close();
            ?>
        </select>
        <br>
        <input type="submit" name="add_book" value="Agregar libro">
    </form>
</body>
</html>