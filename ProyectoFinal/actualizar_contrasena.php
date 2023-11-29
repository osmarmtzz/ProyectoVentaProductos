<?php
session_start();

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "deportuaa";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["nuevaContrasena"])) {
    $email = $_POST["email"];
    $nuevaContrasena = $_POST["nuevaContrasena"];

    // Actualizar la contraseña en la base de datos
    $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    
    if ($stmt->execute()) {
        // Redirigir a login.php después de actualizar la contraseña
        header("Location: login.php");
        exit();
    } else {
        echo "Error al actualizar la contraseña. Inténtalo de nuevo.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Si se accede directamente a este archivo sin datos de formulario, redirigir a la página de inicio
    header("Location: index.php");
    exit();
}
?>
