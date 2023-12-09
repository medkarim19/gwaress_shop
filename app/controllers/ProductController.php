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
    

    
}

?>
