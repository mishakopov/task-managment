<?php
namespace Controllers;

class HomeController
{
    public function index()
    {
        \Helper::render('../View/homepage', []);
    }
}