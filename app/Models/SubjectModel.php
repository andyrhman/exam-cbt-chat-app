<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table            = 'subject';
    protected $primaryKey       = 'subject_id';

    protected $allowedFields = ['name', 'class_id', 'teacher_id'];

    public function createSubjectFunction($data)
    {
        $this->insert($data);
    }

    public function updateSubjectFunction($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteSubjectFunction($id)
    {
        $this->delete($id);
    }

    public function selectSubject()
    {
        $query = $this->db->table('subject')->get()->getResultArray();
        return $query;
    }
}
