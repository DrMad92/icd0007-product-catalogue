<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Load template files
$loader = new \Twig\Loader\FilesystemLoader('static');

// Twig configuration
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true
]);

// Querying all categories
$query = CategoryQuery::create()
    ->orderByName()
    ->find(); 

// Save all categories in array with formatting
$categoryList = array();
foreach ($query as $v){
    array_push($categoryList, $v->getAttributes());
}


if($_SERVER['REQUEST_METHOD'] == "GET")
{
    echo $twig->render('category.html',
            ['categoryList' => $categoryList]);
}

?>