<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username'   => 'admin',
            'email'      => 'admin@hris.com',
            'password'   => password_hash('admin', PASSWORD_BCRYPT),
            'full_name'  => 'Administrator',
            'phone'      => '081234567890',
            'role'       => 'admin',
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
