<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'employee_id', 'full_name', 'email', 'phone',
        'position', 'department', 'photo', 'hire_date', 'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'employee_id'  => 'required|max_length[50]',
        'full_name'    => 'required|max_length[255]',
        'email'        => 'permit_empty|valid_email|max_length[255]',
        'phone'        => 'permit_empty|max_length[20]',
        'position'     => 'permit_empty|max_length[255]',
        'department'   => 'permit_empty|max_length[255]',
        'hire_date'    => 'permit_empty|valid_date',
        'status'       => 'required|in_list[active,inactive,resigned]',
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
