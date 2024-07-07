<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use App\Models\AdminModel;
use App\Models\CrudModel;
use App\Models\ClassModel;


class Admin extends Controller
{
    protected $session;
    protected $db;
    protected $adminModel;
    protected $request;
    protected $crudModel;
    protected $classModel;


    public function __construct()
    {
        $this->crudModel = new CrudModel();
        $this->adminModel = new AdminModel();
        $this->classModel = new ClassModel();
        $this->request = service('request');
        $this->db = Config::connect();
        $this->session = session();
    }

    public function index()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }
        if ($this->session->get('admin_login') == 1) {
            return redirect()->to(base_url('admin/dashboard'));
        }
    }

    public function dashboard()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();
        $system_title = $query->description;

        $data = [
            'page_name' => 'dashboard',
            'page_title' => get_phrase('Admin Dashboard'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function manage_profile()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $data = [
            'page_name' => 'manage_profile',
            'page_title' => get_phrase('Admin Dashboard'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function update_profile()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $name = esc($this->request->getPost('name'));
        $email = esc($this->request->getPost('email'));
        $phone = esc($this->request->getPost('phone'));

        $admin_id = $this->session->get('admin_id');

        // Update admin information in the database
        $this->adminModel->updateAdminInformation($admin_id, $name, $email, $phone);

        // Handle the file upload
        $file = $this->request->getFile('userfile');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/admin_image/' . $admin_id . '.jpg';
            // Check if the file already exists
            if (file_exists($destination)) {
                // Delete the existing file
                unlink($destination);
            }
            // Move the new file to the destination
            $file->move('uploads/admin_image/', $admin_id . '.jpg');
        }

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/manage_profile'));
    }

    public function update_password()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        $admin_id = $this->session->get('admin_id');

        // Update admin information in the database
        $this->adminModel->changeAdminPasswordInformation($admin_id, $password, $confirm_password);

        return redirect()->to(base_url('admin/manage_profile'));
    }

    public function manage_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $data = [
            'page_name' => 'class',
            'page_title' => get_phrase('Manage Class'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function create_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $request = service('request');
        $data = [
            'name' => $request->getPost('name'),
        ];

        if ($this->classModel->createClassFunction($data)) {
            session()->setFlashdata('success_message', 'Data Created Successfully');
            return redirect()->to(base_url('admin/classes'));
        } else {
            session()->setFlashdata('error_message', 'There is an Error, please try again');
            return redirect()->to(base_url('admin/classes'));
        }
    }

    public function update_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $request = service('request');
        $data = [
            'name' => $request->getPost('name'),
        ];

        if ($this->classModel->updateClassFunction($data)) {
            session()->setFlashdata('success_message', 'Data Updated Successfully');
            return redirect()->to(base_url('admin/classes'));
        } else {
            session()->setFlashdata('error_message', 'There is an Error, please try again');
            return redirect()->to(base_url('admin/classes'));
        }
    }

    public function delete_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $request = service('request');
        // $data = [
        //     'name' => $request->getPost('name'),
        // ];

        if ($this->classModel->deleteClassFunction()) {
            session()->setFlashdata('success_message', 'Data Updated Successfully');
            return redirect()->to(base_url('admin/classes'));
        } else {
            session()->setFlashdata('error_message', 'There is an Error, please try again');
            return redirect()->to(base_url('admin/classes'));
        }
    }
}
