<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function today(): string
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('welcome', [
            'tasks' => $tasks
        ]);
    }

    public function index(): string
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('tasks/index', [
            'tasks' => $tasks
        ]);
    }
}