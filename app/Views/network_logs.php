<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Logs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { min-height: 100vh; background-color: #f8f9fa; display: flex; }
        .sidebar {
            width: 250px; background-color: #343a40; color: #fff;
            padding-top: 20px; flex-shrink: 0;
        }
        .sidebar a { color:#adb5bd; padding:12px 20px; display:block; text-decoration:none; }
        .sidebar a.active, .sidebar a:hover { background:#495057; color:#fff; }
        .content { flex-grow:1; padding:30px; }
        .table thead { background-color:#0d6efd; color:#fff; }
        .device-id { font-family: monospace; font-size: 0.9em; color: #555; }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center"><i class="bi bi-person-lines-fill"></i> Admin Panel</h4>
    <a href="<?= site_url('students') ?>"><i class="bi bi-people-fill"></i> Students</a>
    <a href="<?= site_url('events') ?>"><i class="bi bi-calendar-event"></i> Events</a>
    <a href="<?= site_url('network/logs') ?>" class="active"><i class="bi bi-wifi"></i> Network Logs</a>
    <a href="<?= site_url('/') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="content">

    <h2 class="fw-bold text-primary mb-4">Network Activity Logs</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>User</th>
                        <th>IP Address</th>
                        <th>Device / MAC</th>
                        <th>Action</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
    <?php if (empty($logs)): ?>
        <tr><td colspan="6" class="text-center text-muted">No logs available.</td></tr>
    <?php else: ?>
        <?php foreach ($logs as $log): ?>
            <?php
                $username = 'Unknown User';
                if (!empty($log['user_name'])) {
                    $username = $log['user_name'];
                } elseif (!empty($log['user_id'])) {
                    $db = \Config\Database::connect();
                    $user = $db->table('users')->where('id', $log['user_id'])->get()->getRow();
                    $username = $user->full_name ?? 'Unknown User';
                } elseif ($log['user_id'] == 0) {
                    $username = 'System';
                }

                $device = $log['mac_address'];
                if (strlen($device) > 17) {
                    $device = 'DEV-' . strtoupper(substr($device, 0, 8));
                }
            ?>
            <tr>
                <td class="text-center"><?= $log['id'] ?></td>
                <td><?= esc($username) ?><br><small class="text-muted">ID: <?= $log['user_id'] ?></small></td>
                <td><?= esc($log['ip_address']) ?></td>
                <td class="device-id"><?= esc($device) ?></td>
                <td><?= esc($log['action']) ?></td>
                <td><?= date("M d, Y h:i A", strtotime($log['created_at'])) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>
