<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NetworkLogModel;

class BillingController extends Controller
{
    public function markPaid()
    {
        $fullname = $this->request->getPost('fullname');
        $course   = $this->request->getPost('course');
        $year     = $this->request->getPost('year');

        $db = \Config\Database::connect();
        $student = $db->table('students')->where([
            'fullname' => $fullname,
            'course'   => $course,
            'year'     => $year
        ])->get()->getRow();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found. Please check your details.');
        }

        // Update student payment status
        $db->table('students')->where('id', $student->id)->update([
            'status'      => 'Paid',
            'payment_for' => $this->request->getPost('payment_for')
        ]);

        // Log billing activity safely
        $logModel = new NetworkLogModel();
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        $mac = 'MAC_NOT_AVAILABLE'; // placeholder since exec() is disabled

        $logModel->insert([
            'user_id'    => $student->id,
            'user_name'  => $student->fullname,
            'action'     => "Marked as Paid ({$student->fullname})",
            'ip_address' => $ip,
            'mac_address'=> $mac,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', "$fullname has been successfully marked as PAID ✅");
    }
}
