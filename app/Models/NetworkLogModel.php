<?php

namespace App\Models;

use CodeIgniter\Model;

class NetworkLogModel extends Model
{
    protected $table = 'network_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'user_name',   // ✅ ADD THIS
        'action',
        'ip_address',
        'mac_address',
        'created_at'
    ];

    protected $useTimestamps = false; // we insert created_at manually
}
