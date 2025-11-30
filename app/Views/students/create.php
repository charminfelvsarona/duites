<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .sidebar h4 {
            text-align: center;
            color: #f8f9fa;
            margin-bottom: 1rem;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4><i class="bi bi-person-lines-fill"></i> Admin Panel</h4>
        <a href="<?= site_url('students') ?>"><i class="bi bi-people-fill"></i> Students</a>
        <a href="#"><i class="bi bi-book"></i> Courses</a>
        <a href="#"><i class="bi bi-bar-chart"></i> Reports</a>
        <a href="#"><i class="bi bi-gear"></i> Settings</a>
        <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-person-plus"></i> Add New Student</h2>
            <a href="<?= site_url('students') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- ✅ Notification Alert -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= site_url('students/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="fullname" class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter full name" required>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label fw-semibold">Course</label>
                        <input type="text" name="course" id="course" class="form-control" placeholder="Enter course name" required>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label fw-semibold">Year</label>
                        <input type="text" name="year" id="year" class="form-control" placeholder="Enter year level (e.g. 1st, 2nd, 3rd)" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional Auto-dismiss script -->
    <script>
        // Automatically close alert after 3 seconds
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
</body>
</html>
