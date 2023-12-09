<?php

require_once 'Database.php';

class ProductModel
{
    public function getProductsForHomme()
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit WHERE produit.sexe_produit='Homme'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function getProductsForFemme(){
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit WHERE produit.sexe_produit='Femme'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products ;
    }
    public function getProductById($productId) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM produit WHERE produit.id_produit = :productId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
    
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
    
    public function deleteProductById($productId) {
    $conn = Database::getInstance()->getConnection();

    // Start a transaction to ensure consistency across multiple queries
    $conn->beginTransaction();

    try {
        // Delete from panier table first
        $panierQuery = "DELETE FROM panier WHERE produit_id = :productId";
        $panierStmt = $conn->prepare($panierQuery);
        $panierStmt->bindParam(':productId', $productId);
        $panierStmt->execute();

        // Then delete from produit table
        $produitQuery = "DELETE FROM produit WHERE id_produit = :productId";
        $produitStmt = $conn->prepare($produitQuery);
        $produitStmt->bindParam(':productId', $productId);
        $produitStmt->execute();

        // If both queries succeed, commit the transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        $conn->rollback();

        // Log the error message
        error_log($e->getMessage());

        return false;
    }
}

    
    
    
}
?>
