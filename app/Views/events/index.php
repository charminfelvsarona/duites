<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #eef2f7;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
        }
        .btn-add {
            background: #0d6efd;
            color: #fff;
            border-radius: 8px;
        }
        thead {
            background-color: #0d6efd;
            color: #fff;
        }
        .table td, .table th {
            text-align: center !important;
            vertical-align: middle;
        }
    </style>
</head>
<body class="p-4">

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="bi bi-calendar-event"></i> Event Management
        </h2>

        <div>
            <a href="<?= site_url('students') ?>" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <a href="<?= site_url('events/create') ?>" class="btn btn-add">
                <i class="bi bi-plus-circle"></i> Add Bill
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <i class="bi bi-list-task"></i> List of bill-clearance
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Billing name</th>
                        <th width="150">Price (₱)</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $e): ?>
                    <tr>
                        <td><?= $e['id'] ?></td>
                        <td class="fw-semibold"><?= esc($e['event_name']) ?></td>
                        <td class="fw-bold"><?= number_format($e['price'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-muted py-3">No events available.</td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

</body>
</html>
