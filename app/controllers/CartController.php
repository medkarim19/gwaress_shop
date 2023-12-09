<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/CartModel.php';

class CartController extends Controller
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    public function display()
    {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        $cartItems = $this->cartModel->getCartItems($userId);
        $data = [
            'cartItems' => $cartItems,
        ];

        $currentPage = 'cart';
        include 'app/views/header.php';
        $this->loadView('cart', $data);
        include 'app/views/footer.php';
    }

    public function addToCart()
    {
        if (isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $this->cartModel->addItem($userId, $productId);

                echo '<script>window.location.href = "index.php?page=cart";</script>';
                exit();
            } else {
                echo '<script>alert("You should login first.");</script>';
                echo '<script>window.location.href = "index.php?page=login";</script>';
                exit();
            }
        } else {
            echo "Error: Product ID is missing.";
        }
    }

    public function removeFromCart()
    {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        if (isset($_POST['action']) && $_POST['action'] === 'removeFromCart' && isset($_POST['deleteItemId'])) {
            $cartItemId = $_POST['deleteItemId'];
            $this->cartModel->deleteItem($cartItemId);
        }
        header("Location: index.php?page=cart");
        exit();
    }
    public function updateCartItemQuantity()
    {
        $userId = $_POST['userId'];
        $cartItemId = $_POST['cartItemId'];
        $productId = $_POST['productId'];
        $newQuantity = $_POST['quantity'];
        $this->cartModel->updateItemQuantity($userId, $cartItemId, $productId, $newQuantity);
        header("Location: index.php?page=cart");
        exit();
    }

}
?>
