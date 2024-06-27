<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    protected $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
        helper(['url', 'form']);
    }

    public function create()
    {
        $request = service('request');
        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'phone' => $request->getPost('phone'),
            'password' => password_hash($request->getPost('password'), PASSWORD_ARGON2ID),
            'status' => 0  // Default status
        ];

        if ($this->registrationModel->registerAdmin($data)) {
            session()->setFlashdata('success_message', 'Registration Successful');
            return redirect()->to(base_url('admin/manage_profile'));
        } else {
            session()->setFlashdata('error_message', 'Registration Failed');
            return redirect()->to(base_url('admin/manage_profile'));
        }
    }
}
