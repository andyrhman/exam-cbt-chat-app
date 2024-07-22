<?php

namespace App\Models;

use CodeIgniter\Model;

class OnlineExamModel extends Model
{
    protected $table            = 'online_exam';
    protected $primaryKey       = 'online_exam_id';
    protected $allowedFields    = ['code', 'title', 'class_id', 'section_id', 'subject_id', 'minimum_percentage', 'instruction', 'exam_date', 'time_start', 'time_end', 'status', 'duration', 'running_year'];

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

    public function add_multiple_choice_question_to_online_exam($online_exam_id)
    {
        // Logic for adding multiple choice question
    }

    public function add_true_false_question_to_online_exam($online_exam_id)
    {
        // Logic for adding true/false question
    }

    public function add_fill_in_the_blanks_question_to_online_exam($online_exam_id)
    {
        // Logic for adding fill in the blanks question
    }
}
