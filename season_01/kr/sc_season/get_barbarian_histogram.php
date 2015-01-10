<?php
    $path = dirname(__FILE__)."/barbarian/";
    $files = scandir($path, 1);
    $newest_file = $files[0];

    echo "<pre>";
    print_r(json_decode(file_get_contents($path.$newest_file)));
    echo "</pre>";
?>