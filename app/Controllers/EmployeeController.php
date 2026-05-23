<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    public function index()
    {
        $model = new EmployeeModel();
        $data['employees'] = $model->findAll();
        return view('employees/index', $data);
    }

    public function create()
    {
        return view('employees/create');
    }

    public function store()
    {
        $rules = [
            'employee_id' => 'required|max_length[50]|is_unique[employees.employee_id]',
            'full_name'   => 'required|max_length[255]',
            'email'       => 'required|valid_email|max_length[255]',
            'phone'       => 'required|max_length[20]',
            'position'    => 'required|max_length[255]',
            'department'  => 'required|max_length[255]',
            'hire_date'   => 'required|valid_date',
            'status'      => 'required|in_list[active,inactive,resigned]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $photo = $this->uploadPhoto();
        if ($photo === false) {
            return redirect()->back()->withInput();
        }

        $model = new EmployeeModel();
        $model->save([
            'employee_id' => $this->request->getPost('employee_id'),
            'full_name'   => $this->request->getPost('full_name'),
            'email'       => $this->request->getPost('email'),
            'phone'       => $this->request->getPost('phone'),
            'position'    => $this->request->getPost('position'),
            'department'  => $this->request->getPost('department'),
            'hire_date'   => $this->request->getPost('hire_date'),
            'status'      => $this->request->getPost('status'),
            'photo'       => $photo,
        ]);

        return redirect()->to('/employees')->with('message', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new EmployeeModel();
        $data['employee'] = $model->find($id);

        if (! $data['employee']) {
            return redirect()->to('/employees')->with('error', 'Pegawai tidak ditemukan.');
        }

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'employee_id' => "required|max_length[50]|is_unique[employees.employee_id,id,{$id}]",
            'full_name'   => 'required|max_length[255]',
            'email'       => 'required|valid_email|max_length[255]',
            'phone'       => 'required|max_length[20]',
            'position'    => 'required|max_length[255]',
            'department'  => 'required|max_length[255]',
            'hire_date'   => 'required|valid_date',
            'status'      => 'required|in_list[active,inactive,resigned]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new EmployeeModel();
        $employee = $model->find($id);
        $photo = $employee['photo'];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $newPhoto = $this->uploadPhoto();
            if ($newPhoto === false) {
                return redirect()->back()->withInput();
            }
            if ($photo && file_exists(FCPATH . 'uploads/employees/' . $photo)) {
                unlink(FCPATH . 'uploads/employees/' . $photo);
            }
            $photo = $newPhoto;
        }

        $model->save([
            'id'          => $id,
            'employee_id' => $this->request->getPost('employee_id'),
            'full_name'   => $this->request->getPost('full_name'),
            'email'       => $this->request->getPost('email'),
            'phone'       => $this->request->getPost('phone'),
            'position'    => $this->request->getPost('position'),
            'department'  => $this->request->getPost('department'),
            'hire_date'   => $this->request->getPost('hire_date'),
            'status'      => $this->request->getPost('status'),
            'photo'       => $photo,
        ]);

        return redirect()->to('/employees')->with('message', 'Pegawai berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new EmployeeModel();
        $employee = $model->find($id);

        if ($employee && $employee['photo']) {
            $path = FCPATH . 'uploads/employees/' . $employee['photo'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $model->delete($id);
        return redirect()->to('/employees')->with('message', 'Pegawai berhasil dihapus.');
    }

    private function uploadPhoto()
    {
        $file = $this->request->getFile('photo');

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $mime = $file->getMimeType();
        $allowed = ['image/jpeg', 'image/pjpeg'];
        if (! in_array($mime, $allowed)) {
            session()->setFlashdata('photo_error', 'Format foto harus JPG/JPEG.');
            return false;
        }

        if ($file->getSize() > 300 * 1024) {
            session()->setFlashdata('photo_error', 'Ukuran foto maksimal 300KB.');
            return false;
        }

        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/employees', $newName);

        return $newName;
    }
}
