<?php

require_once __DIR__ . '/../model/Specialty.php';

class SpecialtyController
{
    private $specialtiesModel;

    public function __construct()
    {
        $database = new Database();
        $this->specialtiesModel = new SpecialtiesModel($database);
    }

    // Exibir todas as especialidades
    public function index()
    {
        if (!SessionValidator::validate() || !SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $specialties = $this->specialtiesModel->getAllSpecialties();
        $pageTitle = 'Especialidades | Sistema';
        $pageContent = 'view/content/specialties.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    // Exibir formulário para criar ou editar uma especialidade
    public function indexForm($specialtyId = null)
    {
        if (!SessionValidator::validate() || !SessionValidator::isAdmin()) {
            header('Location: login');
            exit;
        }

        $specialty = null;

        if ($specialtyId !== null && is_numeric($specialtyId)) {
            $specialty = $this->specialtiesModel->getSpecialtyById($specialtyId);
        }

        $pageTitle = $specialty ? 'Editar Especialidade' : 'Nova Especialidade';
        $pageContent = 'view/content/specialties-form.content.php';

        if ($this->viewExists($pageContent)) {
            include 'view/layout.view.php';
            return true;
        } else {
            return false;
        }
    }

    // Criar uma nova especialidade
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = DataValidator::sanitizeString($_POST['name']);
                $description = DataValidator::sanitizeString($_POST['description']);

                if ($this->specialtiesModel->createSpecialty($name, $description)) {
                    ResponseHelper::sendSuccess('Especialidade criada com sucesso.', [], ResponseHelper::HTTP_CREATED);
                } else {
                    ResponseHelper::sendError('Erro ao criar especialidade.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    // Editar uma especialidade existente
    public function edit($specialtyId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = DataValidator::sanitizeString($_POST['name']);
                $description = DataValidator::sanitizeString($_POST['description']);

                if ($this->specialtiesModel->updateSpecialty($specialtyId, $name, $description)) {
                    ResponseHelper::sendSuccess('Especialidade atualizada com sucesso.');
                } else {
                    ResponseHelper::sendError('Erro ao atualizar especialidade.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            $specialty = $this->specialtiesModel->getSpecialtyById($specialtyId);
            include 'view/specialty/edit.view.php';
        }
    }

    // Excluir uma especialidade
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $specialtyId = $_POST['id'];

                if (!is_numeric($specialtyId) || !$this->specialtiesModel->getSpecialtyById($specialtyId)) {
                    throw new ValidationException('ID de especialidade inválido.');
                }

                if ($this->specialtiesModel->deleteSpecialty($specialtyId)) {
                    ResponseHelper::sendSuccess('Especialidade excluída com sucesso.');
                } else {
                    ResponseHelper::sendError('Erro ao excluir especialidade.', ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (ValidationException $e) {
                ResponseHelper::sendError($e->getMessage(), ResponseHelper::HTTP_BAD_REQUEST);
            }
        } else {
            ResponseHelper::sendError('Método não permitido.', ResponseHelper::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    public function findByName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $name = $_GET['query'];
            return $this->specialtiesModel->findByName($name);
        }
    }

    // Verifica se a view existe
    private function viewExists($viewPath)
    {
        return file_exists($viewPath);
    }
}
