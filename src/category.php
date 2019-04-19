<?php
declare(strict_types=1);
error_reporting(E_ALL);

$loader = new \Twig\Loader\FilesystemLoader('static');

$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true
]);

$query = CategoryQuery::create()
    ->orderByName()
    ->find(); 

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