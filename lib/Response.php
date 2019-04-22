<?php

use Symfony\Component\HttpFoundation\Response as BaseResponse;

class Response extends BaseResponse
{
    const HTTP_CATEGORY_EXISTS = 490;
    const HTTP_EMPTY_CATEGORY_NAME = 491;
    const HTTP_EMPTY_NAME = 492;
    const HTTP_PID_EXISTS = 493;
    const HTTP_EMPTY_PID = 494;

    public static $statusTexts = [
        490 => 'Category Exists',
        491 => 'Empty Category Name',
        492 => 'Empty Name',
        493 => 'PID Exists',
        494 => 'Empty PID'
    ];

    public function __construct($content = '', $status = 200, $headers = array())
    {
        $this::$statusTexts = parent::$statusTexts + $this::$statusTexts;

        parent::__construct($content, $status, $headers);
    }
}