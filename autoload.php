<?php

spl_autoload_register(function ($class_name) {
    $clssParts = explode('\\',$class_name);

    $fileName = '..' ;
        foreach ($clssParts as $parts){
            $fileName .= '/' . $parts;
        }

    require_once $fileName . '.php';
});
