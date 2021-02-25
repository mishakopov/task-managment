<?php

namespace Controllers;

class UserController
{
    /**
     * Return edit profile view
     */
    public function edit()
    {
        \Helper::render('../View/auth/update', []);

    }

    public function update()
    {
        //todo creat update logic
    }

    /**
     * Log out user
     */
    public function logout()
    {
        \Helper::removeSessionKey('user');
        \Helper::redirect('');
        \Helper::
    }

}