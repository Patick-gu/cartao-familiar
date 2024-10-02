<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public function index()
    {
        if (!SessionValidator::validate() || !SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $users = $this->userModel->getAllUsers();
        $pageTitle = 'Usuários | Cartão Familiar';
        $pageContent = 'view/content/users.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function indexForm($userId = null)
    {
        if (!SessionValidator::validate() || !SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $user = null;

        if ($userId !== null && is_numeric($userId)) {
            $user = $this->userModel->getUserById($userId);
        }

        $pageTitle = $user ? 'Editar Usuário | Cartão Familiar' : 'Novo Usuário | Cartão Familiar';
        $pageContent = 'view/content/users-form.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $email = DataValidator::validateEmail($_POST['email']);
                $cell_phone = DataValidator::validatePhone($_POST['cell_phone']);
                $password = $_POST['password'];

                if ($this->userModel->checkUserExistsByEmail($email)) {
                    ResponseHelper::sendError('E-mail já está em uso.', ResponseHelper::HTTP_CONFLICT);
                }

                if ($this->userModel->createUser($name, $email, $cell_phone, $password)) {
                    ResponseHelper::sendSuccess('Usuário criado com sucesso.', [], ResponseHelper::HTTP_CREATED);
                } else {
                    ResponseHelper::sendError('Erro ao criar usuário.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    public function edit($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $email = DataValidator::validateEmail($_POST['email']);
                $cell_phone = DataValidator::validatePhone($_POST['cell_phone']);

                if ($this->userModel->checkUserExistsByEmail($email, $userId)) {
                    ResponseHelper::sendError('E-mail já está em uso.', ResponseHelper::HTTP_CONFLICT);
                }

                if ($this->userModel->updateUser($userId, $name, $email, $cell_phone)) {
                    ResponseHelper::sendSuccess('Usuário atualizado com sucesso.');
                } else {
                    ResponseHelper::sendError('Erro ao atualizar usuário.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            $user = $this->userModel->getUserById($userId);
            include 'view/user/edit.view.php';
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userId = $_POST['id'];

                if (!is_numeric($userId) || !$this->userModel->getUserById($userId)) {
                    throw new ValidationException('ID de usuário inválido.');
                }

                if ($this->userModel->deleteUser($userId)) {
                    ResponseHelper::sendSuccess('Usuário excluído com sucesso.');
                } else {
                    ResponseHelper::sendError('Erro ao excluir usuário.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    private function viewExists($viewPath)
    {
        return file_exists($viewPath);
    }
}
