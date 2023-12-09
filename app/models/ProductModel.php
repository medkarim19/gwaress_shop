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
    
        $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }
    public function deleteProductById($productId) {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM produit WHERE id_produit = :productId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':productId', $productId);
        
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    
    
}
?>
