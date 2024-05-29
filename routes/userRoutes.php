<?php

require_once "../controllers/UserController.php";
require_once '../models/User.php';
require_once '../config/Database.php';

$database = new Database();
$db = $database->connect();

$userModel = new User($db);
$userController = new UserController($userModel);

$data = json_decode(file_get_contents("php://input"), true);
echo $userController->login($data);

?>
