<?php
session_start();

if(isset($_SESSION['usuario'])){
    $servername = "localhost";
    $username = "root";
    $password1 = "";
    $dbname = "usuarios-final";
    
    $conn = mysqli_connect($servername, $username, $password1, $dbname);
    
    if (!$conn) {
        die('Error de conexión: ' . mysqli_connect_error());
    } else {
        $statement = $conn->prepare('SELECT * FROM productos');
        $statement->execute();
        $resultado = $statement->get_result();
        
        if ($resultado->num_rows > 0) {
            $productosArray = array();

            while ($fila = $resultado->fetch_assoc()) {
                $productosArray[] = $fila;
            }
        }
    }

    $selectedProduct = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedProductIndex = $_POST['selected_product'];
        $selectedProduct = $productosArray[$selectedProductIndex];
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $imagen = $_POST['imagen'];
        $id = $selectedProduct['id']; // Supongo que tienes un campo 'id' en tu tabla
        
        $actualizarQuery = "UPDATE productos SET nombre=?, precio=?, cantidad=?, imagen=? WHERE id=?";
        $statement = $conn->prepare($actualizarQuery);
        $statement->bind_param("ssssi", $nombre, $precio, $cantidad, $imagen, $id);
        $statement->execute();
        
        // Redirigir a la página de detalles nuevamente o a donde desees
        header('Location: contenido.php');
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
        $id = $selectedProduct['id']; // Supongo que tienes un campo 'id' en tu tabla
        
        $eliminarQuery = "DELETE FROM productos WHERE id=?";
        $statement = $conn->prepare($eliminarQuery);
        $statement->bind_param("i", $id);
        $statement->execute();
        
        // Redirigir a la página de detalles nuevamente o a donde desees
        header('Location: contenido.php');
    }
    
} else {
    header('Location: registrate.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&display=swap" rel="stylesheet"> 

</head>
<body>
<?php if ($selectedProduct) : ?>
    <div class="container mt-5">
        <h2>PRODUCTO: <?php echo $selectedProduct['nombre']; ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $selectedProduct['imagen']; ?>" alt="" class="img-fluid img">
            </div>
            <div class="col-md-6">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $selectedProduct['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" class="form-control" name="precio" value="<?php echo $selectedProduct['precio']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="cantidad" value="<?php echo $selectedProduct['cantidad']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <input type="text" class="form-control" name="imagen" value="<?php echo $selectedProduct['imagen']; ?>">
                    </div>
                    <a href="contenido.php" class="btn btn-secondary mt-3">Volver</a>
                    <input type="hidden" name="selected_product" value="<?php echo $selectedProductIndex; ?>">
                    <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                    <button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar Producto</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
