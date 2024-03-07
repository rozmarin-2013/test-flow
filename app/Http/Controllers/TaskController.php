<?php

namespace App\Http\Controllers;

use App\DTO\TaskFilterDTO;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $tasks = $this->taskService->filter(
           new TaskFilterDTO(
               $request->get('status'),
              $request->get('createdAt')
           )
        );

        return TaskResource::collection($tasks->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request): Application|Response|ApplicationContract|ResponseFactory
    {
        $task = Task::create(
            $request->only('name', 'description', 'status')
        );

        return response(new TaskResource($task), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->only('name', 'description', 'status'));

        return response(new TaskResource($task), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
