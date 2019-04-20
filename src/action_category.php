<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $category = $_POST['name'];
    unset($_POST);
    $category = preg_replace("/[^a-zA-Z0-9]+/", "", $category); // Leave only alpha numeric
    
    $query = CategoryQuery::create()->findOneByName($category);
    if ($query) {
        header('HTTP/1.1 490 Category exists');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Category exists', 'code' => 490)));
    }

    $cat = new Category();
    $cat -> setName($category);
    $cat -> save();

    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'Success', 'code' => 200)));
}

?>