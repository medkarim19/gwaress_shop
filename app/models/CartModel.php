<?php
class CartModel 
{
    public function getCartItems($userId) {
        $conn = Database::getInstance()->getConnection();
        $query = "
            SELECT p.id, p.id_client, p.produit_id, p.date_added, p.quantite,
                   pr.marque_id, pr.prix, pr.path
            FROM panier p
            JOIN produit pr ON p.produit_id = pr.id_produit
            WHERE p.id_client = :userId";
    
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
    
            
            $errorInfo = $stmt->errorInfo();
            if ($errorInfo[0] !== '00000') {
                throw new Exception("Database Error: " . $errorInfo[2]);
            }
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return []; 
        }
    }
    
    

    public function deleteItem($cartItemId)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM panier WHERE id = :cartItemId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cartItemId', $cartItemId);
        $stmt->execute();
    }
    public function addItem($userId, $productId)
    {
        $conn = Database::getInstance()->getConnection();
        $checkQuery = "SELECT * FROM panier WHERE id_client = :userId AND produit_id = :productId";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $updateQuery = "UPDATE panier SET quantite = quantite + 1 WHERE id_client = :userId AND produit_id = :productId";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
        } else {
            $dateAdded = date('Y-m-d H:i:s');
            $addQuery = "INSERT INTO panier (id_client, produit_id, date_added, quantite) VALUES (:userId, :productId, :dateAdded, 1)";
            $stmt = $conn->prepare($addQuery);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':dateAdded', $dateAdded);
            $stmt->execute();
        }
    }
    public function updateItemQuantity($userId, $cartItemId, $productId, $newQuantity)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "UPDATE panier SET quantite = :newQuantity WHERE id_client = :userId AND id = :cartItemId AND produit_id = :productId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':newQuantity', $newQuantity);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':cartItemId', $cartItemId);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
    }   
    public function clearCart($userId)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM panier WHERE id_client = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

}
?>
