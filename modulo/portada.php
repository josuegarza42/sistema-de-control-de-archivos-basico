<?php
session_start();
include("funciones.php");
// si esta autenticado
if (isset($_SESSION['idU'])) {
    echo "<h2 class='bienvenida'>BIENVENIDO " . $_SESSION['nombre'] . " </h2>";
    echo "<div class=\"opcionesMenu\"> <a href=\"cargarArchivo.php\">[cargar archivo]</a>  | <a href=\"cambiarPwd.php\">[cambiar contraseña]</a>  | <a href='logout.php'>[salir del sistema]</a> </div>";

    // listamos los archivos cargados por el usuario
    //recuperar todas las columnas de la tabla documentos
    // recuperar nombre usuarios y rol de usuarios
    // resperando llave foranea
    // si en roles general
    // solo se muestran los doc de usuario autentificado
    // si en roles es admi
    // todos los documentos

    // recuperamos el rol
    $rolUsr = rolDeUsuario($_SESSION["idU"]);

    if ($rolUsr == "Administrador") {
        $qry = "Select d.*, u.Usuario from usuarios as u inner join documentos as d on u.idUsuario=d.idUsuario";
    } else {
        $qry = "Select d.*, u.Usuario from usuarios as u inner join documentos as d on u.idUsuario=d.idUsuario Where d.idUsuario= " . $_SESSION["idU"];
    }
    // echo $qry;
    $c = conectarBD();
    $rs = mysqli_query($c, $qry);
    // resultado de la consulta
    if (mysqli_num_rows($rs) > 0) {
        // si hay documentos guardados

        echo "<table>";
        echo  "<tr>";
        echo  "<td>USUARIO</td>";
        echo  "<td>TITULO DEL ARCHIVO</td>";
        echo  "<td>FECHA</td>";
        echo  "<td>NOMBRE DEL ARCHIVO</td>";
        echo  "<td> Opciones </td>";
        echo  "</tr>";

        while ($datos = mysqli_fetch_array($rs)) {
            echo  "<tr>";
            echo  "<td> " . $datos["Usuario"] . " </td>";
            echo  "<td> " . $datos["Titulo"] . "</td>";
            echo  "<td>" . $datos["FechaCargado"] . "</td>";
            echo  "<td> " . $datos["NombreOriginal"] . " </td>";
            echo  "<td> <a href=\"eliminarArchivo.php?idA=" . $datos["idDocumento"] . "\">Eliminar</a>  </td>";
            echo  "</tr>";
        }
        echo  "</table>";
    } else {
        // no hay documentos guardados
        echo "ACTUALMENTE NO HAY DOCUMENTOS GUARDADOS";
    }
} else {
?>

    <body>
        <h1 class="tituloSistema"> Sistema de control de archivos</h1>

        <?php
        // espacion de autenticacion

        ?>
        <p>NECESITAS AUTENTICARTE</p>
        <form method="POST" action="login.php">
            Usuario: <input type="text" name="txtUsuario" id="txtUsuario"> <br>
            Contraseña: <input type="password" name="txtPwd" id="txtPwd"><br>
            <input type="submit" name="" id="" value="Autenticame">
            <input type="reset" name="" id="" value="cancelar"> <br>
            <a href="registro.php">Si no esta registrado da click aqui</a>
        </form>

    <?php
}

    ?>
    </body>

    </html>