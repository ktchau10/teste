<?php
require_once 'models/userModel.php';
require_once 'config/db.php';
use \Firebase\JWT\JWT;

class UserController {
    public function login($email, $password) {
        global $pdo;
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $secretKey = "YOUR_SECRET_KEY";
            $issuedAt = time();
            $expirationTime = $issuedAt + 3600;  // jwt válido por 1 hora
            $payload = array(
                "iat" => $issuedAt,
                "exp" => $expirationTime,
                "userId" => $user['id'],
            );
            $jwt = JWT::encode($payload, $secretKey);
            return json_encode(['token' => $jwt]);
        } else {
            return json_encode(['message' => 'Credenciais inválidas']);
        }
    }

    public function createUser($name, $cpf, $email, $password, $profile) {
        $success = User::create($name, $cpf, $email, $password, $profile);
        return $success ? json_encode(['message' => 'Usuário criado com sucesso']) : json_encode(['message' => 'Erro ao criar usuário']);
    }
}
?>
