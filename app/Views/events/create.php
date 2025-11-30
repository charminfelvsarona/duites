<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm mx-auto" style="max-width: 550px;">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-plus-circle"></i> Add New Billing
        </div>

        <div class="card-body">
            <form action="<?= site_url('events/store') ?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Bill name</label>
                    <input type="text" name="event_name" class="form-control" required placeholder="e.g., Foundation Day Fee">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (₱)</label>
                    <input type="number" name="price" class="form-control" required min="1" placeholder="e.g., 250">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('events') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-success">
                        <i class="bi bi-save"></i> Save Bill
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

</body>
</html>
