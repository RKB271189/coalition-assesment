<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService) {}
    public function create(CreateTask $request)
    {
        try {
            $params = $request->only('project_id', 'name');
            $priority = 1;
            $lastPriority = $this->taskService->getLastestRecord();
            if ($lastPriority) {
                $priority = ($lastPriority->priority) + 1;
            }
            $params['priority'] = $priority;
            $this->taskService->createCollection($params);
            return response()->json(['message' => 'Task added sucessfully'], 200);
        } catch (Exception $ex) {
            Log::channel('user_exception_log')->error($ex->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function fetch()
    {
        try {
            $details = $this->taskService->getTaskWithProject();
            $tasks = TaskResource::collection($details);
            return response()->json(['tasks' => $tasks], 200);
        } catch (Exception $ex) {
            Log::channel('user_exception_log')->error($ex->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
