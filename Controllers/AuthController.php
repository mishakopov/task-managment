<?php

namespace Controllers;

use Middlewares\IsGuest;
use Models\User;

class AuthController
{
    public function __construct()
    {
        $this->middleware = new IsGuest();
        $this->middleware->handle();
    }

    /**
     * Show registration page
     */
    public function registerView()
    {
        \Helper::render('../View/auth/register', []);

    }

    /**
     * Show login page
     */
    public function loginView()
    {
        \Helper::render('../View/auth/login', []);

    }

    /**
     * Register user and redirect to home
     */
    public function register()
    {
        $requestData = \Helper::getRequestData();
        $errors = $this->validateRegisterInput($requestData);
        if(!empty($errors)){
            \Helper::flush('errors', $errors);
            \Helper::redirect('register');
        }

        $userModel = new User();
        $userModel->register($requestData);

        $user = $userModel->getByEmail($requestData['email']);
        \Helper::setSessionKey('user', $user);
        \Helper::redirect('');
    }

    /**
     * Login user and redirect to home page
     */
    public function login()
    {
        $requestData = \Helper::getRequestData();
        $errors = $this->validateLoginInput($requestData);

        if(!empty($errors)){
            \Helper::flush('errors', $errors);
            \Helper::redirect('login');
        }
        $userModel = new User();
        $user = $userModel->getByEmail($requestData['email']);
        \Helper::setSessionKey('user', $user);
        \Helper::redirect('');
    }

    /**
     * @param $data
     * @return array
     */
    public function validateRegisterInput($data)
    {
        $errors = [];

        if (!isset($data['fullname']) || !$data['fullname']){
            $errors['fullname'] = "Full Name is required";
        }
        if (!isset($data['email']) || !$data['email']){
            $errors['email'] = "Email is required";
        }
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Email should be valid email address";
        } else {
            $userModel = new User();
            $result = $userModel->getByEmail($data['email']);
            if ($result){
                $errors['email'] = "Email exist";
            }
        }
        if (!isset($data['password']) || !$data['password']){
            $errors['password'] = "Password is required";
        } elseif($data['password'] !== $data['confirmpassword']) {
            $errors['confirmpassword'] = "Passwords doesn't match";
        }

        return $errors;
    }

    /**
     * Validate login request
     *
     * @param $data
     * @return array
     */
    public function validateLoginInput($data)
    {
        $errors = [];

        if ( !isset($data['email']) || !$data['email'] ){
            $errors['email'] = "Email is required";
        } elseif( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
            $errors['email'] = "Email should be valid email address";
        } else {
            $userModel = new User();
            $result = $userModel->getByEmail($data['email']);
            if (!$result){
                $errors['email'] = "Email doesn't exist";
            }
        }

        if ( !isset($data['password']) || !$data['password'] ){
            $errors['password'] = "Password is required";
        } elseif( isset($result) && $result){
            if($result['password'] !== md5($data['password'])){
                $errors['password'] = "Password doesn't match";
            }
        }

        return $errors;

    }

}