<?php
include_once 'conexion.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió el formulario de inicio de sesión
    if (isset($_POST['Correo']) && isset($_POST['Contraseña'])) {
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];

        // Consulta SQL para verificar las credenciales en la base de datos
        $consulta = "SELECT * FROM usuarios WHERE CORREO = '$Correo' AND password1 = '$Contraseña'";
        $resultado = mysqli_query($conectar, $consulta);

        if (mysqli_num_rows($resultado) > 0) {
            // Credenciales válidas, redirigir a index2.php
            header("Location: ../index2.php");
            exit();
        } else {
            // Credenciales incorrectas, mostrar un mensaje de error o redirigir a una página de error
            echo '<script>alert("Credenciales incorrectas") </script>';
            header("Location:../index3.php");
            exit();
        }
    } else {
        // El formulario de inicio de sesión no se envió, continuar con el registro de usuarios

        // Recupera los datos del formulario
        $Nombres = $_POST['Nombre'];
        $Apellidos = $_POST['Apellido'];
        $Usuarios = $_POST['Usuario'];
        $Correos = $_POST['Correo'];
        $Fnacimientos = $_POST['Fnacimiento'];
        $Codpostals = $_POST['Codpostal'];
        $Direcciones = $_POST['Direccion'];
        $Telefonos = $_POST['Telefono'];
        $Passwords1 = $_POST['Password1'];
        $Passwords2 = $_POST['Password2'];
        $ImagenPerfiles = $_POST['ImagenPerfil'];

        // Consulta SQL para actualizar los datos del usuario
        $modificar = "UPDATE `usuarios` SET 
            `NOMBRES` = '$Nombres',
            `APELLIDOS` = '$Apellidos',
            `CORREO` = '$Correos',
            `FECHA` = '$Fnacimientos',
            `codigopostal` = '$Codpostals',
            `direccion` = '$Direcciones',
            `telefono` = '$Telefonos',
            `password1` = '$Passwords1',
            `password2` = '$Passwords2',
            `imagenperfil` = '$ImagenPerfiles'
        WHERE `USUARIO` = '$Usuarios'";

        // Ejecuta la consulta de actualización
        $resultado = mysqli_query($conectar, $modificar);

        if (!$resultado) {
            echo '<script>alert("Error al Modificar") </script>';
            header("Location:../lListadousuarios.php");
        } else {
            echo '<script>alert("Modificación Exitosa") </script>';
            header("Location:../Listadousuarios.php");
        }
    }
} else {
    // Si se intenta acceder a este script sin enviar datos a través de POST, redirige a una página de error
    header("Location:../error.php");
}

mysqli_close($conectar);
?>
