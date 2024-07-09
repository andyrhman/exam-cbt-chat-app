<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Modal extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function popup($data_type, $id)
    {
        $model = null;
        $data = null;

        switch ($data_type) {
            case 'teacher':
                $model = new \App\Models\TeacherModel();
                break;
            // Add more cases for different data types as needed
            // case 'student':
            //     $model = new \App\Models\StudentModel();
            //     break;
            // case 'class':
            //     $model = new \App\Models\ClassModel();
            //     break;
        }

        if ($model) {
            $data = $model->find($id);
        }

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => ucfirst($data_type) . ' not found'], 404);
        }
    }
}
