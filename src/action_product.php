<?php

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['add'])){
        $pname = $_POST['name'];
        $pid = $_POST['pid'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        unset($_POST);

        $catObject = CategoryQuery::create()->findOneByName($category);
        
        $product = new Product();
        $product -> setName($pname);
        $product -> setProductid($pid);
        $product -> setDescription($description);
        $product -> setCategory($catObject);
        $product -> save();

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Success', 'code' => 200)));
    }
    elseif(isset($_POST['delete'])){
        $idList = $_POST['id'];
        foreach ($idList as $v) {
            ProductQuery::create()
                ->findPK($v)
                ->delete();
        }
        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Success', 'code' => 200)));
    }
    
}

?>