<?php
namespace Middlewares;

class IsAuthenticated
{
    public function handle()
    {
        if(!isset($_SESSION['user'])){
            \Helper::redirect('login');
        }
    }
}