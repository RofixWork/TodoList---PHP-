<?php

namespace App\Models;

class Task extends Model
{
    //create a new tasks
    public function create(string $taskName) : bool
    {
        $query = "INSERT INTO tasks(task_name, created_at) VALUES (:name, now());";

        $statement = $this->db->prepare($query);
        $statement->bindValue(":name", $taskName);
        return $statement->execute();
    }

    //get all tasks
    public function all() : array
    {
        $tasks = $this->db->query("SELECT * FROM tasks ORDER BY updated_at DESC");

        return $tasks->fetchAll();
    }

    //get task by id
    public function find(int $id)
    {
        $statement = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");

        $statement->bindValue(":id", $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch() ?? null;
    }

    //update task data
    public function update(int $id, string $taskName, bool $status) : bool
    {
        $statement = $this->db->prepare("UPDATE tasks SET task_name=:name, updated_at=now(), task_status=:status WHERE id = :id");
        $statement->bindValue(':name', $taskName);
        $statement->bindValue(':status', $status, \PDO::PARAM_BOOL);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    //delete task
    public function delete(int $id) : bool
    {
        $statement = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }
}