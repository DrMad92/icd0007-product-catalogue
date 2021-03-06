<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Required because products.php is called as object
require_once '../vendor/autoload.php';
require_once '../propel/config.php';

// Load template files
$loader = new \Twig\Loader\FilesystemLoader('../static');

// Twig configuration
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
        // Query all products
        case "all":
            $query = ProductQuery::create()
                ->orderByName()
                ->find();
            break;
        // Else query products from specific category
        default:
            $category = CategoryQuery::create()->findOneByName($searchCategory);
            $query = $category->getProducts();
    }
    // Query all categories. Needed for product editing.
    $allCategories = CategoryQuery::create()->find();

    foreach ($query as $v){
        array_push($productList, $v->getAttributes());
    }
    echo $twig->render('products.html',
            ['productList' => $productList,
            'categoryList' => $allCategories,
            'searchCategory' => $searchCategory]);
}

?>