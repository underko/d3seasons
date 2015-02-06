<?php

    require "logger.php";

    $eu = file_get_contents("../globals/global-eu.var");
    $us = file_get_contents("../globals/global-us.var");
    $kr = file_get_contents("../globals/global-kr.var");

    if ($eu != 1 && $us != 1 && $kr != 1) {
        world_upload_log("----------------------------------------------------------------------------------------------------\n");
        world_upload_log("----------------------------------------------------------------------------------------------------\n");
        world_upload_log("Check of the global variables successful EU: $eu, US: $us, KR: $kr\n");
        world_upload_log("Starting script\n");
        run_script_world();
        exit(0);
    }

    function run_script_world() {
        /* set max execution time to 10m due to script nature */
        ini_set('max_execution_time', 600);
        
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        
        /* require */
        world_upload_log("Requiring additional files ...\n");
            require "leaderboard_parser.php";
            require "../database/dbs_connect.php";
        world_upload_log("All files obtained\n");
        
        world_upload_log("Connecting to database ...\n");
            dbs_connect("b17_15475914_season_01");
        world_upload_log("Connected.\n");
        
        world_upload_log("Starting the world upload ...\n----------------------------------------------------------------------------------------------------\n");
            require "eu_grift_upload.php";
        world_upload_log("EU grift stats upladed.\n----------------------------------------------------------------------------------------------------\n");
            require "us_grift_upload.php";
        world_upload_log("US grift stats upladed.\n----------------------------------------------------------------------------------------------------\n");
            require "kr_grift_upload.php";
        world_upload_log("KR grift stats upladed.\n----------------------------------------------------------------------------------------------------\n");

        world_upload_log("Enabling global variables ... \n");
            file_put_contents("../globals/global-eu.var", "0");
            file_put_contents("../globals/global-us.var", "0");
            file_put_contents("../globals/global-kr.var", "0");
        world_upload_log("World upload finished.\n");
    }

?>
