<?php
namespace  Models;

class User extends DB
{
    protected $tableName = "users" ;

    public  function register(array $data)
    {
        try{
            $sql = " INSERT INTO `" . $this->tableName. "` (`full_name`, `email`, `password`, `role`, `created_at` ) VALUES ('"
            .  $data['fullname'] ."', '" . $data['email'] . "', '" . md5($data['password']) . "', 2, '". date('Y-m-d H:i:s')."')";
            $sth = $this->connection->prepare($sql);
            $sth->execute();
        }
        catch (\PDOException $e){
            echo "The user could not be added.<br>".$e->getMessage();
        }
    }
    public function getByEmail($email)
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE email = '" . $email . "'";
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE role = 2";
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateUser(array $data)
    {
        //todo change insert to update
        $sql = " INSERT INTO `" . $this->tableName. "` (`full_name`, `email`, `password`) VALUES ('"
            .  $data['fullname'] ."', '" . $data['email'] . "', '" . md5($data['password']) . "')";
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE id = '" . $id . "'";
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

 
}