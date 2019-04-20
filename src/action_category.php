<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    if (isset($_POST['add'])) {
        $category = $_POST['name'];
        unset($_POST);
        $category = preg_replace("/[^a-zA-Z0-9]+/", "", $category); // Leave only alpha numeric
        
        if ($category == ""){
            header('HTTP/1.1 491 Empty category name');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Empty category name', 'code' => 491)));
        }
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
    
    } elseif(isset($_POST['save'])) {
        if (empty($_POST['name']) || empty($_POST['category'])){
            header('HTTP/1.1 492 Empty name');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Empty name', 'code' => 492)));
        }
        $category = $_POST['category'];
        $newName = $_POST['name'];
        unset($_POST); 
        $newName = preg_replace("/[^a-zA-Z0-9]+/", "", $newName); // Leave only alpha numeric

        $query = CategoryQuery::create()
            ->filterByName($category)
            ->update(array('Name' => $newName));
        
        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Renamed', 'code' => 200)));

    } elseif (isset($_POST['delete'])){
        if (empty($_POST['category'])){
            header('HTTP/1.1 492 Empty name');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Empty name', 'code' => 492)));
        }
        $category = $_POST['category'];
        unset($_POST);

        $query = CategoryQuery::create()->findOneByName($category);
        $productList = ProductQuery::create() -> filterByCategory($query) -> delete();;
        $query->delete();
        
        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Removed', 'code' => 200)));

    }
    
}

?>