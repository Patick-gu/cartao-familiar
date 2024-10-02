<?php

require_once 'Database.php';

class SpecialtiesModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // Método para criar uma nova especialidade
    public function createSpecialty($name, $description)
    {
        try {
            $conn = $this->db->connect();
            $sql = "INSERT INTO specialties (name, description) VALUES (:name, :description)";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':description' => $description
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para obter uma especialidade pelo ID
    public function getSpecialtyById($specialtyId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT specialty_id, name, description FROM specialties WHERE specialty_id = :specialty_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':specialty_id' => $specialtyId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para atualizar uma especialidade
    public function updateSpecialty($specialtyId, $name, $description)
    {
        try {
            $conn = $this->db->connect();
            $sql = "UPDATE specialties SET name = :name, description = :description WHERE specialty_id = :specialty_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':specialty_id' => $specialtyId,
                ':name' => $name,
                ':description' => $description
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para deletar uma especialidade
    public function deleteSpecialty($specialtyId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "DELETE FROM specialties WHERE specialty_id = :specialty_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([':specialty_id' => $specialtyId]);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para listar todas as especialidades
    public function getAllSpecialties()
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT specialty_id, name, description FROM specialties";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function findByName($name)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT * FROM specialties WHERE name LIKE :name;";
            $params = [
                ':name' => '%' . $name . '%',
            ];
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}
