<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
  
    public function index()
    {
        return response(Task::all()->jsonSerialize(), response::HTTP_OK);
    }


    public function create(Generator $faker)
    {
        $task = new Task();
        $task->title = $faker->sentence(1);
        $task->priority = $faker->boolean ? 'low' : 'high';        
        $task->save();

        return response($task->jsonSerialize(), response::HTTP_CREATED);
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->priority = $request->priority;        
        $task->save();

        return response($task->jsonSerialize(), response::HTTP_CREATED);
    }


    public function destroy(Task $task)
    {
        Task::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
