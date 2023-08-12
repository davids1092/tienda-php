<?php session_start();

if(isset($_SESSION['usuario'])){
    header("Location: index.php");
}

$errores = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
        $password = hash('sha512', $_POST['password']);



$servername = "localhost";
$username = "root";
$password1 = "";
$dbname = "usuarios-final";

$conn = mysqli_connect($servername, $username, $password1, $dbname);

// Verificar la conexión
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
} else {
    // echo '<p>Conexion exitosa</p>';
    $statement = $conn->prepare('SELECT * FROM usuarios WHERE username = ? AND password = ?');
$statement->bind_param('ss', $usuario, $password);
$statement->execute();
$resultado = $statement->get_result();

if ($resultado->num_rows > 0) {
    // Usuario encontrado
    $_SESSION['usuario'] = $usuario;
    header("location: contenido.php");
} else {
    // Usuario no encontrado
    echo '<p>Errorrr</p>';
    $errores = '<li>Datos incorrectos</li>';
}
}

    }
  



require 'views/login.view.php';


?>