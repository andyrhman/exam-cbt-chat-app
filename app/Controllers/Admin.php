<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class Admin extends Controller
{
    protected $session;
    protected $db;
 
    public function __construct()
    {
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
}
