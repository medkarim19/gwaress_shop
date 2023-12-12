<?php

require_once 'Database.php';

class MarqueModel
{
    public function getAllMarques()
    {
        $query = "SELECT id_marque FROM marque";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $marques = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $marques;
    }

    public function getMarqueById($marqueId)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM marque WHERE id_marque = :marqueId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':marqueId', $marqueId);
        $stmt->execute();
        $marque = $stmt->fetch(PDO::FETCH_ASSOC);
        return $marque;
    }

    public function updateMarque($marqueId, $newMarqueName)
    {
        $conn = Database::getInstance()->getConnection();
        $conn->beginTransaction();

        try {
            $updateQuery = "UPDATE marque SET nom_marque = :newMarqueName WHERE id_marque = :marqueId";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindParam(':newMarqueName', $newMarqueName);
            $updateStmt->bindParam(':marqueId', $marqueId);
            $updateStmt->execute();

            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    public function createMarque($marqueName)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO marque (nom_marque) VALUES (:marqueName)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':marqueName', $marqueName);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteMarque($marqueId)
    {
        $conn = Database::getInstance()->getConnection();
        $conn->beginTransaction();

        try {
            $deleteProductsQuery = "DELETE FROM produit WHERE marque_id = :marqueId";
            $deleteProductsStmt = $conn->prepare($deleteProductsQuery);
            $deleteProductsStmt->bindParam(':marqueId', $marqueId);
            $deleteProductsStmt->execute();
            $deleteMarqueQuery = "DELETE FROM marque WHERE id_marque = :marqueId";
            $deleteMarqueStmt = $conn->prepare($deleteMarqueQuery);
            $deleteMarqueStmt->bindParam(':marqueId', $marqueId);
            $deleteMarqueStmt->execute();
            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
