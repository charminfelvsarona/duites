<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>

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
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center"><i class="bi bi-person-lines-fill"></i> Admin Panel</h4>
    <a href="<?= site_url('students') ?>" class="active"><i class="bi bi-people-fill"></i> Students</a>
    <a href="<?= site_url('events') ?>"><i class="bi bi-calendar-event"></i> Events</a>
    <a href="<?= site_url('network/logs') ?>"><i class="bi bi-wifi"></i> Network Logs</a>
    <a href="<?= site_url('/') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>

    <!-- ✅ Maintenance Toggle Form -->
    <form action="<?= site_url('settings/toggleSystemMode') ?>"  class="mt-3 p-2">
        <?= csrf_field() ?>

        <?php if ($system_mode == 'maintenance'): ?>
    <button type="submit" class="btn btn-danger w-100">
        <i class="bi bi-exclamation-octagon"></i> Disable Maintenance
    </button>
    <div class="text-center mt-2">
        <span class="badge bg-warning text-dark">Maintenance Active</span>
    </div>
<?php else: ?>
    <button type="submit" class="btn btn-warning w-100">
        <i class="bi bi-tools"></i> Enable Maintenance
    </button>
    <div class="text-center mt-2">
        <span class="badge bg-success">System Online</span>
    </div>
<?php endif; ?>

    </form>
</div>

<div class="content">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold text-primary mb-0">Student List</h2>
        <a href="<?= site_url('students/create') ?>" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Add Student
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Payment For</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= esc($s['fullname']) ?></td>
            <td><?= esc($s['course']) ?></td>
            <td><?= esc($s['year']) ?></td>
            
            <td><?= esc($s['payment_for'] ?? 'None') ?></td>

            <td class="text-center">
                <?php if ($s['status'] == "Paid"): ?>
                    <span class="badge bg-success">PAID ✅</span>
                <?php else: ?>
                    <span class="badge bg-danger">NOT PAID ❌</span>
                <?php endif; ?>
            </td>

            <td class="text-center">
                <a href="<?= site_url('students/edit/'.$s['id']) ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="<?= site_url('students/delete/'.$s['id']) ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this student?')">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

        </div>
    </div>

</div>

</body>
</html>
