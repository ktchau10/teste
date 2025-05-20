<?php
header("Content-Type: application/json");
require_once 'config/db.php';
require_once 'controllers/userController.php';

// Rota de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/login') {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller = new UserController();
    echo $controller->login($data['email'], $data['password']);
}

// Rota para criar usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/users') {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller = new UserController();
    echo $controller->createUser($data['name'], $data['cpf'], $data['email'], $data['password'], $data['profile']);
}
?>
