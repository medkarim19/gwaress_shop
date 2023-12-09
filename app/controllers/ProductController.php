<?php

require_once __DIR__ . '/../models/ProductModel.php';
require_once 'Controller.php';

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->productModel = new ProductModel($db);
    }

    public function menshop() {
        $products = $this->productModel->getProductsForHomme();
        $currentPage = 'menshop';
        include 'app/views/header.php';
        $this->loadView('produit/menshop', ['products' => $products]);
        include 'app/views/footer.php';
    }
    public function womenshop() {
        $products = $this->productModel->getProductsForFemme();
        $currentPage = 'womenshop';
        include 'app/views/header.php';
        $this->loadView('produit/womenshop', ['products' => $products]);
        include 'app/views/footer.php';
    }
    public function deleteProductForMen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
    
            // Log to check if the product ID is received correctly
            error_log("Product ID to delete: $productId");
    
            $success = $this->productModel->deleteProductById($productId);
    
            if ($success) {
                header("Location: index.php?page=menshop");
                exit();
            } else {
                header("Location: index.php?page=menshop&error=delete_error");
                exit();
            }
        }
    }
    

    public function deleteProductForWomen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];

            // Call the deleteProductById function
            $success = $this->productModel->deleteProductById($productId);

            if ($success) {
                header("Location: index.php?page=womenshop");
                exit();
            } else {
                header("Location: index.php?page=womenshop&error=delete_error");
                exit();
            }
        }
    }
    

    
}

?>
