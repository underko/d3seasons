<?php
    /* check if this file is already open */
    if (file_get_contents("../globals/global-eu.var") == "1") {
        echo "EU script already running -> Skipping this one.<br>";
    }
    else {
        echo "First run of the EU script -> Changing global variable.<br>";

        /* set max execution time to 5m due to script nature */
        ini_set('max_execution_time', 300);
        ini_set("log_errors", 1);
        ini_set("error_log", "../logs/eu_upload.log");

        file_put_contents("../globals/global-eu.var", "1");

        script_run_eu();
    }

    function script_run_eu()
    {
        $date = time();
        $log_file = "../logs/log";
        $err_value = 0;
        $log = gmdate("d.m.Y H:i:s", $date);

        /* parsing rankings */
        $log .= "   Uploading EU statistics ...\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);

        /* UPLOAD SOLO DATA */
        /* hc season */
        $tmp_b_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-barbarian"), true);
        while ($tmp_b_hc_s['top_level'] == 0 || $tmp_b_hc_s['avg_level'] == 0 || $tmp_b_hc_s['end_level'] == 0) {
            $tmp_b_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-barbarian"), true);
            $err_value++;
        }

        $tmp_c_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader"), true);
        while ($tmp_c_hc_s['top_level'] == 0 || $tmp_c_hc_s['avg_level'] == 0 || $tmp_c_hc_s['end_level'] == 0) {
            $tmp_c_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader"), true);
            $err_value++;
        }

        $tmp_d_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-dh"), true);
        while ($tmp_d_hc_s['top_level'] == 0 || $tmp_d_hc_s['avg_level'] == 0 || $tmp_d_hc_s['end_level'] == 0) {
            $tmp_d_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-dh"), true);
            $err_value++;
        }

        $tmp_m_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-monk"), true);
        while ($tmp_m_hc_s['top_level'] == 0 || $tmp_m_hc_s['avg_level'] == 0 || $tmp_m_hc_s['end_level'] == 0) {
            $tmp_m_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-monk"), true);
            $err_value++;
        }

        $tmp_wd_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-wd"), true);
        while ($tmp_wd_hc_s['top_level'] == 0 || $tmp_wd_hc_s['avg_level'] == 0 || $tmp_wd_hc_s['end_level'] == 0) {
            $tmp_wd_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-wd"), true);
            $err_value++;
        }

        $tmp_wz_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-wizard"), true);
        while ($tmp_wz_hc_s['top_level'] == 0 || $tmp_wz_hc_s['avg_level'] == 0 || $tmp_wz_hc_s['end_level'] == 0) {
            $tmp_wz_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-wizard"), true);
            $err_value++;
        }

        $barbarian_top_hc_season = $tmp_b_hc_s['top_level'];    $barbarian_avg_hc_season = $tmp_b_hc_s['avg_level'];    $barbarian_end_hc_season = $tmp_b_hc_s['end_level'];
        $crusader_top_hc_season = $tmp_c_hc_s['top_level'];     $crusader_avg_hc_season = $tmp_c_hc_s['avg_level'];     $crusader_end_hc_season = $tmp_c_hc_s['end_level'];
        $dh_top_hc_season = $tmp_d_hc_s['top_level'];           $dh_avg_hc_season = $tmp_d_hc_s['avg_level'];           $dh_end_hc_season = $tmp_d_hc_s['end_level'];
        $monk_top_hc_season = $tmp_m_hc_s['top_level'];         $monk_avg_hc_season = $tmp_m_hc_s['avg_level'];         $monk_end_hc_season = $tmp_m_hc_s['end_level'];
        $wd_top_hc_season = $tmp_wd_hc_s['top_level'];          $wd_avg_hc_season = $tmp_wd_hc_s['avg_level'];          $wd_end_hc_season = $tmp_wd_hc_s['end_level'];
        $wizard_top_hc_season = $tmp_wz_hc_s['top_level'];      $wizard_avg_hc_season = $tmp_wz_hc_s['avg_level'];      $wizard_end_hc_season = $tmp_wz_hc_s['end_level'];

        $query = "INSERT INTO eu_hardcore_season (
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

        $file = "../../season_01/eu/hc_season/";

        file_put_contents($file . "barbarian/barbarian.data", json_encode($tmp_b_hc_s));
        file_put_contents($file . "crusader/crusader.data",   json_encode($tmp_c_hc_s));
        file_put_contents($file . "dh/dh.data",               json_encode($tmp_d_hc_s));
        file_put_contents($file . "monk/monk.data",           json_encode($tmp_m_hc_s));
        file_put_contents($file . "wd/wd.data",               json_encode($tmp_wd_hc_s));
        file_put_contents($file . "wizard/wizard.data",       json_encode($tmp_wz_hc_s));

        $log = "        - hardcore season uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* hc non season */
        $tmp_b_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-barbarian"), true);
        while ($tmp_b_hc_ns['top_level'] == 0 || $tmp_b_hc_ns['avg_level'] == 0 || $tmp_b_hc_ns['end_level'] == 0) {
            $tmp_b_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-barbarian"), true);
            $err_value++;
        }

        $tmp_c_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-crusader"), true);
        while ($tmp_c_hc_ns['top_level'] == 0 || $tmp_c_hc_ns['avg_level'] == 0 || $tmp_c_hc_ns['end_level'] == 0) {
            $tmp_c_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-crusader"), true);
            $err_value++;
        }

        $tmp_d_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-dh"), true);
        while ($tmp_d_hc_ns['top_level'] == 0 || $tmp_d_hc_ns['avg_level'] == 0 || $tmp_d_hc_ns['end_level'] == 0) {
            $tmp_d_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-dh"), true);
            $err_value++;
        }

        $tmp_m_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-monk"), true);
        while ($tmp_m_hc_ns['top_level'] == 0 || $tmp_m_hc_ns['avg_level'] == 0 || $tmp_m_hc_ns['end_level'] == 0) {
            $tmp_m_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-monk"), true);
            $err_value++;
        }

        $tmp_wd_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-wd"), true);
        while ($tmp_wd_hc_ns['top_level'] == 0 || $tmp_wd_hc_ns['avg_level'] == 0 || $tmp_wd_hc_ns['end_level'] == 0) {
            $tmp_wd_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-wd"), true);
            $err_value++;
        }

        $tmp_wz_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-wizard"), true);
        while ($tmp_wz_hc_ns['top_level'] == 0 || $tmp_wz_hc_ns['avg_level'] == 0 || $tmp_wz_hc_ns['end_level'] == 0) {
            $tmp_wz_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-wizard"), true);
            $err_value++;
        }

        $barbarian_top_hc_non_season = $tmp_b_hc_ns['top_level'];   $barbarian_avg_hc_non_season = $tmp_b_hc_ns['avg_level'];   $barbarian_end_hc_non_season = $tmp_b_hc_ns['end_level'];
        $crusader_top_hc_non_season = $tmp_c_hc_ns['top_level'];    $crusader_avg_hc_non_season = $tmp_c_hc_ns['avg_level'];    $crusader_end_hc_non_season = $tmp_c_hc_ns['end_level'];
        $dh_top_hc_non_season = $tmp_d_hc_ns['top_level'];          $dh_avg_hc_non_season = $tmp_d_hc_ns['avg_level'];          $dh_end_hc_non_season = $tmp_d_hc_ns['end_level'];
        $monk_top_hc_non_season = $tmp_m_hc_ns['top_level'];        $monk_avg_hc_non_season = $tmp_m_hc_ns['avg_level'];        $monk_end_hc_non_season = $tmp_m_hc_ns['end_level'];
        $wd_top_hc_non_season = $tmp_wd_hc_ns['top_level'];         $wd_avg_hc_non_season = $tmp_wd_hc_ns['avg_level'];         $wd_end_hc_non_season = $tmp_wd_hc_ns['end_level'];
        $wizard_top_hc_non_season = $tmp_wz_hc_ns['top_level'];     $wizard_avg_hc_non_season = $tmp_wz_hc_ns['avg_level'];     $wizard_end_hc_non_season = $tmp_wz_hc_ns['end_level'];

        $query = "INSERT INTO eu_hardcore_non_season (
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

        $file = "../../season_01/eu/hc/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_hc_ns));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_hc_ns));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_hc_ns));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_hc_ns));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_hc_ns));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_hc_ns));

        $log = "        - hardcore non-season uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* sc season */
        $tmp_b_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-barbarian"), true);
        while ($tmp_b_sc_s['top_level'] == 0 || $tmp_b_sc_s['avg_level'] == 0 || $tmp_b_sc_s['end_level'] == 0) {
            $tmp_b_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-barbarian"), true);
            $err_value++;
        }

        $tmp_c_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-crusader"), true);
        while ($tmp_c_sc_s['top_level'] == 0 || $tmp_c_sc_s['avg_level'] == 0 || $tmp_c_sc_s['end_level'] == 0) {
            $tmp_c_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-crusader"), true);
            $err_value++;
        }

        $tmp_d_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-dh"), true);
        while ($tmp_d_sc_s['top_level'] == 0 || $tmp_d_sc_s['avg_level'] == 0 || $tmp_d_sc_s['end_level'] == 0) {
            $tmp_d_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-dh"), true);
            $err_value++;
        }

        $tmp_m_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-monk"), true);
        while ($tmp_m_sc_s['top_level'] == 0 || $tmp_m_sc_s['avg_level'] == 0 || $tmp_m_sc_s['end_level'] == 0) {
            $tmp_m_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-monk"), true);
            $err_value++;
        }

        $tmp_wd_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-wd"), true);
        while ($tmp_wd_sc_s['top_level'] == 0 || $tmp_wd_sc_s['avg_level'] == 0 || $tmp_wd_sc_s['end_level'] == 0) {
            $tmp_wd_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-wd"), true);
            $err_value++;
        }

        $tmp_wz_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-wizard"), true);
        while ($tmp_wz_sc_s['top_level'] == 0 || $tmp_wz_sc_s['avg_level'] == 0 || $tmp_wz_sc_s['end_level'] == 0) {
            $tmp_wz_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-wizard"), true);
            $err_value++;
        }

        $barbarian_top_sc_season = $tmp_b_sc_s['top_level'];    $barbarian_avg_sc_season = $tmp_b_sc_s['avg_level'];    $barbarian_end_sc_season = $tmp_b_sc_s['end_level'];
        $crusader_top_sc_season = $tmp_c_sc_s['top_level'];     $crusader_avg_sc_season = $tmp_c_sc_s['avg_level'];     $crusader_end_sc_season = $tmp_c_sc_s['end_level'];
        $dh_top_sc_season = $tmp_d_sc_s['top_level'];           $dh_avg_sc_season = $tmp_d_sc_s['avg_level'];           $dh_end_sc_season = $tmp_d_sc_s['end_level'];
        $monk_top_sc_season = $tmp_m_sc_s['top_level'];         $monk_avg_sc_season = $tmp_m_sc_s['avg_level'];         $monk_end_sc_season = $tmp_m_sc_s['end_level'];
        $wd_top_sc_season = $tmp_wd_sc_s['top_level'];          $wd_avg_sc_season = $tmp_wd_sc_s['avg_level'];          $wd_end_sc_season = $tmp_wd_sc_s['end_level'];
        $wizard_top_sc_season = $tmp_wz_sc_s['top_level'];      $wizard_avg_sc_season = $tmp_wz_sc_s['avg_level'];      $wizard_end_sc_season = $tmp_wz_sc_s['end_level'];

        $query = "INSERT INTO eu_softcore_season (
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

        $file = "../../season_01/eu/sc_season/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_sc_s));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_sc_s));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_sc_s));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_sc_s));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_sc_s));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_sc_s));

        $log = "        - softcore season uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* sc non season */
        $tmp_b_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-barbarian"), true);
        while ($tmp_b_sc_ns['top_level'] == 0 || $tmp_b_sc_ns['avg_level'] == 0 || $tmp_b_sc_ns['end_level'] == 0) {
            $tmp_b_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-barbarian"), true);
            $err_value++;
        }

        $tmp_c_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-crusader"), true);
        while ($tmp_c_sc_ns['top_level'] == 0 || $tmp_c_sc_ns['avg_level'] == 0 || $tmp_c_sc_ns['end_level'] == 0) {
            $tmp_c_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-crusader"), true);
            $err_value++;
        }

        $tmp_d_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-dh"), true);
        while ($tmp_d_sc_ns['top_level'] == 0 || $tmp_d_sc_ns['avg_level'] == 0 || $tmp_d_sc_ns['end_level'] == 0) {
            $tmp_d_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-dh"), true);
            $err_value++;
        }

        $tmp_m_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-monk"), true);
        while ($tmp_m_sc_ns['top_level'] == 0 || $tmp_m_sc_ns['avg_level'] == 0 || $tmp_m_sc_ns['end_level'] == 0) {
            $tmp_m_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-monk"), true);
            $err_value++;
        }

        $tmp_wd_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-wd"), true);
        while ($tmp_wd_sc_ns['top_level'] == 0 || $tmp_wd_sc_ns['avg_level'] == 0 || $tmp_wd_sc_ns['end_level'] == 0) {
            $tmp_wd_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-wd"), true);
            $err_value++;
        }

        $tmp_wz_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-wizard"), true);
        while ($tmp_wz_sc_ns['top_level'] == 0 || $tmp_wz_sc_ns['avg_level'] == 0 || $tmp_wz_sc_ns['end_level'] == 0) {
            $tmp_wz_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-wizard"), true);
            $err_value++;
        }

        $barbarian_top_sc_non_season = $tmp_b_sc_ns['top_level'];   $barbarian_avg_sc_non_season = $tmp_b_sc_ns['avg_level'];   $barbarian_end_sc_non_season = $tmp_b_sc_ns['end_level'];
        $crusader_top_sc_non_season = $tmp_c_sc_ns['top_level'];    $crusader_avg_sc_non_season = $tmp_c_sc_ns['avg_level'];    $crusader_end_sc_non_season = $tmp_c_sc_ns['end_level'];
        $dh_top_sc_non_season = $tmp_d_sc_ns['top_level'];          $dh_avg_sc_non_season = $tmp_d_sc_ns['avg_level'];          $dh_end_sc_non_season = $tmp_d_sc_ns['end_level'];
        $monk_top_sc_non_season = $tmp_m_sc_ns['top_level'];        $monk_avg_sc_non_season = $tmp_m_sc_ns['avg_level'];        $monk_end_sc_non_season = $tmp_m_sc_ns['end_level'];
        $wd_top_sc_non_season = $tmp_wd_sc_ns['top_level'];         $wd_avg_sc_non_season = $tmp_wd_sc_ns['avg_level'];         $wd_end_sc_non_season = $tmp_wd_sc_ns['end_level'];
        $wizard_top_sc_non_season = $tmp_wz_sc_ns['top_level'];     $wizard_avg_sc_non_season = $tmp_wz_sc_ns['avg_level'];     $wizard_end_sc_non_season = $tmp_wz_sc_ns['end_level'];

        $query = "INSERT INTO eu_softcore_non_season (
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

        $file = "../../season_01/eu/sc/";

        file_put_contents($file . "barbarian/barbarian.data",   json_encode($tmp_b_sc_ns));
        file_put_contents($file . "crusader/crusader.data",     json_encode($tmp_c_sc_ns));
        file_put_contents($file . "dh/dh.data",                 json_encode($tmp_d_sc_ns));
        file_put_contents($file . "monk/monk.data",             json_encode($tmp_m_sc_ns));
        file_put_contents($file . "wd/wd.data",                 json_encode($tmp_wd_sc_ns));
        file_put_contents($file . "wizard/wizard.data",         json_encode($tmp_wz_sc_ns));

        $log = "        - softcore non-season uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);

        /* UPLOAD TEAM DATA */
        /* team hc season */
        $tmp_t2_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-2"), true);
        while ($tmp_t2_hc_s['top_level'] == 0 || $tmp_t2_hc_s['avg_level'] == 0 || $tmp_t2_hc_s['end_level'] == 0) {
            $tmp_t2_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-2"), true);
            $err_value++;
        }

        $tmp_t3_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-3"), true);
        while ($tmp_t3_hc_s['top_level'] == 0 || $tmp_t3_hc_s['avg_level'] == 0 || $tmp_t3_hc_s['end_level'] == 0) {
            $tmp_t3_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-3"), true);
            $err_value++;
        }

        $tmp_t4_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-4"), true);
        while ($tmp_t4_hc_s['top_level'] == 0 || $tmp_t4_hc_s['avg_level'] == 0 || $tmp_t4_hc_s['end_level'] == 0) {
            $tmp_t4_hc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-team-4"), true);
            $err_value++;
        }

        $query = "INSERT INTO eu_hardcore_season_team (
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

        $file = "../../season_01/eu/hc_season/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_hc_s));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_hc_s));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_hc_s));

        $log = "        - hardcore season team uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* team hc non season */
        $tmp_t2_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-2"), true);
        while ($tmp_t2_hc_ns['top_level'] == 0 || $tmp_t2_hc_ns['avg_level'] == 0 || $tmp_t2_hc_ns['end_level'] == 0) {
            $tmp_t2_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-2"), true);
            $err_value++;
        }

        $tmp_t3_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-3"), true);
        while ($tmp_t3_hc_ns['top_level'] == 0 || $tmp_t3_hc_ns['avg_level'] == 0 || $tmp_t3_hc_ns['end_level'] == 0) {
            $tmp_t3_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-3"), true);
            $err_value++;
        }

        $tmp_t4_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-4"), true);
        while ($tmp_t4_hc_ns['top_level'] == 0 || $tmp_t4_hc_ns['avg_level'] == 0 || $tmp_t4_hc_ns['end_level'] == 0) {
            $tmp_t4_hc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-team-4"), true);
            $err_value++;
        }

        $query = "INSERT INTO eu_hardcore_non_season_team (
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

        $file = "../../season_01/eu/hc/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_hc_ns));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_hc_ns));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_hc_ns));

        $log = "        - hardcore non-season team uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* team sc season */
        $tmp_t2_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-2"), true);
        while ($tmp_t2_sc_s['top_level'] == 0 || $tmp_t2_sc_s['avg_level'] == 0 || $tmp_t2_sc_s['end_level'] == 0) {
            $tmp_t2_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-2"), true);
            $err_value++;
        }

        $tmp_t3_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-3"), true);
        while ($tmp_t3_sc_s['top_level'] == 0 || $tmp_t3_sc_s['avg_level'] == 0 || $tmp_t3_sc_s['end_level'] == 0) {
            $tmp_t3_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-3"), true);
            $err_value++;
        }

        $tmp_t4_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-4"), true);
        while ($tmp_t4_sc_s['top_level'] == 0 || $tmp_t4_sc_s['avg_level'] == 0 || $tmp_t4_sc_s['end_level'] == 0) {
            $tmp_t4_sc_s = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/season/1/rift-team-4"), true);
            $err_value++;
        }

        $query = "INSERT INTO eu_softcore_season_team (
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

        $file = "../../season_01/eu/sc_season/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_sc_s));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_sc_s));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_sc_s));

        $log = "        - softcore season team uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
        $err_value = 0;

        /* team sc non season */
        $tmp_t2_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-2"), true);
        while ($tmp_t2_sc_ns['top_level'] == 0 || $tmp_t2_sc_ns['avg_level'] == 0 || $tmp_t2_sc_ns['end_level'] == 0) {
            $tmp_t2_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-2"), true);
            $err_value++;
        }

        $tmp_t3_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-3"), true);
        while ($tmp_t3_sc_ns['top_level'] == 0 || $tmp_t3_sc_ns['avg_level'] == 0 || $tmp_t3_sc_ns['end_level'] == 0) {
            $tmp_t3_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-3"), true);
            $err_value++;
        }

        $tmp_t4_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-4"), true);
        while ($tmp_t4_sc_ns['top_level'] == 0 || $tmp_t4_sc_ns['avg_level'] == 0 || $tmp_t4_sc_ns['end_level'] == 0) {
            $tmp_t4_sc_ns = json_decode(get_stat_json("http://eu.battle.net/d3/en/rankings/era/1/rift-team-4"), true);
            $err_value++;
        }

        $query = "INSERT INTO eu_softcore_non_season_team (
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

        $file = "../../season_01/eu/sc/";

        file_put_contents($file . "team_2/team_2.data", json_encode($tmp_t2_sc_ns));
        file_put_contents($file . "team_3/team_3.data", json_encode($tmp_t3_sc_ns));
        file_put_contents($file . "team_4/team_4.data", json_encode($tmp_t4_sc_ns));

        $log = "        - softcore non-season team uploaded. Errors: " . $err_value . "\n";
        echo $log . "<br>";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);

        $log = "        Uploading of EU statistics done.\n";
        file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);

        echo $log . "<br>";
    }
?>
