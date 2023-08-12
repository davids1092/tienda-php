<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Contenido</title>
</head>
<body>
    <div class="contenedor">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Tienda</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     
       <a class="nav-item nav-link cerrar-sesion" href="cerrar.php">Cerrar Sesion</a>
    </div>
  </div>
</nav>
  <!-- Button trigger modal -->
  <div class="open-modal"></div>
       <div class="botonera">
       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
  Agregar producto
</button>
       </div>
        <?php
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
                $statement = $conn->prepare('SELECT * FROM productos');
                $statement->execute();
                $resultado = $statement->get_result();
                
                if ($resultado->num_rows > 0) {
                    // Productos encontrados
                  
                    $productosArray = array(); // Crear un array para almacenar los productos

                    while ($fila = $resultado->fetch_assoc()) {
                        $productosArray[] = $fila; // Agregar la fila al array de productos
                    }
                    echo '<h2 class="h2">PRODUCTOS</h2>';
                    echo '<div class="container-product">';
                    foreach ($productosArray as $index => $producto) {
                        echo '<div class="product">' .
                             '<img src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">' .
                             '<h3>' . $producto['nombre'] . '</h3>' .
                             '<p>Precio: $' . $producto['precio'] . '</p>' .
                             '<p>Cantidad: ' . $producto['cantidad'] . '</p>' .
                             '<form method="POST" action="detalle-producto.php">' .
                             '<input type="hidden" name="selected_product" value="' . $index . '">' .
                             '<button type="submit" name="show_detail" class="btn btn-warning">Detalle</button>' .
                             '</form>' .
                             '</div>';
                    }
                    echo '</div>';
                } else {
                    // No se encontraron productos
                    echo '<p>No se encontraron productos</p>';
                }
        }
       ?>

     



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="nuevo-producto.php" name="newProduct" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre del producto</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio del producto</label>
                        <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad del producto</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
                    </div>
                    <div class="form-group">
                        <label for="imagen">URL de la imagen</label>
                        <input type="text" class="form-control" name="imagen" id="imagen" placeholder="URL de la imagen">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="newProduct.submit()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>





</div>

    

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>