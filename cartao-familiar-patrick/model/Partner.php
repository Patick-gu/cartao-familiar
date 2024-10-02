<?php

require_once 'Database.php';

class PartnerModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findPartnerByEmailOrCpf($emailOrCpf)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT partner_id, name, email, phone, AES_DECRYPT(password, :DB_ENCRYPT) AS password FROM partners WHERE email = :emailOrCpf LIMIT 1";
            $stmt = $conn->prepare($sql);
            $values = [
                ':emailOrCpf' => $emailOrCpf,
                ':DB_ENCRYPT' => $this->db->db_encrypt
            ];
            $stmt->execute($values);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateLoginInfo($partnerId, $sessionId)
    {
        try {
            $conn = $this->db->connect();
            $stmt = $conn->prepare("UPDATE partners SET dt_login = NOW(), session_id = :session_id WHERE partner_id = :partner_id");
            $stmt->execute([
                ':session_id' => $sessionId,
                ':partner_id' => $partnerId
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getPartnerById($partnerId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT partner_id, name, phone, email, type, cnpj, cpf, zip_code, address, number, neighborhood, city, state FROM partners WHERE partner_id = :partner_id";
            $stmt = $conn->prepare($sql);
            $values = [':partner_id' => $partnerId];
            $stmt->execute($values);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function createPartner($name, $email, $phone, $password, $type, $cnpj, $cpf, $zip_code, $address, $number, $neighborhood, $city, $state)
    {
        try {
            $conn = $this->db->connect();
            $sql = "INSERT INTO partners (name, email, phone, password, type, cnpj, cpf, zip_code, address, number, neighborhood, city, state) VALUES (:name, :email, :phone, AES_ENCRYPT(:password, :DB_ENCRYPT), :type, :cnpj, :cpf, :zip_code, :address, :number, :neighborhood, :city, :state)";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $password,
                ':DB_ENCRYPT' => $this->db->db_encrypt,
                ':type' => $type,
                ':cnpj' => $cnpj,
                ':cpf' => $cpf,
                ':zip_code' => $zip_code,
                ':address' => $address,
                ':number' => $number,
                ':neighborhood' => $neighborhood,
                ':city' => $city,
                ':state' => $state
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllPartners()
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT partner_id, name, phone, email FROM partners";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updatePartner($partnerId, $name, $email, $phone, $type, $cnpj, $cpf, $zip_code, $address, $number, $neighborhood, $city, $state)
    {
        try {
            $conn = $this->db->connect();
            $sql = "UPDATE partners SET name = :name, email = :email, phone = :phone, type = :type, cnpj = :cnpj, cpf = :cpf, zip_code = :zip_code, address = :address, number = :number, neighborhood = :neighborhood, city = :city, state = :state WHERE partner_id = :partner_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':partner_id' => $partnerId,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':type' => $type,
                ':cnpj' => $cnpj,
                ':cpf' => $cpf,
                ':zip_code' => $zip_code,
                ':address' => $address,
                ':number' => $number,
                ':neighborhood' => $neighborhood,
                ':city' => $city,
                ':state' => $state
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deletePartner($partnerId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "DELETE FROM partners WHERE partner_id = :partner_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([':partner_id' => $partnerId]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkPartnerExists($email, $cnpj = null, $cpf = null)
    {
        try {
            $conn = $this->db->connect();

            $sql = "SELECT partner_id FROM partners WHERE email = :email";
            
            $params = [':email' => $email];

            if ($cnpj) {
                $sql .= " OR cnpj = :cnpj";
                $params[':cnpj'] = $cnpj;
            }

            if ($cpf) {
                $sql .= " OR cpf = :cpf";
                $params[':cpf'] = $cpf;
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}
