<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status', 'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function users()
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * Create task
     *
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $task = $this->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user_id
        ]);
        return $task;
    }

    /**
     * Update task
     *
     * @param $task
     * @param $request
     * @return bool
     */
    public function updateTask($task, $request)
    {
        $task = $this->update([
            'title' => $request->title ? $request->title : $task->title,
            'description' => $request->description ? $request->description : $task->description,
            'status' => $request->status ? $request->status : $task->status,
            'user_id' => $request->user_id ? $request->user_id : $task->user_id
        ]);
        return $task;
    }

    /**
     * Get task by Id
     *
     * @param $taskId
     * @return mixed
     */
    public static function getTaskById($taskId)
    {
        return self::where('id', $taskId)->first();
    }

    /**
     * Get task list
     *
     * @param $request
     * @return Task[]|Collection
     */
    public static function getTaskList($request)
    {
        $query = self::all();
        if ($request->status) {
            $query = $query->where('status', $request->status);
        }
        $task = $query->sortBy('id');
        return $task;
    }
}
