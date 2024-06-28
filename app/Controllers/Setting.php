<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class Setting extends BaseController
{
    
    protected $session;
    protected $db;
    protected $systemModel;
    protected $request;

    public function __construct()
    {
        $this->systemModel = new \App\Models\SettingModel();
        $this->request = service('request');
        $this->db = Config::connect();
        $this->session = session();
    }

    public function system_settings()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $data = [
            'page_name' => 'system_settings',
            'page_title' => get_phrase('System Settings'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function update_settings(){
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $name = esc($this->request->getPost('name'));
        $email = esc($this->request->getPost('email'));
        $phone = esc($this->request->getPost('phone'));

        $admin_id = $this->session->get('admin_id');

        if($this->systemModel->updateSystemInformation()){
            $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        }
        
        return redirect()->to(base_url('setting/system_settings'));
    }
}
