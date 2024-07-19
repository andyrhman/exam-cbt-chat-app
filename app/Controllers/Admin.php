<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use App\Models\AdminModel;
use App\Models\CrudModel;
use App\Models\ClassModel;
use App\Models\TeacherModel;
use App\Models\SectionModel;
use App\Models\SubjectModel;

class Admin extends Controller
{
    protected $session;
    protected $db;
    protected $adminModel;
    protected $request;
    protected $crudModel;
    protected $classModel;
    protected $teacherModel;
    protected $sectionModel;
    protected $subjectModel;


    public function __construct()
    {
        $this->crudModel = new CrudModel();
        $this->adminModel = new AdminModel();
        $this->classModel = new ClassModel();
        $this->teacherModel = new TeacherModel();
        $this->sectionModel = new SectionModel();
        $this->subjectModel = new SubjectModel();
        $this->request = service('request');
        $this->db = Config::connect();
        $this->session = session();
    }

    public function index()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }
        if ($this->session->get('admin_login') == 1) {
            return redirect()->to(base_url('admin/dashboard'));
        }
    }

    public function dashboard()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();
        $system_title = $query->description;

        $data = [
            'page_name' => 'dashboard',
            'page_title' => get_phrase('Admin Dashboard'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function manage_profile()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $data = [
            'page_name' => 'manage_profile',
            'page_title' => get_phrase('Admin Dashboard'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title
        ];

        return view('backend/index', $data);
    }

    public function update_profile()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $name = esc($this->request->getPost('name'));
        $email = esc($this->request->getPost('email'));
        $phone = esc($this->request->getPost('phone'));

        $admin_id = $this->session->get('admin_id');

        // Update admin information in the database
        $this->adminModel->updateAdminInformation($admin_id, $name, $email, $phone);

        // Handle the file upload
        $file = $this->request->getFile('userfile');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $destination = 'uploads/admin_image/' . $admin_id . '.jpg';
            // Check if the file already exists
            if (file_exists($destination)) {
                // Delete the existing file
                unlink($destination);
            }
            // Move the new file to the destination
            $file->move('uploads/admin_image/', $admin_id . '.jpg');
        }

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/manage_profile'));
    }

    public function update_password()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        $admin_id = $this->session->get('admin_id');

        // Update admin information in the database
        $this->adminModel->changeAdminPasswordInformation($admin_id, $password, $confirm_password);

        return redirect()->to(base_url('admin/manage_profile'));
    }

    public function manage_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;
        $classes = $this->classModel->selectClass();

        $data = [
            'page_name' => 'class',
            'page_title' => get_phrase('Manage Class'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'classes' => $classes
        ];

        return view('backend/index', $data);
    }

    public function create_class()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'name_numeric' => esc($this->request->getPost('name_numeric')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->classModel->createClassFunction($data);

        $this->session->setFlashdata('success_message', 'Data Created Successfully');

        return redirect()->to(base_url('admin/classes'));
    }

    public function update_class($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'name_numeric' => esc($this->request->getPost('name_numeric')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->classModel->updateClassFunction($id, $data);

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/classes'));
    }

    public function delete_class($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->classModel->deleteClassFunction($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/classes'));
    }

    public function manage_teacher()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $teacherModel = new TeacherModel();
        $teachers = $teacherModel->selectTeacher();

        $data = [
            'page_name' => 'teacher',
            'page_title' => get_phrase('Manage Teacher'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'teachers' => $teachers
        ];

        return view('backend/index', $data);
    }

    public function create_teacher()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'email' => esc($this->request->getPost('email')),
            'phone' => esc($this->request->getPost('phone'))
        ];

        $file = $this->request->getFile('userfile');
        $this->teacherModel->createTeacherFunction($data, $file);

        $this->session->setFlashdata('flash_message', 'Data Added Successfully');
        return redirect()->to(base_url('admin/teacher'));
    }

    public function update_teacher($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'email' => esc($this->request->getPost('email')),
            'phone' => esc($this->request->getPost('phone'))
        ];

        $file = $this->request->getFile('userfile');
        $this->teacherModel->updateTeacherFunction($id, $data, $file);

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/teacher'));
    }

    public function delete_teacher($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->teacherModel->deleteTeacherFunction($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/teacher'));
    }

    public function manage_section()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;
        $sections = $this->sectionModel->selectSection();

        $data = [
            'page_name' => 'section',
            'page_title' => get_phrase('Manage Section'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'sections' => $sections
        ];

        return view('backend/index', $data);
    }

    public function create_section()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'name_numeric' => esc($this->request->getPost('name_numeric')),
            'class_id' => esc($this->request->getPost('class_id')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->sectionModel->createSectionFunction($data);

        $this->session->setFlashdata('flash_message', 'Data Added Successfully');
        return redirect()->to(base_url('admin/section'));
    }

    public function update_section($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'name_numeric' => esc($this->request->getPost('name_numeric')),
            'class_id' => esc($this->request->getPost('class_id')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->sectionModel->updateSectionFunction($id, $data);

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/section'));
    }

    public function delete_selection($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->sectionModel->deleteSectionFunction($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/section'));
    }

    public function manage_subject()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;
        $subjects = $this->subjectModel->selectSubject();

        $data = [
            'page_name' => 'subject',
            'page_title' => get_phrase('Manage Subject'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'subjects' => $subjects
        ];

        return view('backend/index', $data);
    }

    public function create_subject()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'class_id' => esc($this->request->getPost('class_id')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->subjectModel->createSubjectFunction($data);

        $this->session->setFlashdata('flash_message', 'Data Added Successfully');
        return redirect()->to(base_url('admin/subject'));
    }

    public function update_subject($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'class_id' => esc($this->request->getPost('class_id')),
            'teacher_id' => esc($this->request->getPost('teacher_id'))
        ];

        $this->subjectModel->updateSubjectFunction($id, $data);

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/subject'));
    }

    public function delete_subject($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->subjectModel->deleteSubjectFunction($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/subject'));
    }

    public function get_all_teachers()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $teachers = $this->teacherModel->findAll();

        return $this->response->setJSON($teachers);
    }

    public function get_all_classes()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $classes = $this->classModel->findAll();

        return $this->response->setJSON($classes);
    }
}
