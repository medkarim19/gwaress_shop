<?php

require_once 'Controller.php';

class AdminController extends Controller {
    public function index() {
        $currentPage = 'admin';
        include 'app/views/header.php';
        $this->loadView('admin');
        include 'app/views/footer.php';
    }
}

?>
