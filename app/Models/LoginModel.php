<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function adminLoginFunction($email, $password)
    {
        $query = $this->db->table($this->table)->getWhere(['email' => $email]);
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            
            if (password_verify($password, $row->password)) {
                $session = session();
                $session->set([
                    'login_type' => 'admin',
                    'admin_login' => '1',
                    'admin_id' => $row->admin_id,
                    'login_user_id' => $row->admin_id,
                    'name' => $row->name,
                ]);
    
                return true;
            } else {
                session()->setFlashdata('error_message', 'Invalid Login Detail');
                return false;
            }
        } else {
            session()->setFlashdata('error_message', 'Invalid Login Detail');
            return false;
        }
    }
}
