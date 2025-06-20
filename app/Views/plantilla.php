<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name= "viewport" content="width-device-width, initial-scale-1">
        <title>OpticaGyG</title>
        <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" integrity=" " crossorigin="">
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

        <script src="<?= base_url('assets/js/jquery.min.js')?>" rel="stylesheet" integrity=" " crossorigin="">  </script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.js')?>" rel="stylesheet" integrity=" " crossorigin=""></script>
        <script src="<?= base_url('assets/js/toast-eliminar.js')?>" rel="stylesheet" integrity=" " crossorigin=""></script>
    
    </body>    
</html>
