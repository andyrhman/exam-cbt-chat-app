<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        $session = session();
        if ($session->get('admin_login') == 1) {
            return redirect()->to(base_url('admin/d'));
        }

        return view('backend/login');
    }

    public function check_login()
    {
        $request = service('request');
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        if ($this->loginModel->adminLoginFunction($email, $password)) {
            session()->setFlashdata('flash_message', 'Successfully Login');
            return redirect()->to(base_url('admin/d'));
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}

// ? https://chatgpt.com/share/2822825b-4779-4516-966d-4fe6c9d7a181