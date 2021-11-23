<?php
session_start();
include("funciones.php");
$msg = "";
// usuario autenticado
if (!isset($_SESSION['idU'])) {
    header("location:" . $ruta . "portada.php");
}
// usuario autorizado
$c = conectarBD();
// $qry = "select Rol from usuarios where idUsuarios =" . $_SESSION["idU"];
// $rs = mysqli_query($c, $qry);
// $RolUsr = mysqli_fetch_array($rs);
// //si no es admi sacalo
// if ($RolUsr["Rol"] != "Administrador") {

//     header("location:" . $ruta . "portada.php");
// }
//si no esta proporcionado el titulo
if (isset($_POST['txtTitulo'])) {

    // verificar que se cargo el archivo en el server
    if (!empty($_FILES["archivo"]["tmp_name"])) {

        $nombre = $_FILES["archivo"]["name"];
        $tipo = $_FILES["archivo"]["type"];
        $nombre_temporal = $_FILES["archivo"]["tmp_name"];
        $tamanio = $_FILES["archivo"]["size"];
        $titulo = $_POST["txtTitulo"];
        // recupera el contenido del archivo
        $fp = fopen($nombre_temporal, "r");
        $contenido = fread($fp, $tamanio);
        fclose($fp);

        // transformar los caracteres especiales
        $contenido = addslashes($contenido);
        // insertar archivo a la bd
        $qry = "insert into documentos (Titulo, FechaCargado, idUsuario, Tipo, NombreOriginal, Contenido) values
         ('$titulo', '2021/11/16', " . $_SESSION['idU'] . ",'$tipo','$nombre','$contenido')";
        mysqli_query($c, $qry);
        header("location:" . $ruta . "portada.php");
    }
}

?>

<!-- Validacion por CLIENTE -->
<script type="text/javascript">
    function validaFRM() {
        if (document.getElementById("txtTitulo").value == "" ||
            document.getElementById("archivo").value == "") {
            alert("todos los datos deben de estar llenos");
            return false;
        } else {
            return true;
        }
    }
</script>

<body>

    <h2 class="tituloSistema">FORMULARIO DE CARGAR ARCHIVO</h2>

    <form method="post" enctype="multipart/form-data" action="cargarArchivo.php" onsubmit=" return validaFRM()">
        <?php
        if ($msg != "") {
            echo "<div id=\"txtMsg\"class=\"err\">$msg</div>";
        } else {
            echo  "<div id=\"txtMsg\"></div>";
        }
        ?>
        TITULO DEL ARCHIVO: <input type="text" id="txtTitulo" name="txtTitulo"> <br>
        Selecciona el archivo: <input type="file" name="archivo" id="archivo"> <br>
        <input type="submit" value="Cargar archivo">
        <input type="reset" value="Cancelar"> <br>
        <button><a href="portada.php">Regresar</a></button>
    </form>
</body>

</html>