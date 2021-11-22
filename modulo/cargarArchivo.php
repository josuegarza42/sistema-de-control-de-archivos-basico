<?php
session_start();
include("funciones.php");
$msg = "";
// usuario autenticado
if (!isset($_SESSION['idU'])) {
    header();
}
// usuario autorizado
$c = conectarBD();
$qry = "select Rol from usuarios where idUsuarios =" . $_SESSION["idU"];
$rs = mysqli_query($c, $qry);
$RolUsr = mysqli_fetch_array($rs);
//si no es admi sacalo
if($RolUsr["Rol"]!= "Administrador"){

    header();//sacalo
}
//si no esta proporcionado el titulo
if (!isset($_POST['txtTitulo'])) {
    header();
}
// verificar que se cargo el archivo en el server
if($_FILES["archivo"]){
    

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