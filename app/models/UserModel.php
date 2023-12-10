<?php

require_once 'Database.php';

class UserModel
{
    public function createUser($nom, $password, $email, $date_naissance, $num_tel, $adresse)
{
    $conn = Database::getInstance()->getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO client (nom, password, email, date_naissance, num_tel, adresse) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nom, $hashedPassword, $email, $date_naissance, $num_tel, $adresse]);

    return $stmt->rowCount();
}


    public function getUserByNameAndPassword($name, $password)
    {
        $conn = Database::getInstance()->getConnection();

        $query = "SELECT id, nom, password FROM client WHERE nom = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['password'])) {
            $storedPassword = $result['password'];

            if (password_verify($password, $storedPassword)) {
                return ['id' => $result['id'], 'nom' => $result['nom'], 'password' => $storedPassword];
            } else {
                echo "Debug: Password verification failed (inner condition)";
                return null;
            }
        } else {
            return null;
        }
    }



    public function deleteUserByName($name)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM client WHERE nom = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name]);

        return $stmt->rowCount();
    }   
    public function getUserEmail($userId)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT email FROM client WHERE id = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['email'] ?? null;
    } 
}
?>
