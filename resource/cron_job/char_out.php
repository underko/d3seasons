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
        $date = gmdate("d.m.Y H:i:s", time());
        file_put_contents($var_file, "0");
        file_put_contents($log_file, "$date: Statistics Script finished succesfuly.\n", FILE_APPEND | LOCK_EX);
        exit(0);
    }
    else {
        echo "$date: Statistics Script already running, shutting down this one.\n";
        file_put_contents($log_file, "$date: Statistics Script already running, shutting down this one.\n", FILE_APPEND | LOCK_EX);
        exit(1);
    }

    // ------------------------------------------------------------------------------------------------

    /* FUNCTIONS */

    function run_script() {
        $active_skill_histogram = array();
        $passive_skill_histogram = array();
        create_item_array($item_histogram);

        $char_file = file_get_contents('char_json.log');
        $char_file = json_decode($char_file, true);

        foreach ($char_file as $profile) {
            if (array_key_exists('id', $profile['top_hero'])) {
                $link = $profile['top_hero']['link'];

                $hero_file = file_get_contents($link);
                $hero_file = json_decode($hero_file, true);

                foreach($hero_file['skills']['active'] as $skill) {
                    insert_skill_active($skill, $active_skill_histogram);
                }

                foreach($hero_file['skills']['passive'] as $skill) {
                    insert_skill_passive($skill, $passive_skill_histogram);
                }

                foreach($hero_file['items'] as $position => $item) {
                    if ($position == "leftFinger" || $position == "rightFinger")
                        $position = "rings";
                    insert_item($item, $item_histogram, $position);
                }
            }
        }

        file_put_contents('skill_active.out', json_encode($active_skill_histogram));
        file_put_contents('skill_passive.out', json_encode($passive_skill_histogram));
        file_put_contents('item.out', json_encode($item_histogram));

        return;
    }

    function create_item_array(&$array) {
        $array = array();
        $array['head'] = array();
        $array['torso'] = array();
        $array['feet'] = array();
        $array['hands'] = array();
        $array['shoulders'] = array();
        $array['legs'] = array();
        $array['bracers'] = array();
        $array['mainHand'] = array();
        $array['offHand'] = array();
        $array['waist'] = array();
        $array['rings'] = array();
        $array['neck'] = array();
        
        return;
    }
    
    function insert_skill_active($skill, &$array) {
        if (!empty($skill)) {
            $skill_name = $skill['skill']['name'];
            $rune_name = $skill['rune']['name'];

            if (strlen($skill_name) > 0 && !array_key_exists($skill_name, $array)) {
                $array[$skill_name] = array();
                $array[$skill_name]['count'] = 1;
                $array[$skill_name]['rune'] = array();

                insert_rune($rune_name, $array[$skill_name]['rune']);
            } else {
                $array[$skill_name]['count']++;
                insert_rune($rune_name, $array[$skill_name]['rune']);
            }
        }
    }

    function insert_rune($rune, &$array) {
        if (strlen($rune) > 0 && !array_key_exists($rune, $array)) {
            $array[$rune] = 1;
        }
        else {
            $array[$rune]++;
        }

        return;
    }

    function insert_skill_passive($skill, &$array) {
        if (!empty($skill)) {
            $skill_name = $skill['skill']['name'];

            if (strlen($skill_name) > 0 && !array_key_exists($skill_name, $array)) {
                $array[$skill_name] = 1;
            } else {
                $array[$skill_name]++;
            }
        }
    }

    function insert_item($item, &$array, $position) {
        if (!empty($item)) {
            if (!array_key_exists($item['name'], $array[$position])) {
                $array[$position][$item['name']] = 1;
            } else {
                $array[$position][$item['name']]++;
            }
        }
    }

?>