<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $method = strtolower((string) $this->request->getMethod());

        if ($method === 'post') {
            $username = trim($this->request->getPost('username'));
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel
                ->where('username', $username)
                ->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->regenerate();

                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'logged_in' => true,
                ]);

                return redirect()->to('/tasks');
            }

            return view('auth/login', [
                'error' => 'Invalid username or password.'
            ]);
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}