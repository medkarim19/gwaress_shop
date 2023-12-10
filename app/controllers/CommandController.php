<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/CommandModel.php';
require_once __DIR__ . '/../models/UserModel.php';  


require 'vendor/autoload.php';  
use PHPMailer\PHPMailer\PHPMailer;

class CommandController extends Controller
{
    private $commandModel;

    public function __construct()
    {
        $this->commandModel = new CommandModel();
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
    }

    public function createCommand()
    {
        if (!isset($_SESSION['user_id'])) {
            echo 'Impossible de créer la commande. Veuillez vous connecter.';
            return;
        }

        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);
        if (empty($cartItems)) {
            echo 'Impossible de créer la commande. Votre panier est vide.';
            return;
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item['prix'] * $item['quantite'];
        }

        $commandId = $this->commandModel->createCommand($userId, $totalAmount);

        if ($commandId) {
            $this->cartModel->clearCart($userId);
            $userEmail = $this->userModel->getUserEmail($userId);
            $deliveryDate = $this->commandModel->getDeliveryDate($commandId);
            $this->sendOrderConfirmationEmail($userEmail, $deliveryDate);
            header('Location: index.php?page=cart');
            exit();
        } else {
            echo 'Une erreur s\'est produite lors de la création de la commande.';
        }
    }

    private function sendOrderConfirmationEmail($userEmail, $deliveryDate)
    {
        
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mohamed-karim.bezine@enis.tn';
        $mail->Password   = 'Karim1824.'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;


        
        $mail->setFrom('gwaress3@gmail.com', 'Gwaress Command');
        $mail->addAddress($userEmail);

        
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de commande';
        $mail->Body = "Votre commande a été confirmée. Elle sera livrée le $deliveryDate.";

        
        if (!$mail->send()) {
            echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
        }
    }

}

?>
