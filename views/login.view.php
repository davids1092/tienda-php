<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Iniciar sesión</title>
</head>
<body class="body1">
    <div class="contenedor">
        <h1 class="titulo">
            Iniciar sesión
        </h1>
    
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="formulario" name="login" method="POST">
            <div class="form-group">
                <div class="container-icon">
                <i class="fa fa-user icono izquierda" aria-hidden="true"></i>
                <!-- <p>Usuario</p> -->
                </div>
               
                <input type="text" name="usuario" class="usuario" placeholder="Usuario">
            </div>


            <div class="form-group">
            <div class="container-icon">
            <i class="fa fa-lock icono izquierda" aria-hidden="true"></i>
                <!-- <p>Contraseña</p> -->
                </div>
            
                <input type="password" name="password" class="password" placeholder="Repetir contraseña">
             
                
            </div>
            <div class="botonera">
                <button onclick="login.submit()" class="btn-login">Ingresar</button>
                </div>

            
            
            <?php if(!empty($errores)):?>
                <div class="error">
                    <ul>
                        <?php echo $errores;?>
                    </ul>
                </div>
            <?php endif; ?>
    
        </form>

        <p class="texto-registrate">¿Aún no tienes una cuenta?</p>
        <p class="texto">
            <a href="registrate.php" class="texto-registrate-enlace">Registrate</a>
        </p>
    </div>
</body>
</html>