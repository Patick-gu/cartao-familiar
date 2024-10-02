<?php

require_once __DIR__ . '/../model/Partner.php';

class PartnerController
{
    private $partnerModel;

    public function __construct()
    {
        $database = new Database();
        $this->partnerModel = new PartnerModel($database);
    }

    public function index()
    {
        if (!SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $partners = $this->partnerModel->getAllPartners();
        $pageTitle = 'Parceiros | Cartão Familiar';
        $pageContent = 'view/content/partners.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function indexForm($partnerId = null)
    {
        if (!SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $partner = null;

        if ($partnerId !== null && is_numeric($partnerId)) {
            $partner = $this->partnerModel->getPartnerById($partnerId);
        }

        $pageTitle = $partner ? 'Editar Parceiro | Cartão Familiar' : 'Novo Parceiro | Cartão Familiar';
        $pageContent = 'view/content/partners-form.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    public function save($partnerId = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Receber e validar os dados do formulário
                $name = $_POST['name'];
                $email = DataValidator::validateEmail($_POST['email']);
                $phone = DataValidator::validatePhone($_POST['phone']);
                $password = $_POST['password'] ?? ''; // Somente usado na criação
                $type = $_POST['type'];
                $cnpj = !empty($_POST['cnpj']) ? DataValidator::validateCNPJ($_POST['cnpj']) : null;
                $cpf = !empty($_POST['cpf']) ? DataValidator::validateCPF($_POST['cpf']) : null;
                $zip_code = DataValidator::validateZipCode($_POST['zip_code']);
                $address = $_POST['address'];
                $number = $_POST['number'];
                $neighborhood = $_POST['neighborhood'];
                $city = $_POST['city'];
                $state = $_POST['state'];

                // Verificar se o e-mail, CNPJ ou CPF já estão em uso, excluindo o próprio parceiro em caso de edição
                $existingPartner = $this->partnerModel->checkPartnerExists($email, $cnpj, $cpf);

                if ($existingPartner && $existingPartner['partner_id'] != $partnerId) {
                    ResponseHelper::sendError('E-mail, CNPJ ou CPF já estão em uso.', ResponseHelper::HTTP_CONFLICT);
                    return;
                }

                // Se $partnerId for nulo, então estamos criando um novo parceiro
                if (is_null($partnerId)) {
                    // Criar novo parceiro
                    if ($this->partnerModel->createPartner($name, $email, $phone, $password, $type, $cnpj, $cpf, $zip_code, $address, $number, $neighborhood, $city, $state)) {
                        ResponseHelper::sendSuccess('Parceiro criado com sucesso.', [], ResponseHelper::HTTP_CREATED);
                    } else {
                        ResponseHelper::sendError('Erro ao criar parceiro.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    // Atualizar parceiro existente
                    if ($this->partnerModel->updatePartner($partnerId, $name, $email, $phone, $type, $cnpj, $cpf, $zip_code, $address, $number, $neighborhood, $city, $state)) {
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
                $partnerId = $_POST['id'];

                if (!is_numeric($partnerId) || !$this->partnerModel->getPartnerById($partnerId)) {
                    throw new ValidationException('ID de parceiro inválido.');
                }

                if ($this->partnerModel->deletePartner($partnerId)) {
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
