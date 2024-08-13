<?php

namespace middleware;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

session_start();

class AuthMiddleware {

    private string $secret_key;

    public function __construct($secret_key) {
        $this->secret_key = $secret_key;
    }

    public function handle($token): bool
    {
        if ($this->isValidToken($token)) {
            $_SESSION['token'] = $token;
            return true;
        } else {
            http_response_code(401);
            return false;
        }
    }

    private function isValidToken($token): bool
    {
        try {
            JWT::decode($token, new Key($this->secret_key, 'HS256'));
            return true;
        } catch (Exception $e) {
            http_response_code(401);
            return false;
        }
    }

    public function hasRoles(array $required_roles): bool
    {
        if (!isset($_SESSION['token'])) {
            header('Location: /login');
            exit();
        }
        if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $required_roles)) {
            header('HTTP/1.1 403 Forbidden');
            echo "У вас нет доступа к этой странице.";
            echo '<br><a href="/dashboard">Вернуться на главную страницу</a>';
            exit();
        } else {
            return true;
        }
    }
}