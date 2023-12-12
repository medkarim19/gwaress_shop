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
        $currentPage = 'menshop';
        include 'app/views/header.php';
        $products = $this->productModel->getProductsForHomme();
        $this->displayProducts($products);
        include 'app/views/footer.php';
    }
    public function womenshop() {
        $currentPage = 'womenshop';
        include 'app/views/header.php';
        $products = $this->productModel->getProductsForFemme();
        $this->displayProducts($products);
        include 'app/views/footer.php';
    }
    
    public function searchProductsForWomen() {
        $currentPage = 'womenshop';
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            $products = $this->productModel->getProductsForFemmeByName($searchQuery);
            $this->displayProducts($products);
        } else {
            echo '<p>No products found.</p>';
        }
    }

    public function searchProductsForMen() {
        $currentPage = 'menshop';
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            error_log('Search query for men: ' . $searchQuery);
            $products = $this->productModel->getProductsForHommeByName($searchQuery);
            $this->displayProducts($products);
        } else {
            echo '<p>No products found.</p>';
        }
    }

    
    private function displayProducts($products) {
        $this->loadView('produit/womenshop', ['products' => $products]);
    }
    
    public function deleteProductForMen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
    
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
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marque_id'], $_POST['nom'], $_POST['prix'], $_POST['quantite'], $_POST['sexe_produit'])) {
            $marque_id = $_POST['marque_id'];
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $quantite = $_POST['quantite'];
            $sexe_produit = $_POST['sexe_produit'];
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $path = $_FILES['image']['name'];
                $uploadDirectory = 'C:\wamp64\www\gwaress\assets\images\shop';
                $targetPath = $uploadDirectory . $path;
    
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {  
                } else {
                    echo "Error uploading the file. Please try again.";
                    return;
                }
            } else {
                echo "File upload error. Please try again.";
                return;
            }
    
            $newProductId = $this->productModel->createProduct($marque_id, $nom, $prix, $quantite, $sexe_produit, $path);
    
            if ($newProductId !== false) {
                header('Location: index.php?page=admin');
                exit();
            } else {
                echo "Failed to add the product.";
            }
        } else {
            echo "Incomplete data. Please provide all required information.";
        }
    }
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produit'], $_POST['marque_id'], $_POST['nom'], $_POST['prix'], $_POST['quantite'], $_POST['sexe_produit'])) {
            $id_produit = $_POST['id_produit'];
            $marque_id = $_POST['marque_id'];
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $quantite = $_POST['quantite'];
            $sexe_produit = $_POST['sexe_produit'];

            
            $path = ''; 

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDirectory = 'C:\wamp64\www\gwaress\assets\images\shop';  
                $filename = $_FILES['image']['name'];
                $targetPath = $uploadDirectory . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $path = $filename;  
                } else {
                    echo "Error uploading the file. Please try again.";
                    return;
                }
            }

            $success = $this->productModel->updateProduct($id_produit, $marque_id, $nom, $prix, $quantite, $sexe_produit, $path);

            if ($success) {
                header('Location: index.php?page=admin');
                exit();
            } else {
                echo "Failed to update the product.";
            }
        } else {
            echo "Incomplete data. Please provide all required information.";
        }
    }


}
?>
