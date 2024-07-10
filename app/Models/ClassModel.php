<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table            = 'class';
    protected $primaryKey       = 'class_id';

    protected $allowedFields = ['name', 'name_numeric', 'teacher_id'];

    public function createClassFunction($data)
    {
        $this->insert($data);
    }

    public function updateClassFunction($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteClassFunction($id)
    {
        $this->delete($id);
    }

    public function selectClass()
    {
        $query = $this->db->table('class')->get()->getResultArray();
        return $query;
    }
}
