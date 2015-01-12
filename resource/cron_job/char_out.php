<?php
    ini_set('max_execution_time', 1200);

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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
        file_put_contents($log_file, "$date: Statistics Script running ...\n", FILE_APPEND | LOCK_EX);
        file_put_contents('dump.log', "");
        run_script();
        file_put_contents($var_file, "0");
        file_put_contents($log_file, "$date: Statistics Script finished succesfuly.\n", FILE_APPEND | LOCK_EX);
        exit(0);
    }
    else {
        file_put_contents($log_file, "$date: Statistics Script already running, shutting down this one.\n", FILE_APPEND | LOCK_EX);
        exit(1);
    }

    // ------------------------------------------------------------------------------------------------

    /* FUNCTIONS */

    function run_script() {
        //file_out();

        $skills = array();
        $items = array();

        $char_file = file_get_contents('char_json.log');
        $char_file = json_decode($char_file, true);

        foreach ($char_file as $profile) {
            if (array_key_exists('id', $profile['top_hero'])) {
                echo $profile['top_hero']['id']."<br>";
                $link = "";
            }
        }

        return;
    }

    function file_out() {
        $file = file_get_contents('char_json.log');
        $file = json_decode($file, true);

        echo "<pre>";
        print_r($file);
        echo "</pre>";

        return;
    }
?>