<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->setCharset('UTF-8');
    // If add button was pressed to post Add form
    if (isset($_POST['add'])) {
        // If empty category name was posted
        if (empty($_POST['name'])){
            $response->setContent(json_encode(['message' => 'Empty category name']));
            $response->setStatusCode(Response::HTTP_EMPTY_CATEGORY_NAME);
            $response->send();
            die();
        }
        $category = $_POST['name'];
        unset($_POST);
        $category = preg_replace("/[^a-zA-Z0-9]+/", "", $category); // Leave only alpha numeric
        
        $query = CategoryQuery::create()->findOneByName($category);
        
        // If category already exists
        if ($query) {
            $response->setContent(json_encode(['message' => 'Category exists']));
            $response->setStatusCode(Response::HTTP_CATEGORY_EXISTS);
            $response->send();
            die();
        }

        $cat = new Category();
        $cat -> setName($category);
        $cat -> save();

        $response->setContent(json_encode(['message' => 'Created']));
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->send();
        die();   
    
    }
    // If Save button was pressed to post Edit form
    elseif(isset($_POST['save'])) {
        // If name or category name was not submitted when editing existent category
        if (empty($_POST['category'])){
            $response->setContent(json_encode(['message' => 'Empty category name']));
            $response->setStatusCode(Response::HTTP_EMPTY_CATEGORY_NAME);
            $response->send();
            die();
        }
        if (empty($_POST['name'])){
            $response->setContent(json_encode(['message' => 'Empty new name']));
            $response->setStatusCode(Response::HTTP_EMPTY_NAME);
            $response->send();
            die();
        }
        $category = $_POST['category'];
        $newName = $_POST['name'];
        unset($_POST); 
        $newName = preg_replace("/[^a-zA-Z0-9]+/", "", $newName); // Leave only alpha numeric

        // Update name value of category
        $query = CategoryQuery::create()
            ->filterByName($category)
            ->update(array('Name' => $newName));
    
        $response->setContent(json_encode(['message' => 'Renamed']));
        $response->setStatusCode(Response::HTTP_OK);
        $response->send();
        die();

    }
    // If Delete button was pressed to post Edit form
    elseif (isset($_POST['delete'])){
        // If category was not choosen to delete
        if (empty($_POST['category'])){
            $response->setContent(json_encode(['message' => 'Empty category name']));
            $response->setStatusCode(Response::HTTP_EMPTY_CATEGORY_NAME);
            $response->send();
            die();
        }
        $category = $_POST['category'];
        unset($_POST);

        $query = CategoryQuery::create()->findOneByName($category);
        // Delete all products associated with this category
        $productList = ProductQuery::create() -> filterByCategory($query) -> delete();
        // Delete category itself
        $query->delete();
        
        $response->setContent(json_encode(['message' => 'Removed']));
        $response->setStatusCode(Response::HTTP_OK);
        $response->send();
        die();
    }
}

?>