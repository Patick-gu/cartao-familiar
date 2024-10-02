<?php

require_once __DIR__ . '/../model/User.php';

class SessionValidator
{
    private $userModel;
    private static $isAdmin = false;

    public function __construct()
    {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public static function startSession($userId, $userName, $userEmail, $isAdmin)
    {

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $userName;
        $_SESSION['user_email'] = $userEmail;
        $_SESSION['admin'] = $isAdmin;
        $_SESSION['logged_in'] = true;

        self::$isAdmin = $isAdmin;
    }

    public static function validate()
    {
        $validator = new self();

        // Verifica se a sessão existe
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        // Obtém os dados do usuário
        $userId = $_SESSION['user_id'];
        $sessionId = session_id();
        $user = $validator->userModel->getUserById($userId);

        // Verifica se o usuário é administrador e se o session_id corresponde
        if ($user && $user['session_id'] === $sessionId) {
            self::$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];
            return true;
        } else {
            return false;
        }
    }

    public static function isAdmin()
    {
        return self::$isAdmin;
    }
}
