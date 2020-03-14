<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormStoreRequest;
use App\Http\Requests\UserFormUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param UserFormStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserFormStoreRequest $request)
    {
        $user = new User();
        return response()->json([
            'object' => $user->store($request)
        ], 200);
    }

    /**
     * @param $userId
     * @param UserFormUpdateRequest $request
     * @return JsonResponse
     */
    public function update($userId, UserFormUpdateRequest $request)
    {
        $user = User::getUserById($userId);
        return response()->json([
            'object' => $user->updateUser($user, $request)
        ], 200);
    }

    /**
     * @param $userId
     * @return JsonResponse
     */
    public function destroy($userId)
    {
        User::destroy($userId);
        return response()->json([
            'object' => 'User success deleted'
        ], 200);
    }

    /**
     * @return JsonResponse
     */
    public function getUsersList()
    {
        return response()->json([
            'object' => User::all()
        ], 200);
    }
}
