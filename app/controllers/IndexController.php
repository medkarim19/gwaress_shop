<?php

require_once 'Controller.php';

class IndexController extends Controller {
    public function index() {
        $currentPage = 'home';
        include 'app/views/header.php';
        $this->loadView('home');
        include 'app/views/footer.php';
    }
}

?>
