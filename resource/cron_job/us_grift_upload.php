<?php
    /* check if this file is already open */
    if (file_get_contents("../globals/global-us.var") != "1") {

        /* set max execution time to 5m due to script nature */
        ini_set('max_execution_time', 300);
        ini_set("log_errors", 1);
        ini_set("error_log", "../logs/us_upload.log");

        //require "leaderboard_parser.php";
        //require "logger.php";
        file_put_contents("../globals/global-us.var", "1");

        script_run_us();
    }

    function script_run_us()
    {
        world_upload_log("   Uploading US statistics ...\n");
        $date = time();
        $total_err_value = 0;

        /* UPLOAD SOLO DATA */
        /* hc season */
        $err_value = 0;
        $tmp_b_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-barbarian"), true);
        while ($tmp_b_hc_s['top_level'] == 0 || $tmp_b_hc_s['avg_level'] == 0 || $tmp_b_hc_s['end_level'] == 0) {
            $tmp_b_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-barbarian"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $err_value = 0;
        $tmp_c_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader"), true);
        while ($tmp_c_hc_s['top_level'] == 0 || $tmp_c_hc_s['avg_level'] == 0 || $tmp_c_hc_s['end_level'] == 0) {
            $tmp_c_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_d_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-dh"), true);
        while ($tmp_d_hc_s['top_level'] == 0 || $tmp_d_hc_s['avg_level'] == 0 || $tmp_d_hc_s['end_level'] == 0) {
            $tmp_d_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-dh"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_m_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-monk"), true);
        while ($tmp_m_hc_s['top_level'] == 0 || $tmp_m_hc_s['avg_level'] == 0 || $tmp_m_hc_s['end_level'] == 0) {
            $tmp_m_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-monk"), true);
            if ($err_value++ > 5) { $total_err_value++;break; }
        }
        $err_value = 0;
        $tmp_wd_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-wd"), true);
        while ($tmp_wd_hc_s['top_level'] == 0 || $tmp_wd_hc_s['avg_level'] == 0 || $tmp_wd_hc_s['end_level'] == 0) {
            $tmp_wd_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-wd"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wz_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-wizard"), true);
        while ($tmp_wz_hc_s['top_level'] == 0 || $tmp_wz_hc_s['avg_level'] == 0 || $tmp_wz_hc_s['end_level'] == 0) {
            $tmp_wz_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-wizard"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $barbarian_top_hc_season = $tmp_b_hc_s['top_level'];    $barbarian_avg_hc_season = $tmp_b_hc_s['avg_level'];    $barbarian_end_hc_season = $tmp_b_hc_s['end_level'];
        $crusader_top_hc_season = $tmp_c_hc_s['top_level'];     $crusader_avg_hc_season = $tmp_c_hc_s['avg_level'];     $crusader_end_hc_season = $tmp_c_hc_s['end_level'];
        $dh_top_hc_season = $tmp_d_hc_s['top_level'];           $dh_avg_hc_season = $tmp_d_hc_s['avg_level'];           $dh_end_hc_season = $tmp_d_hc_s['end_level'];
        $monk_top_hc_season = $tmp_m_hc_s['top_level'];         $monk_avg_hc_season = $tmp_m_hc_s['avg_level'];         $monk_end_hc_season = $tmp_m_hc_s['end_level'];
        $wd_top_hc_season = $tmp_wd_hc_s['top_level'];          $wd_avg_hc_season = $tmp_wd_hc_s['avg_level'];          $wd_end_hc_season = $tmp_wd_hc_s['end_level'];
        $wizard_top_hc_season = $tmp_wz_hc_s['top_level'];      $wizard_avg_hc_season = $tmp_wz_hc_s['avg_level'];      $wizard_end_hc_season = $tmp_wz_hc_s['end_level'];

        $query = "INSERT INTO us_hardcore_season (
                          date,
                          barbarian_top, crusader_top, dh_top, monk_top, wd_top, wizard_top,
                          barbarian_end, crusader_end, dh_end, monk_end, wd_end, wizard_end,
                          barbarian_avg, crusader_avg, dh_avg, monk_avg, wd_avg, wizard_avg)
                      VALUES (
                          '$date',
                          '$barbarian_top_hc_season', '$crusader_top_hc_season', '$dh_top_hc_season', '$monk_top_hc_season', '$wd_top_hc_season', '$wizard_top_hc_season',
                          '$barbarian_end_hc_season', '$crusader_end_hc_season', '$dh_end_hc_season', '$monk_end_hc_season', '$wd_end_hc_season', '$wizard_end_hc_season',
                          '$barbarian_avg_hc_season', '$crusader_avg_hc_season', '$dh_avg_hc_season', '$monk_avg_hc_season', '$wd_avg_hc_season', '$wizard_avg_hc_season') ";

        db_query($query);

        $file = "../../season_01/us/hc_season/";

        file_put_contents($file . "barbarian/barbarian.data", json_encode($tmp_b_hc_s));
        file_put_contents($file . "crusader/crusader.data",   json_encode($tmp_c_hc_s));
        file_put_contents($file . "dh/dh.data",               json_encode($tmp_d_hc_s));
        file_put_contents($file . "monk/monk.data",           json_encode($tmp_m_hc_s));
        file_put_contents($file . "wd/wd.data",               json_encode($tmp_wd_hc_s));
        file_put_contents($file . "wizard/wizard.data",       json_encode($tmp_wz_hc_s));

        world_upload_log("        - hardcore season uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* hc non season */
        $err_value = 0;
        $tmp_b_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-barbarian"), true);
        while ($tmp_b_hc_ns['top_level'] == 0 || $tmp_b_hc_ns['avg_level'] == 0 || $tmp_b_hc_ns['end_level'] == 0) {
            $tmp_b_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-barbarian"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_c_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-crusader"), true);
        while ($tmp_c_hc_ns['top_level'] == 0 || $tmp_c_hc_ns['avg_level'] == 0 || $tmp_c_hc_ns['end_level'] == 0) {
            $tmp_c_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-crusader"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_d_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-dh"), true);
        while ($tmp_d_hc_ns['top_level'] == 0 || $tmp_d_hc_ns['avg_level'] == 0 || $tmp_d_hc_ns['end_level'] == 0) {
            $tmp_d_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-dh"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_m_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-monk"), true);
        while ($tmp_m_hc_ns['top_level'] == 0 || $tmp_m_hc_ns['avg_level'] == 0 || $tmp_m_hc_ns['end_level'] == 0) {
            $tmp_m_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-monk"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wd_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-wd"), true);
        while ($tmp_wd_hc_ns['top_level'] == 0 || $tmp_wd_hc_ns['avg_level'] == 0 || $tmp_wd_hc_ns['end_level'] == 0) {
            $tmp_wd_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-wd"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wz_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-wizard"), true);
        while ($tmp_wz_hc_ns['top_level'] == 0 || $tmp_wz_hc_ns['avg_level'] == 0 || $tmp_wz_hc_ns['end_level'] == 0) {
            $tmp_wz_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-wizard"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $barbarian_top_hc_non_season = $tmp_b_hc_ns['top_level'];   $barbarian_avg_hc_non_season = $tmp_b_hc_ns['avg_level'];   $barbarian_end_hc_non_season = $tmp_b_hc_ns['end_level'];
        $crusader_top_hc_non_season = $tmp_c_hc_ns['top_level'];    $crusader_avg_hc_non_season = $tmp_c_hc_ns['avg_level'];    $crusader_end_hc_non_season = $tmp_c_hc_ns['end_level'];
        $dh_top_hc_non_season = $tmp_d_hc_ns['top_level'];          $dh_avg_hc_non_season = $tmp_d_hc_ns['avg_level'];          $dh_end_hc_non_season = $tmp_d_hc_ns['end_level'];
        $monk_top_hc_non_season = $tmp_m_hc_ns['top_level'];        $monk_avg_hc_non_season = $tmp_m_hc_ns['avg_level'];        $monk_end_hc_non_season = $tmp_m_hc_ns['end_level'];
        $wd_top_hc_non_season = $tmp_wd_hc_ns['top_level'];         $wd_avg_hc_non_season = $tmp_wd_hc_ns['avg_level'];         $wd_end_hc_non_season = $tmp_wd_hc_ns['end_level'];
        $wizard_top_hc_non_season = $tmp_wz_hc_ns['top_level'];     $wizard_avg_hc_non_season = $tmp_wz_hc_ns['avg_level'];     $wizard_end_hc_non_season = $tmp_wz_hc_ns['end_level'];

        $query = "INSERT INTO us_hardcore_non_season (
                          date,
                          barbarian_top, crusader_top, dh_top, monk_top, wd_top, wizard_top,
                          barbarian_end, crusader_end, dh_end, monk_end, wd_end, wizard_end,
                          barbarian_avg, crusader_avg, dh_avg, monk_avg, wd_avg, wizard_avg)
                      VALUES (
                          '$date',
                          '$barbarian_top_hc_non_season', '$crusader_top_hc_non_season', '$dh_top_hc_non_season', '$monk_top_hc_non_season', '$wd_top_hc_non_season', '$wizard_top_hc_non_season',
                          '$barbarian_end_hc_non_season', '$crusader_end_hc_non_season', '$dh_end_hc_non_season', '$monk_end_hc_non_season', '$wd_end_hc_non_season', '$wizard_end_hc_non_season',
                          '$barbarian_avg_hc_non_season', '$crusader_avg_hc_non_season', '$dh_avg_hc_non_season', '$monk_avg_hc_non_season', '$wd_avg_hc_non_season', '$wizard_avg_hc_non_season') ";

        db_query($query);

        $file = "../../season_01/us/hc/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_hc_ns));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_hc_ns));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_hc_ns));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_hc_ns));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_hc_ns));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_hc_ns));

        world_upload_log("        - hardcore non-season uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* sc season */
        $err_value = 0;
        $tmp_b_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-barbarian"), true);
        while ($tmp_b_sc_s['top_level'] == 0 || $tmp_b_sc_s['avg_level'] == 0 || $tmp_b_sc_s['end_level'] == 0) {
            $tmp_b_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-barbarian"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_c_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-crusader"), true);
        while ($tmp_c_sc_s['top_level'] == 0 || $tmp_c_sc_s['avg_level'] == 0 || $tmp_c_sc_s['end_level'] == 0) {
            $tmp_c_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-crusader"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_d_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-dh"), true);
        while ($tmp_d_sc_s['top_level'] == 0 || $tmp_d_sc_s['avg_level'] == 0 || $tmp_d_sc_s['end_level'] == 0) {
            $tmp_d_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-dh"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_m_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-monk"), true);
        while ($tmp_m_sc_s['top_level'] == 0 || $tmp_m_sc_s['avg_level'] == 0 || $tmp_m_sc_s['end_level'] == 0) {
            $tmp_m_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-monk"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wd_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-wd"), true);
        while ($tmp_wd_sc_s['top_level'] == 0 || $tmp_wd_sc_s['avg_level'] == 0 || $tmp_wd_sc_s['end_level'] == 0) {
            $tmp_wd_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-wd"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wz_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-wizard"), true);
        while ($tmp_wz_sc_s['top_level'] == 0 || $tmp_wz_sc_s['avg_level'] == 0 || $tmp_wz_sc_s['end_level'] == 0) {
            $tmp_wz_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-wizard"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $barbarian_top_sc_season = $tmp_b_sc_s['top_level'];    $barbarian_avg_sc_season = $tmp_b_sc_s['avg_level'];    $barbarian_end_sc_season = $tmp_b_sc_s['end_level'];
        $crusader_top_sc_season = $tmp_c_sc_s['top_level'];     $crusader_avg_sc_season = $tmp_c_sc_s['avg_level'];     $crusader_end_sc_season = $tmp_c_sc_s['end_level'];
        $dh_top_sc_season = $tmp_d_sc_s['top_level'];           $dh_avg_sc_season = $tmp_d_sc_s['avg_level'];           $dh_end_sc_season = $tmp_d_sc_s['end_level'];
        $monk_top_sc_season = $tmp_m_sc_s['top_level'];         $monk_avg_sc_season = $tmp_m_sc_s['avg_level'];         $monk_end_sc_season = $tmp_m_sc_s['end_level'];
        $wd_top_sc_season = $tmp_wd_sc_s['top_level'];          $wd_avg_sc_season = $tmp_wd_sc_s['avg_level'];          $wd_end_sc_season = $tmp_wd_sc_s['end_level'];
        $wizard_top_sc_season = $tmp_wz_sc_s['top_level'];      $wizard_avg_sc_season = $tmp_wz_sc_s['avg_level'];      $wizard_end_sc_season = $tmp_wz_sc_s['end_level'];

        $query = "INSERT INTO us_softcore_season (
                          date,
                          barbarian_top, crusader_top, dh_top, monk_top, wd_top, wizard_top,
                          barbarian_end, crusader_end, dh_end, monk_end, wd_end, wizard_end,
                          barbarian_avg, crusader_avg, dh_avg, monk_avg, wd_avg, wizard_avg)
                      VALUES (
                          '$date',
                          '$barbarian_top_sc_season', '$crusader_top_sc_season', '$dh_top_sc_season', '$monk_top_sc_season', '$wd_top_sc_season', '$wizard_top_sc_season',
                          '$barbarian_end_sc_season', '$crusader_end_sc_season', '$dh_end_sc_season', '$monk_end_sc_season', '$wd_end_sc_season', '$wizard_end_sc_season',
                          '$barbarian_avg_sc_season', '$crusader_avg_sc_season', '$dh_avg_sc_season', '$monk_avg_sc_season', '$wd_avg_sc_season', '$wizard_avg_sc_season') ";

        db_query($query);

        $file = "../../season_01/us/sc_season/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_sc_s));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_sc_s));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_sc_s));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_sc_s));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_sc_s));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_sc_s));

        world_upload_log("        - softcore season uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* sc non season */
        $err_value = 0;
        $tmp_b_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-barbarian"), true);
        while ($tmp_b_sc_ns['top_level'] == 0 || $tmp_b_sc_ns['avg_level'] == 0 || $tmp_b_sc_ns['end_level'] == 0) {
            $tmp_b_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-barbarian"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_c_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-crusader"), true);
        while ($tmp_c_sc_ns['top_level'] == 0 || $tmp_c_sc_ns['avg_level'] == 0 || $tmp_c_sc_ns['end_level'] == 0) {
            $tmp_c_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-crusader"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_d_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-dh"), true);
        while ($tmp_d_sc_ns['top_level'] == 0 || $tmp_d_sc_ns['avg_level'] == 0 || $tmp_d_sc_ns['end_level'] == 0) {
            $tmp_d_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-dh"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_m_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-monk"), true);
        while ($tmp_m_sc_ns['top_level'] == 0 || $tmp_m_sc_ns['avg_level'] == 0 || $tmp_m_sc_ns['end_level'] == 0) {
            $tmp_m_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-monk"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wd_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-wd"), true);
        while ($tmp_wd_sc_ns['top_level'] == 0 || $tmp_wd_sc_ns['avg_level'] == 0 || $tmp_wd_sc_ns['end_level'] == 0) {
            $tmp_wd_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-wd"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_wz_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-wizard"), true);
        while ($tmp_wz_sc_ns['top_level'] == 0 || $tmp_wz_sc_ns['avg_level'] == 0 || $tmp_wz_sc_ns['end_level'] == 0) {
            $tmp_wz_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-wizard"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $barbarian_top_sc_non_season = $tmp_b_sc_ns['top_level'];   $barbarian_avg_sc_non_season = $tmp_b_sc_ns['avg_level'];   $barbarian_end_sc_non_season = $tmp_b_sc_ns['end_level'];
        $crusader_top_sc_non_season = $tmp_c_sc_ns['top_level'];    $crusader_avg_sc_non_season = $tmp_c_sc_ns['avg_level'];    $crusader_end_sc_non_season = $tmp_c_sc_ns['end_level'];
        $dh_top_sc_non_season = $tmp_d_sc_ns['top_level'];          $dh_avg_sc_non_season = $tmp_d_sc_ns['avg_level'];          $dh_end_sc_non_season = $tmp_d_sc_ns['end_level'];
        $monk_top_sc_non_season = $tmp_m_sc_ns['top_level'];        $monk_avg_sc_non_season = $tmp_m_sc_ns['avg_level'];        $monk_end_sc_non_season = $tmp_m_sc_ns['end_level'];
        $wd_top_sc_non_season = $tmp_wd_sc_ns['top_level'];         $wd_avg_sc_non_season = $tmp_wd_sc_ns['avg_level'];         $wd_end_sc_non_season = $tmp_wd_sc_ns['end_level'];
        $wizard_top_sc_non_season = $tmp_wz_sc_ns['top_level'];     $wizard_avg_sc_non_season = $tmp_wz_sc_ns['avg_level'];     $wizard_end_sc_non_season = $tmp_wz_sc_ns['end_level'];

        $query = "INSERT INTO us_softcore_non_season (
                          date,
                          barbarian_top, crusader_top, dh_top, monk_top, wd_top, wizard_top,
                          barbarian_end, crusader_end, dh_end, monk_end, wd_end, wizard_end,
                          barbarian_avg, crusader_avg, dh_avg, monk_avg, wd_avg, wizard_avg)
                      VALUES (
                          '$date',
                          '$barbarian_top_sc_non_season', '$crusader_top_sc_non_season', '$dh_top_sc_non_season', '$monk_top_sc_non_season', '$wd_top_sc_non_season', '$wizard_top_sc_non_season',
                          '$barbarian_end_sc_non_season', '$crusader_end_sc_non_season', '$dh_end_sc_non_season', '$monk_end_sc_non_season', '$wd_end_sc_non_season', '$wizard_end_sc_non_season',
                          '$barbarian_avg_sc_non_season', '$crusader_avg_sc_non_season', '$dh_avg_sc_non_season', '$monk_avg_sc_non_season', '$wd_avg_sc_non_season', '$wizard_avg_sc_non_season') ";

        db_query($query);

        $file = "../../season_01/us/sc/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_sc_ns));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_sc_ns));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_sc_ns));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_sc_ns));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_sc_ns));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_sc_ns));

        world_upload_log("        - softcore non-season uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* UPLOAD TEAM DATA */
        /* team hc season */
        $err_value = 0;
        $tmp_t2_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-2"), true);
        while ($tmp_t2_hc_s['top_level'] == 0 || $tmp_t2_hc_s['avg_level'] == 0 || $tmp_t2_hc_s['end_level'] == 0) {
            $tmp_t2_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-2"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t3_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-3"), true);
        while ($tmp_t3_hc_s['top_level'] == 0 || $tmp_t3_hc_s['avg_level'] == 0 || $tmp_t3_hc_s['end_level'] == 0) {
            $tmp_t3_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-3"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t4_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-4"), true);
        while ($tmp_t4_hc_s['top_level'] == 0 || $tmp_t4_hc_s['avg_level'] == 0 || $tmp_t4_hc_s['end_level'] == 0) {
            $tmp_t4_hc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-hardcore-team-4"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $query = "INSERT INTO us_hardcore_season_team (
                              date,
                              team_2_top, team_3_top, team_4_top,
                              team_2_avg, team_3_avg, team_4_avg,
                              team_2_end, team_3_end, team_4_end )
                          VALUES (
                              ".$date.",
                              ".$tmp_t2_hc_s['top_level'].", ".$tmp_t3_hc_s['top_level'].", ".$tmp_t4_hc_s['top_level'].",
                              ".$tmp_t2_hc_s['avg_level'].", ".$tmp_t3_hc_s['avg_level'].", ".$tmp_t4_hc_s['avg_level'].",
                              ".$tmp_t2_hc_s['end_level'].", ".$tmp_t3_hc_s['end_level'].", ".$tmp_t4_hc_s['end_level'].") ";

        db_query($query);

        $file = "../../season_01/us/hc_season/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_hc_s));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_hc_s));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_hc_s));

        world_upload_log("        - hardcore season team uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* team hc non season */
        $err_value = 0;
        $tmp_t2_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-2"), true);
        while ($tmp_t2_hc_ns['top_level'] == 0 || $tmp_t2_hc_ns['avg_level'] == 0 || $tmp_t2_hc_ns['end_level'] == 0) {
            $tmp_t2_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-2"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t3_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-3"), true);
        while ($tmp_t3_hc_ns['top_level'] == 0 || $tmp_t3_hc_ns['avg_level'] == 0 || $tmp_t3_hc_ns['end_level'] == 0) {
            $tmp_t3_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-3"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t4_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-4"), true);
        while ($tmp_t4_hc_ns['top_level'] == 0 || $tmp_t4_hc_ns['avg_level'] == 0 || $tmp_t4_hc_ns['end_level'] == 0) {
            $tmp_t4_hc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-hardcore-team-4"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $query = "INSERT INTO us_hardcore_non_season_team (
                              date,
                              team_2_top, team_3_top, team_4_top,
                              team_2_avg, team_3_avg, team_4_avg,
                              team_2_end, team_3_end, team_4_end )
                          VALUES (
                              ".$date.",
                              ".$tmp_t2_hc_ns['top_level'].", ".$tmp_t3_hc_ns['top_level'].", ".$tmp_t4_hc_ns['top_level'].",
                              ".$tmp_t2_hc_ns['avg_level'].", ".$tmp_t3_hc_ns['avg_level'].", ".$tmp_t4_hc_ns['avg_level'].",
                              ".$tmp_t2_hc_ns['end_level'].", ".$tmp_t3_hc_ns['end_level'].", ".$tmp_t4_hc_ns['end_level'].") ";

        db_query($query);

        $file = "../../season_01/us/hc/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_hc_ns));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_hc_ns));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_hc_ns));

        world_upload_log("        - hardcore non-season team uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* team sc season */
        $err_value = 0;
        $tmp_t2_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-2"), true);
        while ($tmp_t2_sc_s['top_level'] == 0 || $tmp_t2_sc_s['avg_level'] == 0 || $tmp_t2_sc_s['end_level'] == 0) {
            $tmp_t2_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-2"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t3_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-3"), true);
        while ($tmp_t3_sc_s['top_level'] == 0 || $tmp_t3_sc_s['avg_level'] == 0 || $tmp_t3_sc_s['end_level'] == 0) {
            $tmp_t3_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-3"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t4_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-4"), true);
        while ($tmp_t4_sc_s['top_level'] == 0 || $tmp_t4_sc_s['avg_level'] == 0 || $tmp_t4_sc_s['end_level'] == 0) {
            $tmp_t4_sc_s = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/season/1/rift-team-4"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $query = "INSERT INTO us_softcore_season_team (
                              date,
                              team_2_top, team_3_top, team_4_top,
                              team_2_avg, team_3_avg, team_4_avg,
                              team_2_end, team_3_end, team_4_end )
                          VALUES (
                              ".$date.",
                              ".$tmp_t2_sc_s['top_level'].", ".$tmp_t3_sc_s['top_level'].", ".$tmp_t4_sc_s['top_level'].",
                              ".$tmp_t2_sc_s['avg_level'].", ".$tmp_t3_sc_s['avg_level'].", ".$tmp_t4_sc_s['avg_level'].",
                              ".$tmp_t2_sc_s['end_level'].", ".$tmp_t3_sc_s['end_level'].", ".$tmp_t4_sc_s['end_level'].") ";

        db_query($query);

        $file = "../../season_01/us/sc_season/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_sc_s));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_sc_s));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_sc_s));

        world_upload_log("        - softcore season team uploaded. Errors: " . $total_err_value . "/6\n");
        $total_err_value = 0;

        /* team sc non season */
        $err_value = 0;
        $tmp_t2_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-2"), true);
        while ($tmp_t2_sc_ns['top_level'] == 0 || $tmp_t2_sc_ns['avg_level'] == 0 || $tmp_t2_sc_ns['end_level'] == 0) {
            $tmp_t2_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-2"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t3_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-3"), true);
        while ($tmp_t3_sc_ns['top_level'] == 0 || $tmp_t3_sc_ns['avg_level'] == 0 || $tmp_t3_sc_ns['end_level'] == 0) {
            $tmp_t3_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-3"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }
        $err_value = 0;
        $tmp_t4_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-4"), true);
        while ($tmp_t4_sc_ns['top_level'] == 0 || $tmp_t4_sc_ns['avg_level'] == 0 || $tmp_t4_sc_ns['end_level'] == 0) {
            $tmp_t4_sc_ns = json_decode(get_stat_json("http://us.battle.net/d3/en/rankings/era/1/rift-team-4"), true);
            if ($err_value++ > 5) { $total_err_value++; break; }
        }

        $query = "INSERT INTO us_softcore_non_season_team (
                              date,
                              team_2_top, team_3_top, team_4_top,
                              team_2_avg, team_3_avg, team_4_avg,
                              team_2_end, team_3_end, team_4_end )
                          VALUES (
                              ".$date.",
                              ".$tmp_t2_sc_ns['top_level'].", ".$tmp_t3_sc_ns['top_level'].", ".$tmp_t4_sc_ns['top_level'].",
                              ".$tmp_t2_sc_ns['avg_level'].", ".$tmp_t3_sc_ns['avg_level'].", ".$tmp_t4_sc_ns['avg_level'].",
                              ".$tmp_t2_sc_ns['end_level'].", ".$tmp_t3_sc_ns['end_level'].", ".$tmp_t4_sc_ns['end_level'].") ";

        db_query($query);

        $file = "../../season_01/us/sc/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_sc_ns));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_sc_ns));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_sc_ns));

        world_upload_log("        - softcore non-season team uploaded. Errors: " . $total_err_value . "/6\n");
        world_upload_log("        Uploading of US statistics done.\n");

    }

?>
