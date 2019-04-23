<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

// Creates response with message and status code
function respond($message, $statusCode){
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->setCharset('UTF-8');
    $response->setContent(json_encode(['message' => $message]));
    $response->setStatusCode($statusCode);
    $response->send();
    die();
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    // If add button was pressed to post Add form
    if (isset($_POST['add'])) {
        // If empty category name was posted
        if (empty($_POST['name'])){
            respond('Empty category name', Response::HTTP_EMPTY_CATEGORY_NAME);
        }
        $category = $_POST['name'];
        unset($_POST);
        $category = preg_replace("/[^a-zA-Z0-9]+/", "", $category); // Leave only alpha numeric
        
        $query = CategoryQuery::create()->findOneByName($category);
        
        // If category already exists
        if ($query) {
            respond('Category exists', Response::HTTP_CATEGORY_EXISTS);
        }

        $cat = new Category();
        $cat -> setName($category);
        $cat -> save();

        respond('Created', Response::HTTP_CREATED);
    }
    // If Save button was pressed to post Edit form
    elseif(isset($_POST['save'])) {
        // If name or category name was not submitted when editing existent category
        if (empty($_POST['category'])){
            respond('Empty category name', Response::HTTP_EMPTY_CATEGORY_NAME);
        }
        if (empty($_POST['name'])){
            respond('Empty new name', Response::HTTP_EMPTY_NAME);
        }
        $category = $_POST['category'];
        $newName = $_POST['name'];
        unset($_POST); 
        $newName = preg_replace("/[^a-zA-Z0-9]+/", "", $newName); // Leave only alpha numeric

        // Check if name already taken
        $query = CategoryQuery::create()
            ->findOneByName($newName);
        if ($query) {
            respond('Category exists', Response::HTTP_CATEGORY_EXISTS);
        }
        // Update name value of category
        $query = CategoryQuery::create()
            ->filterByName($category)
            ->update(array('Name' => $newName));
    
        respond('Renamed', Response::HTTP_OK);
    }
    // If Delete button was pressed to post Edit form
    elseif (isset($_POST['delete'])){
        // If category was not choosen to delete
        if (empty($_POST['category'])){
            respond('Empty category name', Response::HTTP_EMPTY_CATEGORY_NAME);
        }
        $category = $_POST['category'];
        unset($_POST);

        $query = CategoryQuery::create()->findOneByName($category);
        // Delete all products associated with this category
        $productList = ProductQuery::create() -> filterByCategory($query) -> delete();
        // Delete category itself
        $query->delete();
        
        respond('Removed', Response::HTTP_OK);
    }
}

?>