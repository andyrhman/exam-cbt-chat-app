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
            // Check if the file already exists
            if (file_exists($destination)) {
                // Delete the existing file
                unlink($destination);
            }
            // Move the new file to the destination
            $file->move('uploads/teacher_image/', $teacher_id . '.jpg');
        }
    }

    // public function updateTeacherFunction($data, $file)
    // {
    //     $this->db->table($this->table)->where($this->primaryKey, $admin_id)->update($data);

    //     if ($file && $file->isValid() && !$file->hasMoved()) {
    //         $destination = 'uploads/teacher_image/' . $teacher_id . '.jpg';
    //         // Check if the file already exists
    //         if (file_exists($destination)) {
    //             // Delete the existing file
    //             unlink($destination);
    //         }
    //         // Move the new file to the destination
    //         $file->move('uploads/teacher_image/', $teacher_id . '.jpg');
    //     }
    // }

    function selectTeacher()
    {
        $query = $this->db->table('teacher')->get()->getResultArray();
        return $query;
    }
}
