<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MainController extends Controller
{

    public function form()
    {
        return view('form');

    }
    public function getForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
            'confirm_password' => 'required|same:password',

        ]);

        $usersController = new UserController();
        $existingUsers = $usersController->getUsers();
        $newUserData = [
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'confirm_password' => $data['confirm_password'],
        ];
        $userExists = false;
        foreach ($existingUsers as $user) {
            if ($user['email'] === $newUserData['email']) {
                $userExists = true;
                break;
            }
        }
        if ($userExists) {
            Log::channel('custom')->error('Email вже існує: ' . $newUserData['email']);
            return response()->json(['status' => 'error', 'msg' => 'Email вже існує']);
        }

        if (!$userExists) {
            if ($newUserData['password'] === $newUserData['confirm_password']) {
                $newUser = [
                    'id' => count($existingUsers) + 1,
                    'name' => $newUserData['name'],
                    'surname' => $newUserData['surname'],
                    'email' => $newUserData['email'],
                    'password' => $newUserData['password'],
                    'confirm_password' => $newUserData['confirm_password'],
                ];
                $updatedUsers = $usersController->addUser($newUser);
                $response = [
                    'status' => 'success',
                    'msg' => 'Користувач успішно доданий',
                    'redirect' => '/users',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'msg' =>  'Паролі не співпадають'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'msg' => 'Користувач з таким email вже існує'
            ];
        }
        return response()->json($response);

    }
}
