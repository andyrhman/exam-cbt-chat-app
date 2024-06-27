<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $allowedFields = ['name', 'email', 'phone', 'password', 'status'];

    public function __construct()
    {
        parent::__construct();
    }

    public function registerAdmin($data)
    {
        return $this->insert($data);
    }
}
