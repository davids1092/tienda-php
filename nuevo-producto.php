<?php session_start();
    $mensaje .= 'Entre a contenido';
if(isset($_SESSION['usuario'])){
   
    // require 'views/contenido.view.php';
    if(isset($_SESSION['usuario'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "usuarios-final";
    
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        if (!$conn) {
            die('Error de conexión: ' . mysqli_connect_error());
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo '<p>entre al servicio</p>';
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $imagen = $_POST['imagen'];
            echo $nombre;
            echo $precio;
            echo $cantidad;
            echo $imagen;
    
            // Aquí debes validar y limpiar los datos antes de insertarlos en la base de datos
    
            $query = "INSERT INTO productos (nombre, precio, cantidad, imagen) VALUES ('$nombre', '$precio', '$cantidad', '$imagen')";
            if (mysqli_query($conn, $query)) {
                $mensaje = 'Producto agregado correctamente';
                echo $mensaje;
                header('Location: contenido.php');
               
                exit(); // Importante: asegúrate de salir del script después de la redirección
            } else {
                $mensaje = 'Error al agregar producto: ' . mysqli_error($conn);
            }

     
        }
    }



    

}

mysqli_close($conn);
?>