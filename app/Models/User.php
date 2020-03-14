<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * store User
     *
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $user = $this->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return $user;
    }

    /**
     * update User
     *
     * @param $user
     * @param $request
     * @return bool
     */
    public function updateUser($user, $request)
    {
        $user = $this->update([
            'first_name' => $request->first_name ? $request->first_name : $user->first_name,
            'last_name' => $request->last_name ? $request->last_name : $user->last_name,
            'email' => $request->email ? $request->email : $user->email,
            'password' => bcrypt($request->password) ? bcrypt($request->password) : $user->password,
        ]);
        return $user;
    }

    /**
     * Get user by id
     *
     * @param int $userId
     * @return mixed
     */
    public static function getUserById(int $userId)
    {
        return self::where('id', $userId)->first();
    }

    /**
     * Get user by email
     *
     * @param string $email
     * @return mixed
     */
    public static function getUserByEmail(string $email)
    {
        return self::where('email', $email)->firstOrFail();
    }

}
