<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $allowedFields    = ['name', 'email', 'password', 'role', 'address'];

    // Validation
    protected $validationRules      = [
        'name' => 'required',
        'email' => 'valid_email|is_unique[user.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'role' => 'in_list[user,admin]',
        'address' => 'required',
    ];

    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    public function checkPassword($data_password, $user_password): bool
    {
        return password_verify($data_password, $user_password);
    }

    public function setProfile($user)
    {
//        $session = session();

        $user_data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'address' => $user['address'],
            'role' => $user['role'],
        ];
        $_SESSION['user'] = $user_data;
    }

    public static function isAdmin(): bool
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
