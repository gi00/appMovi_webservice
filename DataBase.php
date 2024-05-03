<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    // funticion cando est ahasheada la contrasena
    // function logIn($table, $username, $password)
    // {
    //     $username = $this->prepareData($username);
    //     $password = $this->prepareData($password);
    //     $this->sql = "select * from " . $table . " where username = '" . $username . "'";
    //     $result = mysqli_query($this->connect, $this->sql);
    //     $row = mysqli_fetch_assoc($result);
    //     if (mysqli_num_rows($result) != 0) {
    //         $dbusername = $row['username'];
    //         $dbpassword = $row['password'];
    //         if ($dbusername == $username && password_verify($password, $dbpassword)) {
    //             $login = true;
    //         } else $login = false;
    //     } else $login = false;

    //     return $login;
    // }


    function logIn($table, $username, $password)
{
    $username = $this->prepareData($username);
    $password = $this->prepareData($password);
    $this->sql = "select * from " . $table . " where username = '" . $username . "'";
    // echo $this->sql; // Esto es para depuración, muestra la consulta SQL
    $result = mysqli_query($this->connect, $this->sql);
    $numRows = mysqli_num_rows($result); // Obtener el número de filas
    // echo "Número de filas devueltas por la consulta: " . $numRows; // Imprimir el número de filas
    $row = mysqli_fetch_assoc($result); // Obtener la fila como un array asociativo
    if ($numRows != 0) {
        // Imprimir los datos de la fila
        // echo "Datos de la fila:<br>";
        // foreach ($row as $key => $value) {
        //     echo "$key: $value<br>";
        // }
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        if ($dbusername == $username && $dbpassword == $password) {
            // echo "Username correcto: $username<br>";
            // echo "Password verificado correctamente<br>";
            $login = true;
        } else {
            // if ($dbusername != $username) {
            //     echo "El username no coincide: DB: $dbusername, input: $username<br>";
            // }
            // if (!password_verify($password, $dbpassword)) {
            //     echo "La contraseña no coincide<br> DB: $dbpassword, input: $password<br>";
            // }
            $login = false;
        }
        
        echo $login;
    } else $login = false;

    return $login;
}

            


    function signUp($table, $fullname, $email, $username, $password)
    {
        $fullname = $this->prepareData($fullname);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (fullname, username, password, email) VALUES ('" . $fullname . "','" . $username . "','" . $password . "','" . $email . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

}

?>
