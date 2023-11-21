<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/all.css">
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/solid.min.css">
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.2-dist/css/bootstrap.css">

</head>

<body class="container">

    <div class="row">
        <?php
        $root = './test/';
        // <a href="?path=' . $path . '/' . $file . '">
        // $path = isset($_GET['path']) ?  $_GET['path'] : './test';
        if (isset($_GET['folder']) && isset($_GET['file'])) {
            $currentDir = empty($_GET['folder']) ? $root : $_GET['folder'];
            $file = $_GET['file'];
        } else
            $file = '';
        $dir = dir($root);
        while ($folder = $dir->read()) {
            $template = '        
            <div class="col">
            <a href="?folder=' . $folder . '&file=' . $file . '">
            <div class="fa ' . (is_dir($dir->path . '/' . $folder) ? 'fa-folder' : 'fa-file') . '  display-1 "></div>
            <div>
            <small class="d-block ">' . $folder . '</small>
            </div>
            </a>
        </div>';
            echo $template;
        }
        ?>
    </div>
</body>

</html>