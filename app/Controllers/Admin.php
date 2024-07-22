<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use App\Models\AdminModel;
use App\Models\CrudModel;
use App\Models\ClassModel;
use App\Models\TeacherModel;
use App\Models\SectionModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use App\Models\OnlineExamModel;


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
    protected $studentModel;
    protected $onlineExamModel;


    public function __construct()
    {
        $this->crudModel = new CrudModel();
        $this->adminModel = new AdminModel();
        $this->classModel = new ClassModel();
        $this->teacherModel = new TeacherModel();
        $this->sectionModel = new SectionModel();
        $this->subjectModel = new SubjectModel();
        $this->studentModel = new StudentModel();
        $this->onlineExamModel = new OnlineExamModel();
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

    public function manage_student()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;

        $studentModel = new StudentModel();
        $students = $studentModel->selectStudent();

        $data = [
            'page_name' => 'student',
            'page_title' => get_phrase('Manage Student'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'students' => $students
        ];

        return view('backend/index', $data);
    }

    public function create_student()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }
        $request = service('request');

        $data = [
            'name' => esc($request->getPost('name')),
            'email' => esc($request->getPost('email')),
            'phone' => esc($request->getPost('phone')),
            'sex' => esc($request->getPost('sex')),
            'class_id' => esc($request->getPost('class_id')),
            'section_id' => esc($request->getPost('section_id')),
            'address' => esc($request->getPost('address')),
            'password' => password_hash($request->getPost('password'), PASSWORD_ARGON2ID)
        ];

        $file = $this->request->getFile('userfile');
        $this->studentModel->createStudentFunction($data, $file);

        $this->session->setFlashdata('flash_message', 'Data Added Successfully');
        return redirect()->to(base_url('admin/student'));
    }

    public function update_student($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'name' => esc($this->request->getPost('name')),
            'email' => esc($this->request->getPost('email')),
            'phone' => esc($this->request->getPost('phone')),
            'sex' => esc($this->request->getPost('sex')),
            'class_id' => esc($this->request->getPost('class_id')),
            'section_id' => esc($this->request->getPost('section_id')),
            'address' => esc($this->request->getPost('address'))
        ];

        $file = $this->request->getFile('userfile');
        $this->studentModel->updateStudentFunction($id, $data, $file);

        $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
        return redirect()->to(base_url('admin/student'));
    }

    public function delete_student($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->studentModel->deleteStudentFunction($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/student'));
    }

    public function create_online_exam()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();

        $system_title = $query->description;
        $subjects = $this->subjectModel->selectSubject();

        $data = [
            'page_name' => 'add_online_exam',
            'page_title' => get_phrase('Online Examination'), // You can replace this with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'subjects' => $subjects
        ];

        return view('backend/index', $data);
    }

    public function manage_online_exam($status = 'active')
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();
        $system_title = $query->description;

        // Fetch the running year from settings
        $running_year = $this->db->table('settings')->getWhere(['type' => 'session'])->getRow()->description;

        // Determine the match condition based on the status
        $match = $status === 'expired' ? ['status' => 'expired', 'running_year' => $running_year] : ['status !=' => 'expired', 'running_year' => $running_year];

        // Fetch online exams with matching criteria
        $online_exams = $this->db->table('online_exam')
            ->where($match)
            ->orderBy('exam_date', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'page_name' => 'manage_online_exam',
            'page_title' => get_phrase('Manage Student'), // Replace with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
            'online_exams' => $online_exams,
            'status' => $status
        ];

        return view('backend/index', $data);
    }

    public function create_exam()
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $request = service('request');

        // Ensure class_id, subject_id, and section_id are not empty
        if (!empty($request->getPost('class_id')) && !empty($request->getPost('subject_id')) && !empty($request->getPost('section_id'))) {
            $exam_date = strtotime($request->getPost('exam_date'));
            $time_start = strtotime($request->getPost('time_start'));
            $time_end = strtotime($request->getPost('time_end'));

            // Calculate duration in seconds
            $duration = $time_end - $time_start;
            $testStatus = 'pending';

            $data = [
                'code' => substr(md5(uniqid(rand(), true)), 0, 7),
                'title' => esc($request->getPost('exam_title')),
                'class_id' => esc($request->getPost('class_id')),
                'section_id' => esc($request->getPost('section_id')),
                'subject_id' => esc($request->getPost('subject_id')),
                'minimum_percentage' => esc($request->getPost('minimum_percentage')),
                'instruction' => esc($request->getPost('instruction')),
                'exam_date' => $exam_date,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'duration' => $duration,
                'status' => $testStatus,
                'running_year' => $this->db->table('settings')->getWhere(['type' => 'session'])->getRow()->description
            ];

            // Assuming the method in your model is named createExam
            $this->onlineExamModel->createOnlineExam($data);

            $this->session->setFlashdata('flash_message', 'Data Added Successfully');
            return redirect()->to(base_url('admin/manage_online_exam'));
        } else {
            $this->session->setFlashdata('flash_message', 'Ensure Class, Subject and Section are selected');
            return redirect()->to(base_url('admin/manage_online_exam'));
        }
    }

    public function update_exam($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $request = service('request');

        // Ensure class_id, subject_id, and section_id are not empty
        if (!empty($request->getPost('class_id')) && !empty($request->getPost('subject_id')) && !empty($request->getPost('section_id'))) {
            $exam_date = strtotime($request->getPost('exam_date'));
            $time_start = strtotime($request->getPost('time_start'));
            $time_end = strtotime($request->getPost('time_end'));

            // Calculate duration in seconds
            $duration = $time_end - $time_start;

            $data = [
                'code' => substr(md5(uniqid(rand(), true)), 0, 7),
                'title' => esc($request->getPost('exam_title')),
                'class_id' => esc($request->getPost('class_id')),
                'section_id' => esc($request->getPost('section_id')),
                'subject_id' => esc($request->getPost('subject_id')),
                'minimum_percentage' => esc($request->getPost('minimum_percentage')),
                'instruction' => esc($request->getPost('instruction')),
                'exam_date' => $exam_date,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'duration' => $duration
            ];

            //?  $id = $request->getPost('online_exam_id');

            // Assuming the method in your model is named createExam
            $this->onlineExamModel->updateOnlineExam($id, $data);

            $this->session->setFlashdata('flash_message', 'Data Updated Successfully');
            return redirect()->to(base_url('admin/manage_online_exam'));
        } else {
            $this->session->setFlashdata('flash_message', 'Ensure Class, Subject and Section are selected');
            return redirect()->to(base_url('admin/manage_online_exam'));
        }
    }

    public function delete_exam($id)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        $this->onlineExamModel->deleteOnlineExam($id);

        $this->session->setFlashdata('flash_message', 'Data Deleted Successfully');
        return redirect()->to(base_url('admin/manage_online_exam'));
    }

    public function manage_online_exam_question($online_exam_id = null, $task = null, $type = null)
    {
        if ($this->session->get('admin_login') != 1) {
            return redirect()->to(base_url('login'));
        }

        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->onlineExamModel->add_mutliple_choice_question_to_online_exam($online_exam_id);
            } else if ($type == 'true_false') {
                $this->onlineExamModel->add_true_false_question_to_online_exam($online_exam_id);
            } elseif ($type == 'fill_in_the_blanks') {
                $this->onlineExamModel->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }

            return redirect()->to(base_url('admin/manage_online_exam_question' . $online_exam_id));
        }

        $query = $this->db->table('settings')->getWhere(['type' => 'system_title'])->getRow();
        $system_title = $query->description;

        $data = [
            'online_exam_id' => $online_exam_id,
            'page_name' => 'manage_online_exam_question',
            'page_title' => $this->db->table('online_exam')->getWhere(['online_exam_id' => $online_exam_id])->getRow()->title, // Replace with the get_phrase() equivalent if necessary
            'system_title' => $system_title,
        ];

        return view('backend/index', $data);
    }

    // public function load_question_type($type, $online_exam_id){
    //     $data = [
    //         'online_exam_id' => $online_exam_id,
    //         'question_type' => $type
    //     ];

    //     return view('backend/admin/online_exam_add_'.$type, $data);
    // }

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

    public function get_class_sections($class_id)
    {
        $sections = $this->db->table('section')->getWhere(['class_id' => $class_id])->getResultArray();
        foreach ($sections as $section) {
            echo '<option value="' . $section['section_id'] . '">' . $section['name'] . '</option>';
        }
    }

    public function get_class_section_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        return view('backend/admin/class_routine_section_subject_selector', $page_data);
    }
}
