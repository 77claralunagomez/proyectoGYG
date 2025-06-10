<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name= "viewport" content="width-device-width, initial-scale-1">
        <title>OpticaGyG</title>
        <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" integrity=" " crossorigin="">
        <link href="<?= base_url('assets/css/miestilo.css')?>" rel= "styleesheet">
    
    </head>
    <body>
        <?= view('navbar'); ?>

        <div class="container mt-5">
            <?= $this ->renderSection('content'); ?>
        </div>


        <script src="<?= base_url('assets/js/bootstrap.bundle.js')?>" rel="stylesheet" integrity=" " crossorigin=""></script>
        <script src="<?= base_url('assets/js/toast-eliminar.js')?>" rel="stylesheet" integrity=" " crossorigin=""></script>
    </body>    
</html>
