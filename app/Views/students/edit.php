<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>

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
        /* Sidebar */
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
        /* Content */
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
        <a href="<?= site_url('students') ?>" class="active"><i class="bi bi-people-fill"></i> Students</a>
        <a href="#"><i class="bi bi-book"></i> Events</a>
        
        <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-pencil-square"></i> Edit Student</h2>
            <a href="<?= site_url('students') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= site_url('students/update/'.$student['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="fullname" class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?= esc($student['fullname']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label fw-semibold">Course</label>
                        <input type="text" name="course" id="course" class="form-control" value="<?= esc($student['course']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label fw-semibold">Year</label>
                        <input type="text" name="year" id="year" class="form-control" value="<?= esc($student['year']) ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
