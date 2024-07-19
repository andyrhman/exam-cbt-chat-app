<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['name', 'email', 'phone', 'sex', 'class_id', 'section_id', 'address', 'password'];

    public function createStudentFunction($data, $file)
    {
        $student_id = $this->insert($data);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/student_image/' . $student_id . '.jpg';
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file->move('uploads/student_image/', $student_id . '.jpg');
        }
    }

    public function updateStudentFunction($id, $data, $file)
    {
        $this->update($id, $data);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/student_image/' . $id . '.jpg';
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file->move('uploads/student_image/', $id . '.jpg');
        }
    }

    public function deleteStudentFunction($id)
    {
        $this->delete($id);

        $destination = 'uploads/student_image/' . $id . '.jpg';
        if (file_exists($destination)) {
            unlink($destination);
        }
    }

    public function selectStudent()
    {
        $query = $this->db->table('student')->get()->getResultArray();
        return $query;
    }
}
