<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function get_stat_json($link)
    {
        $opts = array('http'=>array('method'=>"GET",'timeout' => 60));
        $context = stream_context_create($opts);
        $f = file_get_contents($link, false, $context);

        $rift_rank = array();
        $result = array();

        $page = explode("\n", $f);
        $title = explode('rankings', $link);
        $result['title'] = trim($title[1]);
        $line_count = count($page);

        for ($i = 300; $i < $line_count; $i++) {
            if ( (strpos($page[$i], 'class="cell-Rank"') !== false) && (strpos($page[$i + 1], '.') !== false) ) {
                $i += 9; /* useless data skip */
                while (strpos($page[$i], 'class="cell-RiftLevel"') === false) { $i++; };
                $rift_rank[] = trim($page[++$i]);
            }
        }

        $histogram = array();
        $total = 0;
        $rift_rank_unique = array_unique($rift_rank);

        foreach($rift_rank_unique as $rr) { $histogram[$rr] = 0; }
        foreach($rift_rank as $rr) { $histogram[$rr] += 1; $total += $rr; }

        $result['top_level'] = $rift_rank[0];
        $result['end_level'] = $rift_rank[count($rift_rank) - 1];

        if (count($rift_rank) != 0) {
            $avg = ( $total / (count($rift_rank) + 0.0) );
            $result['avg_level'] = $avg;
        }
        else
            $result['avg_level'] = null;

        $result['histogram'] = array();

        foreach($rift_rank_unique as $value) { $result['histogram'][$value] = $histogram[$value]; }

        return json_encode($result);
    }

    function get_name_array($link)
    {
        $opts = array('http'=>array('method'=>"GET",'timeout' => 60));
        $context = stream_context_create($opts);
        $f = file_get_contents($link, false, $context);

        $name_list = array();

        $page = explode("\n", $f);
        $line_count = count($page);

        for ($i = 300; $i < $line_count; $i++) {
            if ( (strpos($page[$i], '<strong class="battletag">') !== false) ) {
                $name_list[] = explode("/", $page[++$i])[4];
            }
        }

        return $name_list;
    }

    function get_leaderboard_chars($realm, $game_mode, $season, $class, $account_list) {
        $max_level = 70;
        $opts = array('http'=>array('method'=>"GET",'timeout' => 600));
        $context = stream_context_create($opts);
        
        $size = count($account_list);
        $char_array = array();

        for ($i = 0; $i < $size; $i++) {
            $link  = "http://". $realm .".battle.net/api/d3/profile/". $account_list[$i] ."/";
            $account = file_get_contents($link, false, $context);
            $account = json_decode($account, true);

            $hero_count = count($account['heroes']);

            $char_array[$account_list[$i]] = array();
            $char_array[$account_list[$i]]["rank"] = $i + 1;
            $char_array[$account_list[$i]]["profile_link"] = $link;
            $char_array[$account_list[$i]]["heroes"] = array();

            $n = 0;

            for ($j = 0; $j < $hero_count; $j ++) {

                $hero_level = $account['heroes'][$j]['level'];
                $hero_class = $account['heroes'][$j]['class'];
                $hero_season = $account['heroes'][$j]['seasonal'];
                $hero_mode = $account['heroes'][$j]['hardcore'];
                $hero_dead = $account['heroes'][$j]['dead'];

                echo "l: $hero_level, c: $hero_class, s: $hero_season, m: $hero_mode, d: $hero_dead \n<br>";

                if (
                    $hero_level == $max_level &&
                    $hero_class == $class &&
                    $hero_season == $season &&
                    $hero_mode == $game_mode &&
                    $hero_dead == false
                   )
                {
                    $hero_name = $account['heroes'][$j]['name'];
                    $hero_id = $account['heroes'][$j]['id'];

                    $char_array[$account_list[$i]]["heroes"][$n] = array();
                    $char_array[$account_list[$i]]["heroes"][$n]['name'] = $hero_name;
                    $char_array[$account_list[$i]]["heroes"][$n]['id'] = $hero_id;
                    $char_array[$account_list[$i]]["heroes"][$n]['level'] = $hero_level;
                    $char_array[$account_list[$i]]["heroes"][$n]['link'] = $link ."hero/". $hero_id;

                    $n++;
                }
            }

            $top_hero = get_top_hero($char_array[$account_list[$i]]["heroes"]);
            $char_array[$account_list[$i]]["top_hero"] = $top_hero;
            file_put_contents('dump.log', '*', FILE_APPEND | LOCK_EX);
        }
        file_put_contents('dump.log', "\n", FILE_APPEND | LOCK_EX);
        return $char_array;
    }

    function get_top_hero($hero_array) {

        $top_hero = array();

        echo "<pre>";
        print_r($hero_array);
        echo "</pre>";

        if (count($hero_array) == 1) {
            echo "1 element array\n";
            $top_hero['id'] = $hero_array[0]['id'];
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
            }
        }

        return $top_hero;
    }

    function test() {
        $test = get_name_array("http://eu.battle.net/d3/en/rankings/season/1/rift-hardcore-crusader");
        $charz = get_leaderboard_chars('eu', true, true, 'crusader', $test);

        echo "<pre>";
        print_r($charz);
        echo "</pre>";

        return;
    }

    test();
?>
