<?php
    function world_upload_log($msg) {
        $log_file_path = "../logs/world_upload.log";
        $date = gmdate("d.m.Y H:i:s", time());
        file_put_contents($log_file_path, "$date: ".$msg, FILE_APPEND | LOCK_EX);
    }
?>