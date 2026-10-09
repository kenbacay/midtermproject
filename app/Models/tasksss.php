<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        if (session('logged_in')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[4]'
            ];

            if (! $this->validate($rules)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $correctUsername = 'user';
            $correctPasswordHash = password_hash('user', PASSWORD_DEFAULT);

            if (
                $username !== $correctUsername ||
                ! password_verify($password, $correctPasswordHash)
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Invalid username or password.');
            }


            session()->regenerate(true);

            session()->set([
                'logged_in' => true,
                'username'  => $username
            ]);

            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function dashboard()
    {
        if (! session('logged_in')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
    }

    public function logout()
    {
        session()->remove(['logged_in', 'username']);

        session()->regenerate(true);

        return redirect()->to('/login');
    }
}