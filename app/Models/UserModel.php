<?php

namespace App\Models;



class UserModel extends \App\Models\Admin\UserModel
{
    protected $table = 'user';
    protected $allowedFields = ['name', 'email', 'password', 'address'];

    // Validation
    protected $validationRules = [
        'email' => 'valid_email|is_unique[user.email,id,{id}]',
        'password' => 'min_length[6]',
        'name' => 'required',
        'address' => 'required',
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }
}