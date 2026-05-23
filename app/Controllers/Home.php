<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Home extends BaseController
{
    public function index(): string
    {
        $employeeModel = new EmployeeModel();
        $data['totalEmployees'] = $employeeModel->countAll();

        return view('dashboard', $data);
    }
}
