<?php

class Controller {
    protected function loadView($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }
    
    

    protected function redirect($url) {
        header("Location: {$url}");
        exit();
    }
}

?>
