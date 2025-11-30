<!DOCTYPE html>
<html>
<head>
    <title>Print Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="p-4">
    <h2 class="text-center mb-4">Student List</h2>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Course</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= esc($row['fullname']) ?></td>
                    <td><?= esc($row['course']) ?></td>
                    <td><?= esc($row['year']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-center mt-3 no-print">
        <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
        <a href="<?= site_url('students') ?>" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
