 <?php

 EliminarRegistro($_GET['USUARIO']);
 function EliminarRegistro($Usuario){
    include 'Conexion.php';
    $sentencia = "DELETE FROM `usuarios` WHERE `USUARIO` = '".$Usuario."'";

    $conectar->query($sentencia) or die ("Error al Eliminar".mysqli_error($conectar));

 }

 ?>

<script type="text/javascript">alert("Registro eliminado!!");

window.location.href='../Listadousuarios.php';
</script>