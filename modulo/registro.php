<?php
include("funciones.php");
// recuperar las banderas de registraUsuario.php
$msg = "";
if (isset($_GET['err']) && $_GET['err'] != "") {
    if ($_GET['err'] == "1") {
        $msg = "Se debe de utilizar el formulario de registro";
    } else if ($_GET['err'] == "2") {
        $msg = "Todos los datos son requeridos";
    } else if ($_GET['err'] == "3") {
        $msg = "Las contraseñas no coinciden";
    } else if ($_GET['err'] == "4") {
        $msg = "TODO CORRECTO";
    }
}
?>

<!-- Validacion por CLIENTE -->
<script type="text/javascript">
    function validaFRM() {
        if (document.getElementById("txtUsuario").value == "" ||
            document.getElementById("txtPwd").value == "" ||
            document.getElementById("txtRepwd").value == "" ||
            document.getElementById("txtEmail") == "") {

            alert("todos los datos deben de estar llenos");
            return false;
        } else if (document.getElementById("txtPwd").value != document.getElementById("txtRepwd").value) {
            document.getElementById("txtMsg").innerHTML = "Las contraseñas deben de ser iguales";
            document.getElementById("txtPwd").value == "";
            document.getElementById("txtRepwd").value == "";
            return false;
        } else {
            return true;
        }
    }
</script>

<body>

    <h2 class="tituloSistema">FORMULARIO DE REGISTRO</h2>

    <form method="get" action="registraUsuario.php" onsubmit=" return validaFRM()">
    
        <?php
        if ($msg != "") {
            echo "<div id=\"txtMsg\"class=\"err\">$msg</div>";
        } else {
            echo  "<div id=\"txtMsg\"></div>";
        }
        ?>

        Ingresa tu usuario: <input type="text" id="txtUsuario" name="txtUsuario"> <br>
        Escribe tu contraseña: <input type="password" id="txtPwd" name="txtPwd"><br>
        Reescribe la contraseña: <input type="password" id="txtRepwd" name="txtRepwd"><br>
        Anota tu email: <input type="email" name="txtEmail" id="txtEmail">
        <input type="submit" value="Registrame">
        <input type="reset" value="Cancelar"> <br>
        <button><a href="portada.php">Regresar</a></button> <button><a href="login.php">Autenticate</a></button>

    </form>
</body>

</html>