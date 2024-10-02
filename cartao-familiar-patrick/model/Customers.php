<?php

require_once 'Database.php';

class CustomerModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findCustomerByEmailOrCpf($emailOrCpf)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT customer_id, name, email, phone, AES_DECRYPT(password, :DB_ENCRYPT) AS password FROM customers WHERE email = :emailOrCpf LIMIT 1";
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

    public function updateLoginInfo($customerId, $sessionId)
    {
        try {
            $conn = $this->db->connect();
            $stmt = $conn->prepare("UPDATE customers SET dt_login = NOW(), session_id = :session_id WHERE customer_id = :customer_id");
            $stmt->execute([
                ':session_id' => $sessionId,
                ':customer_id' => $customerId
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getCustomerById($customerId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT customer_id, name, phone, email, type, cpf, birth_date, zip_code, address, number, neighborhood, city, state, plan_id, instagram, facebook, tiktok FROM customers WHERE customer_id = :customer_id";
            $stmt = $conn->prepare($sql);
            $values = [':customerId' => $customerId];
            $stmt->execute($values);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function createCustomer($name, $email, $phone, $password, $cpf, $birth_date, $zip_code, $address, $number, $neighborhood, $city, $plan_id, $state, $instagram, $facebook, $tiktok)
    {
        try {
            $conn = $this->db->connect();
            $sql = "INSERT INTO customers (name, email, phone, password, cpf, birth_date, zip_code, address, number, neighborhood, city, state, plan_id, instagram, facebook, tiktok) VALUES (:name, :email, :phone, AES_ENCRYPT(:password, :DB_ENCRYPT), :cpf, :birth_date, :zip_code, :address, :number, :neighborhood, :city, :state, :plan_id, :instagram, :facebook, :tiktok)";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $password,
                ':DB_ENCRYPT' => $this->db->db_encrypt,
                ':cpf' => $cpf,
                ':birth_date' => $birth_date,
                ':zip_code' => $zip_code,
                ':address' => $address,
                ':number' => $number,
                ':neighborhood' => $neighborhood,
                ':city' => $city,
                ':state' => $state,
                ':plan_id' => $plan_id,
                ':instagram' => $instagram,
                ':facebook' => $facebook,
                ':tiktok' => $tiktok
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllCustomer()
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT customer_id, name, phone, email FROM customers";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateCustomer($customerId, $name, $email, $phone, $cpf, $birth_date, $zip_code, $address, $number, $neighborhood, $city, $state, $plan_id, $instagram, $facebook, $tiktok)
    {
        try {
            $conn = $this->db->connect();
            $sql = "UPDATE customers SET name = :name, email = :email, phone = :phone, cpf = :cpf, birth_date = :birth_date, zip_code = :zip_code, address = :address, number = :number, neighborhood = :neighborhood, city = :city, state = :state, plan_id = :plan_id, instagram = :instagram, facebook = :facebook, tiktok = :tiktok WHERE customer_id = :customer_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':customer_id' => $customerId,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':cpf' => $cpf,
                ':birth_date' => $birth_date,
                ':zip_code' => $zip_code,
                ':address' => $address,
                ':number' => $number,
                ':neighborhood' => $neighborhood,
                ':city' => $city,
                ':state' => $state,
                ':plan_id' => $plan_id,
                ':instagram' => $instagram,
                ':facebook' => $facebook,
                ':tiktok' => $tiktok
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteCustomer($customerId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "DELETE FROM customers WHERE customer_id = :customer_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([':customer_id' => $customerId]);
        } catch (Exception $e) {
            return false;
        }
    }
// checar se o if vai valer alguma coisa caso nao excluir
    public function checkCustomerExists($email = null, $cpf = null)
    {
        try {
            $conn = $this->db->connect();

            $sql = "SELECT customer_id FROM customers WHERE email = :email";

            $params = [':email' => $email];

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

