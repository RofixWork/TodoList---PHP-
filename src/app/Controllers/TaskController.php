<?php

namespace App\Controllers;

use App\Application;
use App\Models\Task;
use App\View;

class TaskController
{
    public function __construct(private Task $task)
    {
    }

    public function index() : View
    {
        return View::make('tasks/index',[
            'tasks' => $this->task->all()
        ]);
    }

    public function create() : View
    {
        return View::make('tasks/create');
    }

    public function store()
    {
        //get task name
        $task_name = $_POST['task_name'] ?? null;

        //check task name field [exist or not]
        if(!$task_name)
        {
            return View::make('tasks/create', [
                'error' => 'please fill data'
            ]);
        }
        //create a new task
        $is_added = $this->task->create($task_name);
        if($is_added)
        {
            $this->redirectWithMessage("Task is Added");
        }
    }

    public function edit()
    {
        //get task id
        $taskId = $_GET["taskId"] ?? null;

        //check task by id [exist or not]
        $task = $this->task->find($taskId);

        //not exist
        if(!$task)
        {
            $this->redirect();
        }

        return View::make('/tasks/edit', ['task' => $task]);
    }

    public function update()
    {
//        check task [exist or not]
        $task_name = $_POST['task_name'] ?? null;
        $task_id = $_POST["task_id"] ?? null;
        $status = array_key_exists('status', $_POST);
        if(!$task_name)
        {
            return View::make('tasks/update', [
                'error' => 'please fill data'
            ]);
        }

        //update
        $is_updated = $this->task->update($task_id, $task_name, $status);

        if($is_updated)
        {
            $this->redirectWithMessage("Task is Updated");
        }
    }

    public function delete() : void
    {
        $taskId = $_GET["taskId"] ?? null;
        if(!$taskId)
        {
           $this->redirect();
        }

        $is_removed = $this->task->delete($taskId);

        if($is_removed)
        {
            $this->redirectWithMessage("Task is Removed");
        }
    }

    private function redirectWithMessage(string $message) : never
    {
        setcookie("message_success", $message, strtotime('+1 second'));

        header('Location: /');
        exit;
    }

    private function redirect() : never
    {
        header('Location: /');
        exit;
    }
}