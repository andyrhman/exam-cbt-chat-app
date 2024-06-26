<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $DBGroup = 'default';

    public function get_type_name_by_id($type, $type_id = null, $field = 'name')
    {
        $builder = $this->db->table($type);
        $builder->where($type . '_id', $type_id);
        $query = $builder->get();
        $result = $query->getResultArray();

        foreach ($result as $key => $row) {
            return $row[$field];
        }
    }

    public function get_image_url($type = null, $id = null)
    {
        $imagePath = 'uploads/' . $type . '_image/' . $id . '.jpg';
        if (file_exists($imagePath)) {
            return base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        } else {
            return '';  // Return an empty string if the image doesn't exist
        }
        // } else {
        //     $image_url = base_url() . 'uploads/default_image';
        // }
        // return $image_url;
    }
}
