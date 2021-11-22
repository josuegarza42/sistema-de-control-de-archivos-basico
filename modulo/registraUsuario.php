<?php
// si los datos no han sido pasados
if (
    !isset($_GET['txtUsuario']) ||
    !isset($_GET['txtPwd']) ||
    !isset($_GET['txtRepwd']) ||
    !isset($_GET['txtEmail'])
) {
    header("location:http://localhost/modulo/registro.php?err=1");
}
// si los datos estan vacios
if (($_GET['txtUsuario'] == "" || $_GET['txtPwd'] == "" || $_GET['txtRepwd'] == "" || $_GET['txtEmail'] == "")) {
    header("location:http://localhost/modulo/registro.php?err=2");
}
// si las contraseñas no son iguales
if ($_GET['txtPwd'] != $_GET['txtRepwd']) {
    header("location:http://localhost/modulo/registro.php?err=3");
}

// $usuario =$_GET['txtUsuario'];
// $pwd=$_GET['txtPwd'];
// $email =$_GET['txtEmail'];

// extraer todos los GET CON EXTRACT 
extract($_GET);

// CONEXION CON LA base de datos

$conn = mysqli_connect("localhost", "root", "", "deswebdocumentos");

// crear la consulta sql
$consulta = "insert into usuarios (Usuario, Pwd, Rol, Email) Value 
('$txtUsuario','$txtPwd','General','$txtEmail')";
// ejecuta una consulta en la BD
$rs = mysqli_query($conn, $consulta);

// redireccionar a registro con el mensaje de que todo funciono

header("location:http://localhost/modulo/registro.php?err=4");


?>