<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1">
    <title>OpticaGyG</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" integrity=" " crossorigin="">
    <link href="<?= base_url('assets/css/miestilo.css') ?>" rel="stylesheet">


</head>

<body class="d-flex flex-column min-vh-100 padding-7">

    <?= view('navbar'); ?>

    <main class="flex-grow-1">
        <?= $this->renderSection('content'); ?>
    </main>

    <footer>
        <?= view('footer'); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.js') ?>" rel="stylesheet" integrity=" " crossorigin=""></script>


</body>

</html>