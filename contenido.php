<?php session_start();
    // $mensaje .= 'Entre a contenido';
if(isset($_SESSION['usuario'])){
    require 'views/contenido.view.php';    

}else{
    header('Location: registrate.php');
}

mysqli_close($conn);
?>