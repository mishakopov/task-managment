<?php
session_start();

$routs = require_once '../routs.php';
require_once '../autoload.php';

//Helper::dd($_SERVER);
$request_uri = trim(Helper::getPath(), '/');

foreach ($routs as $key => $value) {
    $key = trim($key, '/');
    $routPath = Helper::routsToRegExp($key);
    $params = [];
    $isMatch = preg_match ($routPath, $request_uri, $params );
    array_shift($params);
    if($isMatch){
        Helper::callAction($value, $params);
        Helper::emptyFlush();
        break;
    }else{
//        echo 2;
    }

}


