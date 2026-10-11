<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return $this->response
                ->setStatusCode(302)
                ->setHeader('Location', '/index.php/products');
        }

        if ($this->request->is('post')) {
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $username = trim($this->request->getPost('username'));
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel
                ->where('username', $username)
                ->first();

            if (! $user || ! password_verify($password, $user['password'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid username or password.');
            }

            session()->regenerate();

            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'full_name' => $user['full_name'],
                'avatar'    => $user['avatar'] ?? null,
                'logged_in' => true,
            ]);

            return $this->response
                ->setStatusCode(302)
                ->setHeader('Location', '/index.php/products');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();

        return $this->response
            ->setStatusCode(302)
            ->setHeader('Location', '/index.php/login');
    }
}