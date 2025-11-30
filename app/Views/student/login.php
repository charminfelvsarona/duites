<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-primary mb-3">🎓 Student Login</h4>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url('student/loginSubmit') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login ✅
                        </button>
                    </form>

                    <p class="text-center mt-3">
                        No account? <a href="<?= base_url('student/register') ?>">Register</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
