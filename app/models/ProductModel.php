<?php

require_once 'Database.php';

class ProductModel
{
    public function getProductsForHomme()
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit INNER JOIN marque ON produit.marque_id = marque.id_marque WHERE produit.sexe_produit='Homme'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    public function getProductsForFemme()
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit INNER JOIN marque ON produit.marque_id = marque.id_marque WHERE produit.sexe_produit='Femme'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function deleteProductById($productId)
    {
        $conn = Database::getInstance()->getConnection();
        $conn->beginTransaction();

        try {
            $panierQuery = "DELETE FROM panier WHERE produit_id = :productId";
            $panierStmt = $conn->prepare($panierQuery);
            $panierStmt->bindParam(':productId', $productId);
            $panierStmt->execute();
            $produitQuery = "DELETE FROM produit WHERE id_produit = :productId";
            $produitStmt = $conn->prepare($produitQuery);
            $produitStmt->bindParam(':productId', $productId);
            $produitStmt->execute();
            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    public function createProduct($marque_id, $nom, $prix, $quantite, $sexe_produit, $path)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO produit (marque_id, nom, prix, quantite, sexe_produit, path) VALUES (:marqueId, :nom, :prix, :quantite, :sexe_produit, :path)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':marqueId', $marque_id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':sexe_produit', $sexe_produit);
        $stmt->bindParam(':path', $path);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public function updateProduct($productId, $marque_id, $nom, $prix, $quantite, $sexe_produit, $path)
    {
        $conn = Database::getInstance()->getConnection();
        $conn->beginTransaction();
        try {
            $updateQuery = "UPDATE produit 
                            SET marque_id = :marqueId, nom = :nom, prix = :prix, quantite = :quantite, sexe_produit = :sexe_produit, path = :path
                            WHERE id_produit = :productId";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindParam(':marqueId', $marque_id);
            $updateStmt->bindParam(':nom', $nom);
            $updateStmt->bindParam(':prix', $prix);
            $updateStmt->bindParam(':quantite', $quantite);
            $updateStmt->bindParam(':sexe_produit', $sexe_produit);
            $updateStmt->bindParam(':path', $path);
            $updateStmt->bindParam(':productId', $productId);
            $updateStmt->execute();
            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());
            return false;
        }
    }
    public function getProductsForFemmeByName($name)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit 
                INNER JOIN marque ON produit.marque_id = marque.id_marque 
                WHERE produit.sexe_produit = 'Femme' AND produit.nom LIKE :productName";

        $productName = '%' . $name . '%';  
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':productName', $productName);  
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function getProductsForHommeByName($name)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit 
                INNER JOIN marque ON produit.marque_id = marque.id_marque 
                WHERE produit.sexe_produit = 'Homme' AND produit.nom LIKE :productName";

        $productName = '%' . $name . '%';  
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':productName', $productName);  
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}
?>
