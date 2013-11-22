<?php
    // or however you get the path
    $yourfile = "zipfolder/".$_GET['zipfile'];
    $file_name = basename($yourfile);
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Length: " . filesize($yourfile));
    readfile($yourfile);
    exit;
?>