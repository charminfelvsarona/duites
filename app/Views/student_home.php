<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Bill Clearance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e9f3ff, #cfdfff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #0d6efd;
        }
        .hero-section {
            padding: 60px 20px;
            text-align: center;
            color: #0d6efd;
        }
        .form-section {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 550px;
            margin: auto;
        }
        footer {
            margin-top: auto;
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">
            <i class="bi bi-bank2"></i> Student Billing System
        </span>

        <a href="<?= base_url('logout') ?>" class="btn btn-light btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>

<section class="hero-section">
    <h1>Clearance Payment Form</h1>
    <p class="lead">Submit information to mark your payment as <strong>PAID ✅</strong></p>
</section>

<div class="container mb-5">
    <div class="form-section">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php elseif(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('billing/markPaid') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Ex. Kimberly Duites" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course" class="form-control" placeholder="Ex. BSIT 4A" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year Level</label>
                <input type="text" name="year" class="form-control" placeholder="Ex. 4th Year" required>
            </div>

            <!-- ✅ Dynamic Payment List -->
            <div class="mb-3">
                <label class="form-label">Payment For</label>
                <select name="payment_for" class="form-select" required>
                    <option value="">-- Select Event / Payment Type --</option>
                    <?php if(!empty($events)): ?>
                        <?php foreach ($events as $event): ?>
                            <option value="<?= $event['event_name'] ?>">
                                <?= esc($event['event_name']) ?> - ₱<?= number_format($event['price']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled>No payments available</option>
                    <?php endif; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-check2-circle"></i> Mark as Paid
            </button>

        </form>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> Student Billing System | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
