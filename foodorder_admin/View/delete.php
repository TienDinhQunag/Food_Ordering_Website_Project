<?php 
// delete.php

include('../Controller/FoodController.php');

// Instantiate the FoodController
$foodController = new FoodController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['foodId'])) {
    $foodId = $_POST['foodId'];
    $foodController->deleteFood($foodId);
}


?>