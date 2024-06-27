<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $session;
    public function __construct()
    {
        parent::__construct();
        $this->session = session();
    }
    public function updateAdminInformation($admin_id, $name, $email, $phone)
    {
        $page_data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];

        return $this->db->table($this->table)->where($this->primaryKey, $admin_id)->update($page_data);
    }

    public function select_admin_information_from_admin_table()
    {
        $admin_id = $this->session->get('admin_id');
        return $this->where('admin_id', $admin_id)->findAll();
    }

    public function changeAdminPasswordInformation($admin_id, $password, $confirm_password)
    {
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_ARGON2ID);
            $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
            return $this->db->table($this->table)->where($this->primaryKey, $admin_id)->update(['password' => $hashed_password]);
        } else {
            $this->session->setFlashdata('error_message', 'Passwords do not match');
            return redirect()->to(base_url('admin/manage_profile'));
        }
    }
}
