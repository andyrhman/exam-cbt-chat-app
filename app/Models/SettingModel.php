<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'setting_id';
    protected $allowedFields = ['type', 'description'];

    public function updateSystemInformation($data)
    {
        foreach ($data as $type => $description) {
            $this->db->table($this->table)
                     ->where('type', $type)
                     ->update(['description' => $description]);
        }
        session()->setFlashdata('flash_message', 'Data Updated Successfully');
    }

    public function updateSystemLogo()
    {

    }

    public function updateSystemTheme($skin_colour) {
        $data = ['description' => $skin_colour];
    
        return $this->db->table($this->table)
                        ->where('type', 'skin_colour')
                        ->update($data);
    }    
}
