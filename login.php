<?php
require "DataBase.php";
$db = new DataBase();

// Verificar si los datos 'username' y 'password' están llegando correctamente
if (isset($_POST['username']) && isset($_POST['password'])) {
    // echo "Username recibido: ".$_POST['username']."<br>";
    // echo "Password recibido: ".$_POST['password']."<br>";
    
    // Intentar conectar a la base de datos y realizar la autenticación
    if ($db->dbConnect()) {
        // Realizar la autenticación
        if ($db->logIn("users", $_POST['username'], $_POST['password'])) {
            echo "Inicio de sesión exitoso";
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "Error: conexión a la base de datos";
    }
} else {
    echo "Todos los campos son requeridos";
}
?>
