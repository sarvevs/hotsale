<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = Cache::get('users');

        if ($users === null) {
            $users = Config::get('users.existingUsers');
            Cache::put('users', $users, 60*60*24);
        }

        return $users;
    }

    public function addUser($newUser)
    {
        $users = $this->getUsers();
        $users[] = $newUser;

        // Обновление данных в кэше
        Cache::put('users', $users, 560);


        return $users;
    }

    public function showUsers()
    {
        $users = $this->getUsers();
        return view('users', compact('users'));
    }
}
