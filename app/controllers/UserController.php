<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once 'Controller.php';


class UserController extends Controller
{   
    public function display()
    {
        $currentPage = 'login';
        include 'app/views/header.php';
        $this->loadView('/login/login', ['currentPage' => $currentPage]);
        include 'app/views/footer.php';
    }

    public function processForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

            switch ($formType) {
                case 'login':
                    $this->login();
                    break;
                case 'register':
                    $this->register();
                    break;
            }
        }
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'register') {
            $fullname = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $datenaissance = $_POST['datenaissance'];
            $numtel = $_POST['numtel'];
            $adresse = $_POST['adresse'];

            if (empty($fullname) || empty($email) || empty($password) || empty($datenaissance) || empty($numtel) || empty($adresse)) {
                header("Location: index.php?page=login&error=1");
                exit();
            }

            $userModel = new UserModel();
            $rowCount = $userModel->createUser($fullname, $password, $email, $datenaissance, $numtel, $adresse);

            if ($rowCount > 0) {
                header("Location: index.php?page=login");
                exit();
            } else {
                header("Location: index.php?page=login&error=2");
                exit();
            }
        }
    }

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
            $username = $_POST['name'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByNameAndPassword($username, $password);

            if ($user !== null) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                header("Location: index.php?page=home");
                exit();
            } else {
                header("Location: index.php?page=login");
                exit();
            }
        }
    }


    public function logout(){
        session_start();
        if (isset($_SESSION['user_id'])) {
            $_SESSION = array();
            session_destroy();
        }
        $this->redirectTologin();
    }

    public function redirectTologin(){
        header('Location: index.php?page=login');
    }
    public function redirectTohome(){
        header('Location: index.php?page=home');
    }
}
$userController = new UserController();
$userController->processForm();
?>

