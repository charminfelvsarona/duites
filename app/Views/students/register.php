<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-success mb-3">Student Registration</h4>

                    <form method="post" action="<?= site_url('student/registerSubmit') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Register</button>
                    </form>

                    <p class="text-center mt-3">
                        Already registered? <a href="<?= site_url('/') ?>">Login</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
