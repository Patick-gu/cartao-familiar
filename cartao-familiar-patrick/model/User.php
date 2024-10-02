<?php

require_once 'Database.php';

class UserModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findUserByEmailOrCpf($emailOrCpf)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT user_id, name, email, cell_phone, AES_DECRYPT(password, :DB_ENCRYPT) AS password FROM users WHERE email = :emailOrCpf LIMIT 1";
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

    public function updateLoginInfo($userId, $sessionId)
    {
        try {
            $conn = $this->db->connect();
            $stmt = $conn->prepare("UPDATE users SET dt_login = NOW(), session_id = :session_id WHERE user_id = :user_id");
            $stmt->execute([
                ':session_id' => $sessionId,
                ':user_id' => $userId
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getUserById($userId)
    {
        try {
            $conn = $this->db->connect();
            $stmt = $conn->prepare("SELECT user_id, name, cell_phone, email, session_id FROM users WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function createUser($name, $email, $cell_phone, $password)
    {
        try {
            $conn = $this->db->connect();
            $sql = "INSERT INTO users (name, email, cell_phone, password) VALUES (:name, :email, :cell_phone, AES_ENCRYPT(:password, :DB_ENCRYPT))";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':cell_phone' => $cell_phone,
                ':password' => $password,
                ':DB_ENCRYPT' => $this->db->db_encrypt
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllUsers()
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT user_id, name, cell_phone, email, dt_login FROM users";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateUser($userId, $name, $email, $cell_phone)
    {
        try {
            $conn = $this->db->connect();
            $sql = "UPDATE users SET name = :name, email = :email, cell_phone = :cell_phone WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':user_id' => $userId,
                ':name' => $name,
                ':email' => $email,
                ':cell_phone' => $cell_phone
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteUser($userId)
    {
        try {
            $conn = $this->db->connect();
            $sql = "DELETE FROM users WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([':user_id' => $userId]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkUserExistsByEmail($email, $excludeUserId = null)
    {
        try {
            $conn = $this->db->connect();
            $sql = "SELECT user_id FROM users WHERE email = :email";
            if ($excludeUserId) {
                $sql .= " AND user_id != :excludeUserId";
            }
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($excludeUserId) {
                $stmt->bindParam(':excludeUserId', $excludeUserId, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (Exception $e) {
            return false;
        }
    }
}
