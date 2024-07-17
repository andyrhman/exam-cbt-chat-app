<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model
{
    protected $table            = 'section';
    protected $primaryKey       = 'section_id';

    protected $allowedFields = ['name', 'name_numeric', 'class_id', 'teacher_id'];

    public function createSectionFunction($data)
    {
        $this->insert($data);
    }

    public function updateSectionFunction($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteSectionFunction($id)
    {
        $this->delete($id);
    }

    public function selectSection()
    {
        $query = $this->db->table('section')->get()->getResultArray();
        return $query;
    }
}
