<?php session_start();


if(isset($_SESSION['usuario'])){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    echo "$usuario . $password1 . $password2";


    $errores = '';


    if(empty($usuario) or empty($password1) or empty($password2)){
        $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
    }else{
        $password1 = hash('sha512', $password1);
        $password2 = hash('sha512', $password2);
    
            if($password1 != $password2){
                echo $password1 ,$password2;
                $errores .= '<li>Las contraseñas no son iguales</li>';
            }else{
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "usuarios-final";
                
                // Establecer la conexión a la base de datos
                $conn = mysqli_connect($host, $username, $password, $database);
                
                // Verificar si hay errores de conexión
                if (!$conn) {
                    die('Error de conexión: ' . mysqli_connect_error());
                }else{
                    // echo '<p>Conexion exitosa!!</p>';
                        // Obtener los valores del formulario
                    
                        $statement = $conn->prepare('SELECT * FROM usuarios WHERE username = ?');
                        $statement->bind_param('s', $usuario);
                        $statement->execute();
                        $resultado = $statement->get_result();
                
                        if($resultado->num_rows > 0){
                            // echo'<p>Usuario ya existe</p>';
                            $errores = '<li>El nombre de usuario ya existe</li>';
                        }else{
                                    // Insertar los datos en la base de datos
                                    $query = $conn->prepare('INSERT INTO usuarios (username, password) VALUES (?, ?)');
                                    $query->bind_param('ss', $usuario, $password1);
                                    $query->execute();
                                    
                                    if ($query->execute()) {
                                        echo '<p>Registro exitoso</p>';
                                        echo "El registro se guardó correctamente en la base de datos.";
                 
                                        // Redirigir a login.php después de guardar correctamente
                                        header("Location: login.php");
                                        exit();
                                    } else {
                                        echo '<p>Error al registrar usuario</p>';
                                        $errores = '<li>Algo salio mal, intenta registro nuevamente</li>';

                                    }
    


                          
                        }
            }




        // Insertar los datos en la base de datos
        // $query = "INSERT INTO usuarios (name, email, username, password) VALUES (?, ?, ?, ?)";
        // $stmt = mysqli_prepare($conn, $query);
        // mysqli_stmt_bind_param($stmt, "ssss", $nombre, $email, $usuario, $contrasena);
        // $result = mysqli_stmt_execute($stmt);

        // if ($result) {
        //     echo "El registro se guardó correctamente en la base de datos.";
 
        //     // Redirigir a login.php después de guardar correctamente
        //     header("Location: login.php");
        //     exit();
        // } else {
        //     echo "Error al guardar el registro: " . mysqli_error($conn);
        // }

        // // Cerrar la consulta preparada
        // mysqli_stmt_close($stmt);
    
}
    }

    //     $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
    //     $statement->execute(array(':usuario' => $usuario));
    //     $resultado = $statement->fetch();


    //     if($resultado != false){
    //         $errores .= '<li>El nombre de usuario ya existe</li>';
    //     }

    //     $password = hash('sha512', $password);
    //     $password2 = hash('sha512', $password2);

    //     if($password != $password2){
    //         $errores .= '<li>Las contraseñas no son iguales</li>';
    //     }
    // }
    
    // if($errores == ''){
    //     $statement = $conexion->prepare('INSERT INTO usuarios (id, usuario, pass) VALUES (null, :usuario, :pass)');
    //     $statement->execute(array(':usuario' => $usuario, ':pass' => $password));


    //     header('Location: login.php');
    // }

}




require 'views/registrate.view.php'

?>