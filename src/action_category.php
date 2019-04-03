<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $list = $_POST['name'];
    $sublist = $_POST['sub-list'];

    echo $list.PHP_EOL;
    echo $sublist.PHP_EOL;

    header("HTTP/1.1 303 See Other");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

?>