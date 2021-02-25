<?php
namespace Models;

use PDO;

class DB
{
    protected $connection;
    public function __construct()
    {
        $configs = \Configs::get('DB');
        try{
            $this->connection = new PDO('mysql:host=' . $configs['servername'] . ';dbname=' . $configs['dbname'] , $configs['username'], $configs['password'] );
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }
}