<?php
declare(strict_types=1);
error_reporting(E_ALL);

// include 'lib/classes.php';
require_once './vendor/autoload.php';
require_once './lib/classes.php';

$loader = new \Twig\Loader\FilesystemLoader('static');

$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true
]);

$cat1 = new Category("Category 1", "category1-title", "category1");
$cat2 = new Category("Category 2", "category2-title", "category2");
$cat3 = new Category("Category 3", "category3-title", "category3");

$categoryList = array(
    $cat1 -> getAttributes(),
    $cat2 -> getAttributes(),
    $cat3 -> getAttributes()
);

if($_SERVER['REQUEST_METHOD'] == "GET")
{
    echo $twig->render('category.html',
            ['categoryList' => $categoryList]);
}

?>