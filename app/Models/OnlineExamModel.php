<?php

namespace App\Models;

use CodeIgniter\Model;

class OnlineExamModel extends Model
{
    protected $table            = 'online_exam';
    protected $primaryKey       = 'online_exam_id';
    protected $allowedFields    = ['code', 'title', 'class_id', 'section_id', 'subject_id', 'minimum_percentage', 'instruction', 'exam_date', 'time_start', 'time_end', 'duration', 'running_year'];

    public function createOnlineExam($data)
    {
        $this->insert($data);
    }

    public function updateOnlineExam($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteOnlineExam($id)
    {
        $this->delete($id);
    }
    
    public function selectOnlineExams()
    {
        $query = $this->db->table($this->table)->get()->getResultArray();
        return $query;
    }
}
