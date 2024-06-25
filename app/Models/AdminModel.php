<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'admin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    public function updateAdminInformation($admin_id, $name, $email, $phone)
    {
        $page_data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];

        return $this->db->table($this->table)->where($this->primaryKey, $admin_id)->update($page_data);
    }

    public function select_admin_information_from_admin_table() {
        $session = session();
        $admin_id = $session->get('admin_id');
        return $this->where('admin_id', $admin_id)->findAll();
    }

    public function changeAdminPasswordInformation()
    {
        // Implement the method for changing admin password information here.
    }
}
