<?php
require_once 'Controller.php' ;
class ContactController extends Controller {
    public function index() {
        $currentPage='contact' ;
        include 'app/views/header.php';
        $this->loadView('contact');
        include 'app/views/footer.php';
    }
}
?>