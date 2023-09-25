<?php


include_once 'conexion.php';//llamada de un archivo externo


// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['Correo']) && isset($_POST['Contraseña'])) {
    $Correo = $_POST['Correo'];
    $Contraseña = $_POST['Contraseña'];

    // Consulta para verificar las credenciales en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE CORREO = '$Correo' AND password1 = '$Contraseña'";
    $resultado = mysqli_query($conectar, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        // Credenciales válidas, redirigir a index2.html
        header("Location: ../index2.php");
        exit(); // Finalizar el script para evitar que se ejecute el código de registro
    } else {
        // Credenciales incorrectas, mostrar un mensaje de error o redirigir a una página de error
        echo '<script>alert("Credenciales incorrectas") </script>';
        header("Location:../index3.php");
        exit(); // Finalizar el script para evitar que se ejecute el código de registro
    }
}

// El formulario de inicio de sesión no se envió, continuar con el registro de usuarios


$Nombres = $_REQUEST['Nombre'];//llamada a variables
$Apellidos = $_REQUEST['Apellido'];
$Usuarios = $_REQUEST['Usuario'];
$Correos = $_REQUEST['Correo'];
$Fnacimientos = $_REQUEST['Fnacimiento'];
$Codpostals = $_REQUEST['Codpostal'];
$Direcciones = $_REQUEST['Direccion'];
$Telefonos = $_REQUEST['Telefono'];
$Passwords1 = $_REQUEST['Password1'];
$Passwords2 = $_REQUEST['Password2'];
$ImagenPerfiles = $_REQUEST['ImagenPerfil'];



//validacion de tamaño de archivo


$imagen_perfil = $_FILES['ImagenPerfil'];

// Verificar si se ha cargado un archivo
if ($imagen_perfil['error'] == 0) {
    // Verificar el tamaño del archivo (5 megabytes)
    $max_size = 5 * 1024 * 1024; // 5MB en bytes
    if ($imagen_perfil['size'] <= $max_size) {
        // El archivo tiene un tamaño válido, puedes procesarlo aquí
    } else {
        // El archivo es demasiado grande, muestra un mensaje de error
        echo "La imagen de perfil debe ser menor o igual a 5MB.";
		mysqli_close($conectar);
    }
} else {
    // Ocurrió un error al cargar el archivo, muestra un mensaje de error
    echo "Ocurrió un error al cargar la imagen de perfil.";
	mysqli_close($conectar);
}







$insertar = "INSERT INTO `usuarios`(`NOMBRES`, `APELLIDOS`, `USUARIO`, `CORREO`, `FECHA`, `codigopostal`, `direccion`, `telefono`, `password1`, `password2`, `imagenperfil`) 
VALUES ('$Nombres','$Apellidos','$Usuarios','$Correos','$Fnacimientos','$Codpostals', '$Direcciones', '$Telefonos', '$Passwords1', '$Passwords2', '$ImagenPerfiles')";


$resultado = mysqli_query($conectar, $insertar);

if (!$resultado) {
	echo '<script>alert("Error al Registrar") </script>';
		header("Location:../index3.php");
}else{
	echo '<script>alert("Registro Exitoso") </script>';
	header("Location:../index3.php");

}

mysqli_close($conectar);

?>


