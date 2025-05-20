<?php
require_once 'config/db.php';

class User {
    public static function create($name, $cpf, $email, $password, $profile) {
        global $pdo;
        $query = "INSERT INTO users (name, cpf, email, password, profile) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $cpf, $email, password_hash($password, PASSWORD_DEFAULT), $profile]);
        return $stmt->rowCount() > 0;
    }

    public static function getAll() {
        global $pdo;
        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
