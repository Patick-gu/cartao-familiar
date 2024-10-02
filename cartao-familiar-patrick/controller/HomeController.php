<?php

class HomeController
{
    public function index()
    {
        // Validação da sessão
        if (!SessionValidator::validate()) {
            header('Location: login');
            exit;
        }

        $pageTitle = 'Página Inicial | Cartão Familiar';
        $pageContent = 'view/content/home.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
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
