<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $user = $userModel->first();

        return view('profile', [
            'user' => $user
        ]);
    }
}