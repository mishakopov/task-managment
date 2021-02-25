<?php
namespace Controllers;
use Models\Task;
use Models\User;

class TaskController
{
    /**
     * get all tasks
     */
    public function all()
    {
        $taskModel = new Task;

        if (\Helper::isAdmin()){
            $tasks = $taskModel->getAllTasks();
        }else{
            $tasks = $taskModel->getAllTasksForUser();
        }
        \Helper::render('../View/tasks/alltasks', [ 'tasks' => $tasks ]);
    }

    /**
     * Render task crete view
     */
    public function create()
    {
        if(!\Helper::isAdmin()){
            \Helper::redirect('');
        }

        $userModel = new User;
        $users = $userModel->getAllUsers();

        \Helper::render('../View/tasks/create', [ 'users' => $users]);
    }

    /**
     * Create task
     */
    public function store()
    {
        if(!\Helper::isAdmin()){
            \Helper::redirect('');
        }

        $requestData = \Helper::getRequestData();
        $errors = $this->validateTaskCreate($requestData);

        if(!empty($errors)){
            \Helper::flush('errors', $errors);
            \Helper::redirect('task/create');
        }

        $target_dir = realpath(dirname(__FILE__) ). "/../Public/uploads/";
        $target_file = time() . basename($_FILES["file"]["name"]);
        $filename = $target_dir . $target_file;
        move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

        $requestData['file'] = 'uploads/' . $target_file;
        $requestData['creator_id'] = \Helper::getSessionKey('user')['id'];


        $taskModel = new Task();
        $taskModel->createTask($requestData);

        \Helper::redirect('task/all');

    }

    /**
     * Validate task input
     *
     * @param $data
     * @return array
     */
    public function validateTaskCreate($data)
    {
        $errors = [];
        if (!isset($data['title']) || !$data['title']){
            $errors['title'] = "Title is required";
        }
        if (!isset($data['user_id']) || !$data['user_id']){
            $errors['user_id'] = "Please Select user";
        }
        if (!isset($data['body']) || !$data['body']){
            $errors['body'] = "Body is required";
        }
        if (!isset($data['deadline']) || !$data['deadline']){
            $errors['deadline'] = "Expiration date is required";
        }

        return $errors;
    }

    public function changeStatus($id)
    {
        $requestData = \Helper::getRequestData();
        $taskModel = new Task();
        $taskModel->changeStatus($id,$requestData['status']);
    }
}