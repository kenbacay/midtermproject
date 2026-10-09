<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        // If already logged in, go directly to the dashboard
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

            // Temporary demo account
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

            // Create the login session
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
        // Protect the dashboard
        if (! session('logged_in')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
    }

    public function logout()
    {
        // Remove login-related session values
        session()->remove(['logged_in', 'username']);

        // Create a new session ID
        session()->regenerate(true);

        return redirect()->to('/login');
    }
}