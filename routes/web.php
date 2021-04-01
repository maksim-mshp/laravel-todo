<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/api/tasks/new/{name?}', function ($name) {
    $task = new Task;
    $task->name = $name;
    $task->status = 0;

    $task->save();

    return json_encode(array("state" => "ok"));
});

Route::get('/api/tasks/all', function () {
    $res = array();

    $tasks = Task::all();
    
    foreach ($tasks as $key => $value) {
        array_push($res, array(
            "id" => $value['id'],
            "name" => $value['name'],
            "status" => ($value['state'] ? true : false),
        ));
    }

    return json_encode($res);
});

Route::get('/api/tasks/show/{id?}', function ($id) {
    $res = array();

    $task = Task::find($id);
    
    array_push($res, array(
        "id" => $task['id'],
        "name" => $task['name'],
        "status" => ($task['state'] ? true : false),
    ));

    return json_encode($res);
});

Route::get('/api/tasks/delete/{id?}', function ($id) {
    Task::destroy($id);
    
    return json_encode(array("state" => "ok"));
});