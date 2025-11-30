<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\EventModel;
use App\Models\NetworkLogModel;
use App\Models\SystemSettingModel;
use CodeIgniter\Controller;

class Students extends Controller
{
    public function __construct()
    {
        helper(['url', 'session', 'network']);
    }

    private function ensureLoggedIn()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login')->send();
        }
    }

    public function index()
    {
        $this->ensureLoggedIn();

        $model = new StudentModel();
        $settingModel = new SystemSettingModel();
        $setting = $settingModel->first();
        $system_mode = $setting['system_mode'] ?? 'online';

        $data = [
            'students' => $model->orderBy('id', 'DESC')->findAll(),
            'system_mode' => $system_mode
        ];

        logNetworkActivity('Viewed Students List');
        return view('students/index', $data);
    }

    public function create()
    {
        $this->ensureLoggedIn();
        logNetworkActivity('Opened Create Student Form');
        return view('students/create');
    }

    public function store()
    {
        $this->ensureLoggedIn();
        $model = new StudentModel();

        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'course' => $this->request->getPost('course'),
            'year' => $this->request->getPost('year'),
            'status' => 'Not Paid',
            'payment_for' => null
        ];

        $model->insert($data);
        logNetworkActivity("Added student: {$data['fullname']}");

        session()->setFlashdata('success', '✅ Student added successfully!');
        return redirect()->to('/students');
    }

    public function edit($id)
    {
        $this->ensureLoggedIn();
        $model = new StudentModel();
        $student = $model->find($id);

        if (!$student) {
            session()->setFlashdata('error', '⚠️ Student not found.');
            return redirect()->to('/students');
        }

        logNetworkActivity("Opened Edit for Student ID: {$id}");
        return view('students/edit', ['student' => $student]);
    }

    public function update($id)
    {
        $this->ensureLoggedIn();
        $model = new StudentModel();

        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'course' => $this->request->getPost('course'),
            'year' => $this->request->getPost('year'),
            'status' => $this->request->getPost('status'),
            'payment_for' => $this->request->getPost('payment_for')
        ];

        $model->update($id, $data);
        logNetworkActivity("Updated Student ID: {$id}");

        session()->setFlashdata('success', '✅ Student updated successfully!');
        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $this->ensureLoggedIn();
        $model = new StudentModel();
        $model->delete($id);

        logNetworkActivity("Deleted Student ID: {$id}");

        session()->setFlashdata('success', '🗑️ Student deleted successfully!');
        return redirect()->to('/students');
    }

    public function markPaid()
    {
        $this->ensureLoggedIn();
        $model = new StudentModel();

        $fullname = $this->request->getPost('fullname');
        $paymentFor = $this->request->getPost('payment_for');
        $student = $model->where('fullname', $fullname)->first();

        if ($student) {
            $model->update($student['id'], [
                'status' => 'Paid',
                'payment_for' => $paymentFor
            ]);

            logNetworkActivity("Marked Paid: {$fullname} | For: {$paymentFor}");
            session()->setFlashdata('success', "✅ Payment recorded for {$fullname} ({$paymentFor})");
        } else {
            session()->setFlashdata('error', '❌ Student not found.');
        }

        return redirect()->to('/students/bill-clearance');
    }

    public function billClearance()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->findAll();

        logNetworkActivity('Opened Bill Clearance Page');
        return view('student_home', $data);
    }

    public function networkLogs()
    {
        $logModel = new NetworkLogModel();
        $settingModel = new SystemSettingModel();

        $data['logs'] = $logModel->orderBy('id', 'DESC')->findAll();
        $data['system_mode'] = $settingModel->first()['system_mode'] ?? 'online';

        logNetworkActivity('Viewed Network Logs');
        return view('network_logs', $data);
    }
}
