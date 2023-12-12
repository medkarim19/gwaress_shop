<?php
session_start();
ob_start();

require_once 'app\controllers\Controller.php';
require_once 'app\controllers\IndexController.php';
require_once 'app\controllers\ProductController.php';
require_once 'app\controllers\ContactController.php';
require_once 'app\controllers\UserController.php';
require_once 'app\controllers\CartController.php';
require_once 'app\controllers\AdminController.php';
require_once 'app\controllers\MarqueController.php';
require_once 'app\controllers\CommandController.php';
require_once 'app\models\ProductModel.php';

$indexController = new IndexController();
$productController = new ProductController();
$contactController = new ContactController();
$userController = new UserController();
$cartController = new CartController();
$adminController = new AdminController();
$marqueController = new MarqueController();
$commandController = new CommandController();
$pm = new ProductModel();
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($currentPage === 'home') {
    $indexController->index();
} elseif ($currentPage === 'menshop') {
    if (isset($_GET['action']) && $_GET['action'] === 'deleteProductForMen') {
        $productController->deleteProductForMen();
    } elseif (isset($_GET['search']) && $_GET['action'] === 'searchProductsForMen') {
        $productController->searchProductsForMen(); 
    } else {
        $productController->menshop();
    }
} elseif ($currentPage === 'womenshop') {
    if (isset($_GET['action']) && $_GET['action'] === 'deleteProductForWomen') {
        $productController->deleteProductForWomen();
    } elseif (isset($_GET['search']) && $_GET['action'] === 'searchProductsForWomen') {
        $productController->searchProductsForWomen(); 
    } else {
        $productController->womenshop();
    }
} elseif ($currentPage === 'contact') {
    $contactController->index();
} elseif ($currentPage === 'login') {
    if (isset($_POST['login_action'])) {
        $userController->login();
    } else {
        $userController->display();
    }
} elseif ($currentPage === 'cart') {
    $cartController->display();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkoutButton'])) {
        $commandController->createCommand();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'updateCartItemQuantity') {
            $cartController->updateCartItemQuantity();
        } elseif ($_POST['action'] === 'removeFromCart') {
            $cartController->removeFromCart();
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'addToCart') {
        if (!isset($_SESSION['user_id'])) {
            echo '<script>alert("You should login first.");</script>';
            echo '<script>window.location.href = "index.php?page=login";</script>';
            exit();
        }
        $cartController->addToCart();
    }
} elseif ($currentPage === 'logout') {
    $userController->logout();
} elseif ($currentPage === 'admin') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'addproduct') {
            $productController->addProduct();
        } elseif ($_GET['action'] === 'updateproduct') {
            $productController->updateProduct();
        } elseif ($_GET['action'] === 'addmarque') { 
            $marqueController->createMarque();
        } elseif ($_GET['action'] === 'updatemarque') { 
            $marqueController->updateMarque();
        } elseif ($_GET['action'] === 'deletemarque') { 
            $marqueController->deleteMarque();
        } else {
            $adminController->index();
        }
    } else {
        $adminController->index();
    }
}

ob_end_flush();
?>
