<?php

namespace controllers;

use Firebase\JWT\JWT;
use models\User;


class AuthController
{
    private User $user;
    private string $secret_key;

    public function __construct()
    {
        $config = require '../config/http.php';
        $this->user = new User();
        $this->secret_key = $config['secret_key'];
    }

    public function getLoginView(): void
    {
        require_once '../views/login.php';
    }

    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $login = $input['username'];
        $password = $input['password'];

        $user = $this->user->getByLogin($login);
        if ($user && $this->user->verifyPassword($password, $user['password'])) {
            $_SESSION['role'] = $user['role'];
            echo $this->createToken($login);
        } else {
            http_response_code(401);
            return json_encode(['message' => 'Неверные учетные данные']);
        }
    }

    public function createToken($login): string
    {
        $payload = [
            'iss' => 'http://localhost',
            'aud' => 'http://localhost',
            'iat' => time(),
            'exp' => time() + (60 * 360),
            'sub' => $login
        ];

        $jwt = JWT::encode($payload, $this->secret_key, 'HS256');

        return json_encode(['token' => $jwt]);
    }
}