<?php
namespace  Models;

class Task extends DB
{

    /*
     *
     * 0 => 'pending'
     * 1 => 'in_progress'
     * 2 => 'rejected'
     * 3 => 'done'
     *
     */
    protected $tableName = "tasks" ;


    public function createTask($data)
    {
        try {
            $sql = " INSERT INTO `" . $this->tableName . "` (`title`, `body`, `files`, `deadline`, `user_id`, `created_at`,  `creator_id`) VALUES ('"
                . $data['title'] . "', '"
                . $data['body'] . "', '"
                . $data['file'] . "', '"
                . $data['deadline'] . "', "
                . $data['user_id'] . ", '"
                . date('Y-m-d H:i:s') . "', "
                . $data['creator_id'] . ")";

            $sth = $this->connection->prepare($sql);
            $sth->execute();
        } catch (\PDOException $e) {
            echo "The user could not be added.<br>" . $e->getMessage();
        }
    }

    public function getAllTasks()
    {
        $sql = "Select {$this->tableName}.*, users.full_name from " . $this->tableName .
               " LEFT JOIN users ON " . $this->tableName.".user_id = users.id".
               " WHERE `creator_id` = " . \Helper::getSessionKey('user')['id'];
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllTasksForUser()
    {
        $sql = "Select {$this->tableName}.*, users.full_name from " . $this->tableName .
               " LEFT JOIN users ON " . $this->tableName.".creator_id = users.id".
               " WHERE `user_id` = " . \Helper::getSessionKey('user')['id'];
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function changeStatus($id, $status)
    {
        $sql = "UPDATE " . $this->tableName . " SET `status`=" . $status . " WHERE `id`=" . $id;
        $sth = $this->connection->prepare($sql);
        $sth->execute();
    }
}