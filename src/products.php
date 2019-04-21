<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../propel/config.php';

$loader = new \Twig\Loader\FilesystemLoader('../static');

$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true
]); 

$productList = array();

if($_SERVER['REQUEST_METHOD'] == "GET")
{
    $searchCategory = $_GET['category'];
    unset($_GET);
    switch ($searchCategory){
        case "all":
            $query = ProductQuery::create()
                ->orderByName()
                ->find();
            break;
        default:
            $category = CategoryQuery::create()->findOneByName($searchCategory);
            $query = $category->getProducts();
    }
    $allCategories = CategoryQuery::create()->find();
    
    foreach ($query as $v){
        array_push($productList, $v->getAttributes());
    }
    echo $twig->render('products.html',
            ['productList' => $productList,
            'categoryList' => $allCategories]);
}

?>