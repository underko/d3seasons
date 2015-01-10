<?php
    $log_file_path = "../logs/last_run.world";
    $log = "";

    $log .= "Check of the global variables:\n";
    $eu = file_get_contents("../globals/global-eu.var");
    $us = file_get_contents("../globals/global-eu.var");
    $kr = file_get_contents("../globals/global-eu.var");

    $log .= "EU: $eu, US: $us, KR: $kr\n";
    if ($eu == 1 || $us == 1 || $kr == 1) {
        $log .= "Global variable set -> EXITING.\n";
        file_put_contents($log_file_path, $log);
        exit(1);
    }
    else {
        run_script_world($log_file_path, $log);
    }

    function run_script_world($log_file_path, $log) {
        /* set max execution time to 10m due to script nature */
        ini_set('max_execution_time', 600);

        error_reporting(E_ALL);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);

        /* require */
        $log .= "Requiring additional files ...\n";
        require "leaderboard_parser.php";
        require "../database/dbs_connect.php";
        $log .= "All files obtained\n";

        $log .= "Connecting to database ...\n";
        dbs_connect("b17_15475914_season_01");
        $log .= "Connected.\n";

        $log .= "Starting the world upload ...\n";
        $log .= "----------------------------------------------------------------------------------------------------\n";
        require "eu_grift_upload.php";
        $date = gmdate("d.m.Y H:i:s", time());
        $log .= "EU grift stats upladed at $date.\n";
        $log .= "----------------------------------------------------------------------------------------------------\n";
        require "us_grift_upload.php";
        $date = gmdate("d.m.Y H:i:s", time());
        $log .= "US grift stats upladed at $date.\n";
        $log .= "----------------------------------------------------------------------------------------------------\n";
        require "kr_grift_upload.php";
        $date = gmdate("d.m.Y H:i:s", time());
        $log .= "KR grift stats upladed at $date.\n";
        $log .= "----------------------------------------------------------------------------------------------------\n";

        $log .= "Enabling global variables ... \n";
        file_put_contents("../globals/global-eu.var", "0");
        file_put_contents("../globals/global-us.var", "0");
        file_put_contents("../globals/global-kr.var", "0");
        $log .= "World upload finished.\n";

        file_put_contents($log_file_path, $log);
    }
?>