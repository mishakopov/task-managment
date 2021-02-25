<?php

class Helper
{
    static function getPath()
    {
      return $_SERVER['REQUEST_URI'];
    }


    static function routsToRegExp($rout)
    {
        $rout = str_replace('/', '\/', $rout);
        $rout = preg_replace('({\w+})', '(\w+)', $rout);
        $rout = '/^' . $rout . '$/';
        return $rout;
    }

    static function callAction($action, $params)
    {
        $classParts = explode('@', $action);
        $reflector = new \ReflectionClass($classParts[0]);
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            $foo = $reflector->newInstance();
        }else{
            $req_params = $constructor->getNumberOfRequiredParameters();
            $p = [];
            for($i = 0;  $i<$req_params; $i++){
             $p[] ='';
            }
            $foo = $reflector->newInstanceArgs($p);
        }

        return call_user_func_array([$foo, $classParts[1]], $params);

    }

    static function render($viewName, array $params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }

        require_once $viewName . '.php';
    }

    static function getRequestData()
    {
        unset($_REQUEST['PHPSESSID']);
        return $_REQUEST;
    }

    static function flush($key, $val){
        $_SESSION['flush'][$key] = $val;
    }

    static function emptyFlush(){
        $_SESSION['flush'] = [];
    }

    static function redirect($path)
    {
        $prot = $_SERVER['SERVER_PROTOCOL'];
        $prot = strtolower(substr($prot, 0, -4)) . '://';

        $url = $prot . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] ?  ':' . $_SERVER['SERVER_PORT'] : '') . '/' . $path;
        header("Location: " . $url);
        die;
    }

    static function generateUrl($path)
    {
        $prot = $_SERVER['SERVER_PROTOCOL'];
        $prot = strtolower(substr($prot, 0, -4)) . '://';

        $url = $prot . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] ?  ':' . $_SERVER['SERVER_PORT'] : '') . '/' . $path;

        return $url;
    }

    static function dd($var)
    {
        echo "<pre>";
        print_r($var);
        die;
    }

    static function getError($key)
    {
        if(isset($_SESSION['flush'])  && isset($_SESSION['flush']['errors']) && isset($_SESSION['flush']['errors'][$key])){
            return $_SESSION['flush']['errors'][$key];
        }
    }

    static function setSessionKey($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    static function getSessionKey($key)
    {
        return $_SESSION[$key];
    }

    static function removeSessionKey($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Check is logged in user admin or not
     *
     * @return bool
     */
    static function isAdmin()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 1){
            return true;
        }

        return false;
    }
}