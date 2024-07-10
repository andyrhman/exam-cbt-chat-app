<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $allowedFields = ['name', 'email', 'phone'];

    public function createTeacherFunction($data, $file)
    {
        $teacher_id = $this->insert($data);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/teacher_image/' . $teacher_id . '.jpg';
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file->move('uploads/teacher_image/', $teacher_id . '.jpg');
        }
    }

    public function updateTeacherFunction($id, $data, $file)
    {
        $this->update($id, $data);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/teacher_image/' . $id . '.jpg';
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file->move('uploads/teacher_image/', $id . '.jpg');
        }
    }

    public function deleteTeacherFunction($id)
    {
        $this->delete($id);

        $destination = 'uploads/teacher_image/' . $id . '.jpg';
        if (file_exists($destination)) {
            unlink($destination);
        }
    }

    public function selectTeacher()
    {
        $query = $this->db->table('teacher')->get()->getResultArray();
        return $query;
    }
}
