<?php
    header('Content-Type: application/download');
    header('Content-Disposition: attachment; filename="app.apk"');
    header("Content-Length: " . filesize("app.apk"));

    $fp = fopen("app.apk", "r");
    fpassthru($fp);
    fclose($fp);
?>