<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaskFormStoreRequest;
use App\Http\Requests\TaskFormUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * @param TaskFormStoreRequest $request
     * @return JsonResponse
     */
    public function store(TaskFormStoreRequest $request)
    {
        $task = new Task();
        return response()->json([
            'object' => $task->store($request)
        ], 200);
    }

    /**
     * @param $taskId
     * @param TaskFormUpdateRequest $request
     * @return JsonResponse
     */
    public function update($taskId, TaskFormUpdateRequest $request)
    {
        $task = Task::find($taskId);
        return response()->json([
            'object' => $task->updateTask($task, $request)
        ], 200);
    }

    /**
     * @param $taskId
     * @return JsonResponse
     */
    public function destroy($taskId)
    {
        Task::destroy($taskId);
        return response()->json([
            'object' => 'Task success deleted'
        ], 200);
    }

    /**
     * @param $taskId
     * @param TaskFormUpdateRequest $request
     * @return JsonResponse
     */
    public function updateStatusTask($taskId, TaskFormUpdateRequest $request)
    {
        $task = Task::find($taskId);
        return response()->json([
            'object' => $task->update(['status' => $request->status ? $request->status : $task->status])
        ], 200);
    }

    /**
     * @param $taskId
     * @param TaskFormUpdateRequest $request
     * @return JsonResponse
     */
    public function updateUsersTask($taskId, TaskFormUpdateRequest $request)
    {
        $task = Task::find($taskId);
        return response()->json([
            'object' => $task->update(['user_id' => $request->user_id ? $request->user_id : $task->user_id])
        ], 200);
    }

    /**
     * @param TaskFormUpdateRequest $request
     * @return JsonResponse
     */
    public function getTaskList(TaskFormUpdateRequest $request)
    {
        $task = Task::getTaskList($request);
        return response()->json([
            'object' => $task
        ], 200);
    }
}

