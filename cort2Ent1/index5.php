



<?php

include("php/conexion.php"); // Asegúrate de que el nombre del archivo coincida con tu archivo de conexión
$nombre_usuario = $_GET['USUARIO'];

// Consulta SQL para obtener los datos del usuario específico
$consulta = "SELECT * FROM usuarios WHERE USUARIO = '$nombre_usuario'";
$resultado = mysqli_query($conectar, $consulta);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Recuperar los datos del usuario
    $datos_usuario = mysqli_fetch_assoc($resultado);
    // ...
    // Aquí puedes mostrar un formulario prellenado con los datos del usuario para su edición
    // ...
} else {
    // Si el usuario no se encuentra, mostrar un mensaje de error o redirigir a una página de error
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Register</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/style.css">
	<style>
        /* Estilos para el formulario */
        .formulario__register {
            margin-top: 550px; /* Ajustar el margen superior según sea necesario */
        }
    </style>
</head>
<body>

        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>Estamos modificando este Usuario :</h3><br><br>
						<h3><?php echo $datos_usuario['USUARIO']; ?></h3>
                        <p>Por favor completa los datos</p>

						

                        <button  style="display: none;" id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div  style="display: none;" class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button style="display: none;" id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register" action="php/modificar.php" method="post">
                    <!--Login-->
					<form action="php/modificar.php" method="post" class="formulario__login">
        <h2>Iniciar Sesión</h2>
        <input type="text" placeholder="Correo Electrónico" name="Correo">
        <input type="password" placeholder="Contraseña" name="Contraseña">
        <button type="submit">Entrar</button>
    </form>

                    <!--Register-->
					<form class="styled-form formulario__register form-expanded" action="php/modificar.php" method="post">
						

                    <h2>Modificar Usuario</h2>

                    
    <input style="display: none;" class="controls" type="text" name="Usuario" placeholder="Ingrese Usuario" value="<?php echo $datos_usuario['USUARIO']; ?>" required><br><br>


					<input class="controls" type="text" name="Nombre" placeholder="Ingrese Nombres" value="<?php echo $datos_usuario['NOMBRES']; ?>" required><br><br>


					
					<input class="controls" type="text" name="Apellido" placeholder="Ingrese Apellidos" value="<?php echo $datos_usuario['APELLIDOS']; ?>" required><br><br>

					
					<input class="controls" type="text" name="Correo" placeholder="Ingrese Correo" value="<?php echo $datos_usuario['CORREO']; ?>" required> <br><br>

					
    				<input class="controls" type="date" name="Fnacimiento" placeholder="Ingrese Fecha Nacimiento" title="Seleccione su fecha de nacimiento" value="<?php echo $datos_usuario['FECHA']; ?>" required><br><br>
					
					


					<input class="controls" type="text" name="Codpostal" placeholder="Ingrese Codigo Postal" value="<?php echo $datos_usuario['codigopostal']; ?>" required><br><br>

					<input class="controls" type="text" name="Direccion" placeholder="Ingrese Direccion" value="<?php echo $datos_usuario['direccion']; ?>" required><br><br>

					<input class="controls" type="text" name="Telefono" placeholder="Ingrese Teléfono" value="<?php echo $datos_usuario['telefono']; ?>" required><br><br>
					

					<fieldset class="password-fieldset">
    				<legend>Contraseña</legend>
					<input class="controls" type="password" name="Password1" id="password1" placeholder="Digite Password" value="<?php echo $datos_usuario['password1']; ?>" required><br><br>
					<input class="controls" type="password" name="Password2" id="password2" placeholder="Confirme Password" value="<?php echo $datos_usuario['password1']; ?>" required>
					<button type="button" id="togglePassword">Mostrar Contraseña</button>
					</fieldset>

					<input class="controls" type="file" name="ImagenPerfil" accept="image/*" required>
       	 			<span class="tooltip-text">Seleccione una imagen de perfil</span>
  
						<div>
					<!--<button>Regístrarse</button>-->
					<input class="botons custom-button" type="submit" value="Actualizar">
					</div>

				</div>

                    </form>
                </div>
            </div>

        </main>

        <script src="js/script.js"></script>
				
		<script>
  window.addEventListener('DOMContentLoaded', function () {
    register(); // Llama a la función "register" cuando se carga la página

	const passwordField1 = document.getElementById("password1");
const passwordField2 = document.getElementById("password2");
const togglePasswordButton = document.getElementById("togglePassword");

let passwordVisible = false; // Variable para rastrear el estado de visibilidad

togglePasswordButton.addEventListener("click", function () {
  if (passwordVisible) {
    // Si las contraseñas son visibles, ocultarlas
    passwordField1.type = "password";
    passwordField2.type = "password";
    passwordVisible = false;
    togglePasswordButton.textContent = "Mostrar";
  } else {
    // Si las contraseñas están ocultas, mostrarlas
    passwordField1.type = "text";
    passwordField2.type = "text";
    passwordVisible = true;
    togglePasswordButton.textContent = "Ocultar";
  }
});



  });
</script>
    </script>
</body>
</html>


























<!--<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">

	<title>Formulario de Registro</title>
</head>
<body class="pagina2">
	<header>   
		<section class="form-register">
			<center> 
				<h4>Formulario de Registro</h4>
				<form class="styled-form" action="php/registros.php" method="post">
				
					<input class="controls" type="text" name="Nombre" placeholder="Ingrese Nombres" required><br><br>
					<input class="controls" type="text" name="Apellido" placeholder="Ingrese Apellidos" required><br><br>
					<input class="controls"type="text" name="Usuario" placeholder="Ingrese Usuario" required><br><br>
					<input class="controls"type="text" name="Correo" placeholder="Ingrese Correo" required> <br><br>

					<div class="input-container">
					<input class="controls"type="date" name="Fnacimiento" placeholder="Ingrese Fecha Nacimiento" required><br><br>
					<span class="tooltip-text">Fecha De Nacimiento</span>
					</div>

					<input class="controls"type="text" name="Codpostal" placeholder="Ingrese Codigo Postal" required><br><br>
					<input class="controls"type="text" name="Direccion" placeholder="Ingrese Direccion" required><br><br>
					<input class="controls"type="text" name="Telefono" placeholder="Ingrese Teléfono" required><br><br>
					</div>
					<p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
					<input class="botons" type="submit" value="Registrar"> 
					<p><a href="#">¿Ya tengo Cuenta?</a></p>
				</form>
			</center>
		</section>
	
</body>
</html>-->


