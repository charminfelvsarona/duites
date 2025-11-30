<?php

namespace App\Controllers;

use App\Models\NetworkLogModel;

class StudentController extends BaseController
{
    public function register()
    {
        return view('student/register');
    }

    public function login()
    {
        return view('student/login');
    }

    public function registerSubmit()
    {
        $db = \Config\Database::connect();

        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'course'   => $this->request->getPost('course'),
            'year'     => $this->request->getPost('year'),
        ];

        $db->table('students')->insert($data);
        $studentId = $db->insertID();

        // ✅ Log registration
        $this->logNetworkActivity($studentId, 'Student Registration', 'student');

        return redirect()->to('student/login')->with('success', 'Registered successfully! Please login.');
    }

    public function loginSubmit()
    {
        $fullname = $this->request->getPost('fullname');
        $course   = $this->request->getPost('course');

        $db = \Config\Database::connect();
        $student = $db->table('students')->where([
            'fullname' => $fullname,
            'course'   => $course
        ])->get()->getRow();

        if (!$student) {
            return redirect()->to('student/login')->with('error', 'Invalid Student Login');
        }

        // ✅ Store session
        session()->set([
            'student_id'   => $student->id,
            'student_name' => $student->fullname
        ]);

        // ✅ Log successful login
        $this->logNetworkActivity($student->id, 'Student Login', 'student');

        return redirect()->to('student_home');
    }
}
