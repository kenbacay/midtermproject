<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        return view('users/index', [
            'users' => $userModel->findAll(),
        ]);
    }

    public function newUser(): string
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[8]',
            'avatar'    => 'permit_empty|is_image[avatar]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $avatarName = null;
        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/avatars/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            if (! is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Avatar upload folder is not writable.');
            }

            $avatarName = $avatar->getRandomName();
            $avatar->move($uploadPath, $avatarName);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'avatar'     => $avatarName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/users');
    }

    public function edit($id): string
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'User not found'
            );
        }

        return view('users/edit', [
            'user' => $user,
        ]);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'User not found'
            );
        }

        $rules = [
            'username'  => 'required|max_length[50]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'permit_empty|min_length[8]',
            'avatar'    => 'permit_empty|is_image[avatar]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $password = $this->request->getPost('password');

        if (! empty($password)) {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/avatars/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            if (! is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Avatar upload folder is not writable.');
            }

            $avatarName = $avatar->getRandomName();
            $avatar->move($uploadPath, $avatarName);

            $data['avatar'] = $avatarName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }

    public function avatar($filename)
    {
        $filename = basename($filename);
        $filePath = WRITEPATH . 'uploads/avatars/' . $filename;

        if (! is_file($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Avatar not found'
            );
        }

        $mimeType = mime_content_type($filePath)
            ?: 'application/octet-stream';

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setBody(file_get_contents($filePath));
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/users');
    }
}