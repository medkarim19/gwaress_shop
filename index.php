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

$indexController = new IndexController();
$productController = new ProductController();
$contactController = new ContactController();
$userController = new UserController();
$cartController = new CartController();
$adminController = new AdminController();
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($currentPage === 'home') {
    $indexController->index();
} elseif ($currentPage === 'menshop') {
    if (isset($_GET['action']) && $_GET['action'] === 'deleteProductForMen') {
        $productController->deleteProductForMen();
    } else {
        $productController->menshop();
    }
} elseif ($currentPage === 'womenshop') {
    if (isset($_GET['action']) && $_GET['action'] === 'deleteProductForWomen') {
        $productController->deleteProductForWomen();
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
    $adminController->index();
}

ob_end_flush();
?>
