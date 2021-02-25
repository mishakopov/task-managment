<?php
namespace Middlewares;

class IsGuest
{
    public function handle()
    {
        if(isset($_SESSION['user'])){
            \Helper::redirect('');
        }
    }
}