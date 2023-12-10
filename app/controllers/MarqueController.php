<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/MarqueModel.php';

class MarqueController extends Controller
{
    private $marqueModel;

    public function __construct()
    {
        $this->marqueModel = new MarqueModel();
    }

    public function getAllMarques()
    {
        $marques = $this->marqueModel->getAllMarques();
        return $marques;
    }

    public function getMarqueById($marqueId)
    {
        $marque = $this->marqueModel->getMarqueById($marqueId);
        return $marque;
    }

    public function createMarque()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marque_name'])) {
            $marqueName = $_POST['marque_name'];

            $success = $this->marqueModel->createMarque($marqueName);

            if ($success) {
                header("Location: index.php?page=admin");
                exit();
            } else {
                echo "Failed to add the marque.";
            }
        } else {
            echo "Incomplete data. Please provide all required information.";
        }
    }

    public function updateMarque()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marque_id'], $_POST['new_marque_name'])) {
            $marqueId = $_POST['marque_id'];
            $newMarqueName = $_POST['new_marque_name'];

            $success = $this->marqueModel->updateMarque($marqueId, $newMarqueName);

            if ($success) {
                header('Location: index.php?page=admin');
                exit();
            } else {
                echo "Failed to update the marque.";
            }
        } else {
            echo "Incomplete data. Please provide all required information.";
        }
    }

    public function deleteMarque()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marque_id'])) {
            $marqueId = $_POST['marque_id'];

            $success = $this->marqueModel->deleteMarque($marqueId);

            if ($success) {
                header('Location: index.php?page=admin');
                exit();
            } else {
                echo "Failed to delete the marque.";
            }
        } else {
            echo "Incomplete data. Please provide all required information.";
        }
    }
}

?>
