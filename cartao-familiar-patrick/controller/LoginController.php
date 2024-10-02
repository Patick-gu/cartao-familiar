<?php

class LoginController
{
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public function loginUser()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'emailOrCpf' => $_POST['emailOrCpf'] ?? null,
                'password' => $_POST['password'] ?? null
            ];

            $user = $this->userModel->findUserByEmailOrCpf($data['emailOrCpf']);

            if ($user && $data['password'] === $user['password']) {
                $sessionId = session_id();

                // Atualiza a data de login e o ID da sessão no banco de dados
                $this->userModel->updateLoginInfo($user['user_id'], $sessionId);

                // Inicia a sessão
                SessionValidator::startSession($user['user_id'], $user['name'], $user['email'], true);

                ResponseHelper::sendSuccess('Login bem-sucedido.');
            } else {
                ResponseHelper::sendError('Email/CPF ou senha incorretos.', ResponseHelper::HTTP_UNAUTHORIZED);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    public function logoutUser()
    {
        session_start();
        session_unset(); // Remove todas as variáveis de sessão
        session_destroy(); // Destrói a sessão
        header('Location: login'); // Redireciona para a página de login
    }

    public function indexLogin()
    {
        $pageTitle = 'Login | Cartão Familiar';
        $pageContent = 'view/content/login.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/login.view.php';
            return true;
        } else {
            return false;
        }
    }
    public function indexRegister()
    {
        $pageTitle = 'Cadastre-se | Cartão Familiar';
        $pageContent = 'view/content/register.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/login.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function indexForgotPassword()
    {
        $pageTitle = 'Esqueci minha senha | Cartão Familiar';
        $pageContent = 'view/content/forgot-password.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/login.view.php';
            return true;
        } else {
            return false;
        }
    }

    // Método para verificar a existência da view
    private function viewExists($viewPath)
    {
        return file_exists($viewPath);
    }
}
