<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['url', 'session', 'network'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper('url');
        session(); // make sure session is started
    }

    /**
     * ✅ Centralized function to log network activity
     */
    protected function logNetworkActivity($userId, $action, $type = 'student')
    {
        $logModel = new \App\Models\NetworkLogModel();
        $db = \Config\Database::connect();

        // Detect name from student or user table
        $userName = 'Unknown User';
        if ($type === 'student') {
            $student = $db->table('students')->where('id', $userId)->get()->getRow();
            if ($student) {
                $userName = $student->fullname;
            }
        } elseif ($type === 'admin') {
            $admin = $db->table('users')->where('id', $userId)->get()->getRow();
            if ($admin) {
                $userName = $admin->username ?? $admin->full_name;
            }
        }

        // Get IP address
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

        // Try to get MAC (works only in LAN or local testing)
        $mac = 'Unavailable';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec("getmac", $output);
            if (!empty($output)) {
                foreach ($output as $line) {
                    if (preg_match('/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/', $line, $matches)) {
                        $mac = strtoupper(str_replace('-', ':', $matches[0]));
                        break;
                    }
                }
            }
        }

        // ✅ Save log (includes name + IP + MAC)
        $logModel->insert([
            'user_id'     => $userId,
            'user_name'   => $userName,
            'action'      => $action,
            'ip_address'  => $ip,
            'mac_address' => $mac,
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
