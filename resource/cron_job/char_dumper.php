<?php

    /* set max execution time to 20m due to script nature */
    ini_set('max_execution_time', 1200);

    error_reporting(E_ALL);
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);

    /* REQUIRES */
    require 'leaderboard_parser.php';

    /* VARIABLES */
    $var_file = '../globals/char.var';
    $log_file = '../logs/chars.log';
    $output_file = '../../season_01/';
    $dump_file = 'dump.log';
    $opts = array('http'=>array('method'=>"GET",'timeout' => 600));
    $context = stream_context_create($opts);
    $date = gmdate("d.m.Y H:i:s", time());

    /* UNIQNESS CHECK */
    $var_value = file_get_contents($var_file, false, $context);
    if ($var_value == 0) {
        file_put_contents($var_file, "1");
        file_put_contents($log_file, "$date: Script running ...\n", FILE_APPEND | LOCK_EX);
        file_put_contents('dump.log', "");
        run_script();
        file_put_contents($var_file, "0");
        file_put_contents($log_file, "$date: Script finished succesfuly.\n", FILE_APPEND | LOCK_EX);
        exit(0);
    }
    else {
        file_put_contents($log_file, "$date: Script already running, shutting down this one.\n", FILE_APPEND | LOCK_EX);
        exit(1);
    }

    // ------------------------------------------------------------------------------------------------

    /* FUNCTIONS */
    function run_script() {
        echo "script running ... <br>";
        $test = get_name_array("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader");
        $charz = get_leaderboard_chars('eu', true, true, 'crusader', $test);

        $dump_file = 'char_json.log';
        $log_file = '../logs/chars.log';
        $date = gmdate("d.m.Y H:i:s", time());

        file_put_contents($dump_file, json_encode($charz), FILE_APPEND | LOCK_EX);
        file_put_contents($log_file, "$date: Script finished succesfuly.\n", FILE_APPEND | LOCK_EX);

        return;
    }

    function get_top_hero($hero_array) {
        $top_hero = array();

        if (count($hero_array) == 1) {
            echo "1 element array\n";
            $top_hero['id'] = $hero_array[0]['id'];
            $top_hero['link'] = $hero_array[0]['link'];
            return $top_hero;
        }

        $opts = array('http'=>array('method'=>"GET",'timeout' => 600));
        $context = stream_context_create($opts);

        $dmg = 0;

        foreach ($hero_array as $hero) {
            $hero_link = $hero['link'];

            $hero_file = file_get_contents($hero_link, false, $context);
            $hero_file = json_decode($hero_file, true);

            $act_dmg = $hero_file['stats']['damage'];
            if ($act_dmg > $dmg) {
                $top_hero['id'] = $hero['id'];
                $top_hero['link'] = $hero['link'];
            }
        }

        return $top_hero;
    }

?>