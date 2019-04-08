<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $category = $_POST['name'];
    $subcategory = $_POST['sub-list'];
    unset($_POST);
    
    $cat = new Category();
    $cat -> setName($category);
    $cat -> save();

    header("HTTP/1.1 303 See Other");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

?>