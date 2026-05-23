<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'full_name' => 'required|max_length[255]',
            'phone'     => 'permit_empty|max_length[20]',
            'role'      => 'required|in_list[admin,manager,staff]',
            'status'    => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $model->save([
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'),
            'full_name' => $this->request->getPost('full_name'),
            'phone'     => $this->request->getPost('phone'),
            'role'      => $this->request->getPost('role'),
            'status'    => $this->request->getPost('status'),
        ]);

        return redirect()->to('/users')->with('message', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);

        if (! $data['user']) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        return view('users/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'username'  => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'email'     => "required|valid_email|is_unique[users.email,id,{$id}]",
            'full_name' => 'required|max_length[255]',
            'phone'     => 'permit_empty|max_length[20]',
            'role'      => 'required|in_list[admin,manager,staff]',
            'status'    => 'required|in_list[active,inactive]',
        ];

        $password = $this->request->getPost('password');
        if (! empty($password)) {
            $rules['password'] = 'min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = [
            'id'        => $id,
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'phone'     => $this->request->getPost('phone'),
            'role'      => $this->request->getPost('role'),
            'status'    => $this->request->getPost('status'),
        ];

        if (! empty($password)) {
            $data['password'] = $password;
        }

        $model->save($data);

        return redirect()->to('/users')->with('message', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/users')->with('message', 'User berhasil dihapus.');
    }
}
