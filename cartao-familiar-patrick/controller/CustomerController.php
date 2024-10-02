<?php

require_once __DIR__ . '/../model/Customers.php';

class CustomerController
{
    private $CustomerModel;

    public function __construct()
    {
        $database = new Database();
        $this->CustomerModel = new CustomerModel($database);
    }

    public function index()
    {
        if (!SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $customers = $this->CustomerModel->getAllCustomer();
        $pageTitle = 'clientes | Cartão Familiar';
        $pageContent = 'view/content/customer.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function indexForm($customerId = null)
    {
        if (!SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $Customer = null;

        if ($customerId !== null && is_numeric($customerId)) {
            $Customer = $this->CustomerModel->getCustomerById($customerId);
        }

        $pageTitle = $Customer ? 'Editar cliente | Cartão Familiar' : 'Novo cliente | Cartão Familiar';
        $pageContent = 'view/content/customer-form.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function save($customerId = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Receber e validar os dados do formulário
                $name = $_POST['name'];
                $email = DataValidator::validateEmail($_POST['email']);
                $phone = DataValidator::validatePhone($_POST['phone']);
                $password = $_POST['password'] ?? ''; // Somente usado na criação
                $cpf = $_POST['cpf'] ? DataValidator::validateCPF($_POST['cpf']) : null;
                $birth_date = $_POST['birth_date'] ?? null;
                $zip_code = DataValidator::validateZipCode($_POST['zip_code']);
                $address = $_POST['address'];
                $number = $_POST['number'];
                $neighborhood = $_POST['neighborhood'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $plan_id = $_POST['plan_id'];
                $instagram = $_POST['instagram'];
                $facebook = $_POST['facebook'];
                $tiktok = $_POST['tiktok'];


                // Verificar se o e-mail, CNPJ ou CPF já estão em uso, excluindo o próprio parceiro em caso de edição
                $existingCustomer = $this->CustomerModel->checkCustomerExists($email, $cpf);

                if ($existingCustomer && $existingCustomer['customer_id'] != $customerId) {
                    ResponseHelper::sendError('E-mail, CNPJ ou CPF já estão em uso.', ResponseHelper::HTTP_CONFLICT);
                    return;
                }

                // Se $partnerId for nulo, então estamos criando um novo parceiro
                if (is_null($customerId)) {
                    // Criar novo parceiro
                    if ($this->CustomerModel->createCustomer($name, $email, $phone, $password, $cpf, $birth_date, $zip_code, $address, $number, $neighborhood, $city, $state, $plan_id, $instagram, $facebook, $tiktok)) {
                        ResponseHelper::sendSuccess('Parceiro criado com sucesso.', [], ResponseHelper::HTTP_CREATED);
                    } else {
                        ResponseHelper::sendError('Erro ao criar parceiro.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    // Atualizar parceiro existente
                    if ($this->CustomerModel->updateCustomer($customerId, $name, $email, $phone, $cpf, $birth_date, $zip_code, $address, $number, $neighborhood, $city, $state, $plan_id, $instagram, $facebook, $tiktok)) {
                        ResponseHelper::sendSuccess('Parceiro atualizado com sucesso.');
                    } else {
                        ResponseHelper::sendError('Erro ao atualizar parceiro.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $customerId = $_POST['id'];

                if (!is_numeric($customerId) || !$this->CustomerModel->getCustomerById($customerId)) {
                    throw new ValidationException('ID de cliente inválido.');
                }

                if ($this->CustomerModel->deleteCustomer($customerId)) {
                    ResponseHelper::sendSuccess('Parceiro excluído com sucesso.');
                } else {
                    ResponseHelper::sendError('Erro ao excluir parceiro.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
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