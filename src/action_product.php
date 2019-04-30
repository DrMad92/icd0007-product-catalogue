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

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->setCharset('UTF-8');

    // If Add button was pressed to submit Add form
    if (isset($_POST['add'])){
        // If name or category name was not submitted when editing existent category
        // For whatever reason, html required is not working
        if (empty($_POST['category'])){
            respond('Empty category name', Response::HTTP_EMPTY_CATEGORY_NAME);
        }
        if (empty($_POST['name'])){
            respond('Empty name of a product', Response::HTTP_EMPTY_NAME);
        }
        if (empty($_POST['pid'])){
            respond('Empty product id', Response::HTTP_EMPTY_PID);
        }

        $pname = $_POST['name'];
        $pid = $_POST['pid'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        unset($_POST);

        $pname = preg_replace("/[^a-zA-Z0-9 ]+/", "", $pname); // Leave only alpha numeric and space
        $pid = preg_replace("/[^a-zA-Z0-9]+/", "", $pid); // Leave only alpha numeric and space

        $catObject = CategoryQuery::create()->findOneByName($category);
        
        $query = ProductQuery::create()->findOneByProductid($pid);
        
        // If product ID already exists
        if ($query) {
            respond('Product id already exists', Response::HTTP_PID_EXISTS);
        }

        $product = new Product();
        $product -> setName($pname);
        $product -> setProductid($pid);
        $product -> setDescription($description);
        $product -> setCategory($catObject);
        $product -> save();

        respond('Created', Response::HTTP_CREATED);
    }
    // If Delete button was pressed to submit Delete form
    elseif(isset($_POST['delete'])){
        // Get list of product ids to delete
        $idList = $_POST['id'];
        unset($_POST);
        // Delete all products in list
        foreach ($idList as $v) {
            ProductQuery::create()
                ->findPK($v)
                ->delete();
        }
        respond('Removed', Response::HTTP_OK);
    }
    // If Save button was pressed to submit Edit form
    elseif(isset($_POST['save'])){
        // If name or category name was not submitted when editing existent category
        if (empty($_POST['category'])){
            respond('Empty category name', Response::HTTP_EMPTY_CATEGORY_NAME);
        }
        if (empty($_POST['name'])){
            respond('Empty new name', Response::HTTP_EMPTY_NAME);
        }
        if (empty($_POST['pid'])){
            respond('Empty product id', Response::HTTP_EMPTY_PID);
        }
        $pname = $_POST['name'];
        $pid = $_POST['pid'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $id = $_POST['id'];
        unset($_POST);
        
        $pname = preg_replace("/[^a-zA-Z0-9 ]+/", "", $pname); // Leave only alpha numeric and space
        $pid = preg_replace("/[^a-zA-Z0-9]+/", "", $pid); // Leave only alpha numeric and space

        $catObject = CategoryQuery::create()->findOneByName($category);
        // Update values of product
        $editProduct = ProductQuery::create()->findPk($id);
        $editProduct -> setName($pname);
        $editProduct -> setDescription($description);
        $editProduct -> setCategory($catObject);

        // Check if pid already taken or is not changed
        $query = ProductQuery::create()
            ->findOneByProductid($pid);
        if ($query && $query->getProductid() != $editProduct->getProductid()) {
            respond('Product id already exists', Response::HTTP_PID_EXISTS);
        }

        $editProduct -> setProductid($pid);
        $editProduct -> save();
    
        respond('Changed product', Response::HTTP_OK);
    }
}

?>