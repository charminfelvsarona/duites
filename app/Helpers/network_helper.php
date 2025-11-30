<?php

use App\Models\NetworkLogModel;

if (!function_exists('getUserIP')) {
    function getUserIP()
    {
        return $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['REMOTE_ADDR']
            ?? 'UNKNOWN';
    }
}

if (!function_exists('getMacAddress')) {
    function getMacAddress()
    {
        // exec(), shell_exec(), and ARP lookup are not allowed on most servers.
        // MAC address cannot be obtained from a website.
        // Returning a safe fallback prevents fatal errors.
        return 'MAC_NOT_AVAILABLE';
    }
}

if (!function_exists('logNetworkActivity')) {
    function logNetworkActivity($action)
    {
        $logModel = new NetworkLogModel();

        // Get user data safely
        $user = session()->get('user') ?? session()->get();

        $userId = $user['id']
            ?? $user['student_id']
            ?? 0;

        $userName = $user['username']
            ?? $user['full_name']
            ?? $user['student_name']
            ?? 'Unknown User';

        // Insert log data into database
        $logModel->insert([
            'user_id'     => $userId,
            'user_name'   => $userName,
            'action'      => $action,
            'ip_address'  => getUserIP(),
            'mac_address' => getMacAddress(), // always safe
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
