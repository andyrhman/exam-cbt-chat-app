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
    
        $data = [
            'system_name' => esc($this->request->getPost('system_name')),
            'system_title' => esc($this->request->getPost('system_title')),
            'phone' => esc($this->request->getPost('phone')),
            'currency' => esc($this->request->getPost('currency')),
            'system_email' => esc($this->request->getPost('system_email')),
            'paypal_email' => esc($this->request->getPost('paypal_email')),
            'session' => esc($this->request->getPost('session')),
            'text_align' => esc($this->request->getPost('text_align')),
            'address' => esc($this->request->getPost('address')),
            'footer' => esc($this->request->getPost('footer'))
        ];
    
        $this->systemModel->updateSystemInformation($data);
    
        return redirect()->to(base_url('setting/system_settings'));
    }    

    public function update_logo(){
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }
        
        // Handle the file upload
        $file = $this->request->getFile('userfile');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/logo.png';
            // Check if the file already exists
            if (file_exists($destination)) {
                // Delete the existing file
                unlink($destination);
            }
            // Move the new file to the destination
            $file->move('uploads/', 'logo.png');
            $this->session->setFlashdata('flash_message', 'Logo Updated Successfully');

        }
        return redirect()->to(base_url('setting/system_settings'));

    }
    public function update_theme(){
        
        $skin_colour = esc($this->request->getPost('skin_colour'));

        if ($this->systemModel->updateSystemTheme($skin_colour)) {
            $this->session->setFlashdata('flash_message', 'Theme Updated Successfully');
        }

        return redirect()->to(base_url('setting/system_settings'));
    }

}
