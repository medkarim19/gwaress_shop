<?php
require_once 'Database.php';
class CommandModel 
{
    public function createCommand($userId, $total)
    {
        $conn = Database::getInstance()->getConnection();
        $currentDate = new DateTime();
        $deliveryDate = $currentDate->add(new DateInterval('P2D'))->format('Y-m-d H:i:s');
        $query = "INSERT INTO commande (id_user, total, date_livraison, validated) 
                  VALUES (:userId, :total, :dateLivraison, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':dateLivraison', $deliveryDate);

        return $stmt->execute();
    }
    public function getDeliveryDate($commandId)
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT date_livraison FROM commande WHERE id_commande = :commandId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':commandId', $commandId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['date_livraison'] ?? null;
    }
}
?>