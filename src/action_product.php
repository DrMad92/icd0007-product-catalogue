<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

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
            $response->setContent(json_encode(['message' => 'Empty category name']));
            $response->setStatusCode(Response::HTTP_EMPTY_CATEGORY_NAME);
            $response->send();
            die();
        }
        if (empty($_POST['name'])){
            $response->setContent(json_encode(['message' => 'Empty name of a product']));
            $response->setStatusCode(Response::HTTP_EMPTY_NAME);
            $response->send();
            die();
        }
        if (empty($_POST['pid'])){
            $response->setContent(json_encode(['message' => 'Empty product id']));
            $response->setStatusCode(Response::HTTP_EMPTY_PID);
            $response->send();
            die();;
        }

        $pname = $_POST['name'];
        $pid = $_POST['pid'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        unset($_POST);

        $catObject = CategoryQuery::create()->findOneByName($category);
        
        $query = ProductQuery::create()->findByProductid($pid);
        
        // If product ID already exists
        if ($query) {
            $response->setContent(json_encode(['message' => 'Product id already exists']));
            $response->setStatusCode(Response::HTTP_PID_EXISTS);
            $response->send();
            die();
        }

        $product = new Product();
        $product -> setName($pname);
        $product -> setProductid($pid);
        $product -> setDescription($description);
        $product -> setCategory($catObject);
        $product -> save();

        $response->setContent(json_encode(['message' => 'Created']));
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->send();
        die();
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
        $response->setContent(json_encode(['message' => 'Removed']));
        $response->setStatusCode(Response::HTTP_OK);
        $response->send();
        die();
    }
    
}

?>