<?php
    ini_set('max_execution_time', 6000);

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

    function get_leaderboard_chars($realm, $game_mode, $season, $class, $account_list)
    {
        $max_level = 70;
        $opts = array('http' => array('method' => "GET", 'timeout' => 600));
        $context = stream_context_create($opts);

        $size = count($account_list);
        $char_array = array();

        file_put_contents('dump.log', "size: $size\n", FILE_APPEND | LOCK_EX);
        $rank = 0;

        foreach ($account_list as $account) {
            //if ($rank > 10) break;

            $link = "http://" . $realm . ".battle.net/api/d3/profile/" . $account . "/";
            $account_file = file_get_contents($link, false, $context);
            $account_file = json_decode($account_file, true);

            //$hero_count = count($account_file['heroes']);

            $char_array[$account] = array();
            $char_array[$account]["rank"] = ++$rank;
            $char_array[$account]["profile_link"] = $link;
            $char_array[$account]["heroes"] = array();

            $n = 0;

            foreach ($account_file['heroes'] as $hero) {
                $hero_level = $hero['level'];
                $hero_class = $hero['class'];
                $hero_season = $hero['seasonal'];
                $hero_mode = $hero['hardcore'];
                $hero_dead = $hero['dead'];

                //echo "l: $hero_level, c: $hero_class, s: $hero_season, m: $hero_mode, d: $hero_dead \n<br>";

                if (
                    $hero_level == $max_level &&
                    $hero_class == $class &&
                    $hero_season == $season &&
                    $hero_mode == $game_mode &&
                    $hero_dead == false
                ) {
                    $hero_name = $hero['name'];
                    $hero_id = $hero['id'];

                    $char_array[$account]["heroes"][$n] = array();
                    $char_array[$account]["heroes"][$n]['name'] = $hero_name;
                    $char_array[$account]["heroes"][$n]['id'] = $hero_id;
                    $char_array[$account]["heroes"][$n]['level'] = $hero_level;
                    $char_array[$account]["heroes"][$n]['link'] = $link . "hero/" . $hero_id;

                    $n++;
                }
            }

            $char_array[$account]["top_hero"] = get_top_hero($char_array[$account]["heroes"]);
            $date = gmdate("d.m.Y H:i:s", time());
            $name = $account;
            file_put_contents('dump.log', "$date: $rank: $name \n", FILE_APPEND | LOCK_EX);
        }

        file_put_contents('dump.log', "\n", FILE_APPEND | LOCK_EX);
        return $char_array;
    }

    function test() {
        $f = file_get_contents('skill_active.out');
        $f = json_decode($f, true);

        echo "active: <br><pre>";
        print_r($f);
        echo "<pre>";

        $f = file_get_contents('skill_passive.out');
        $f = json_decode($f, true);

        echo "passive: <br><pre>";
        print_r($f);
        echo "<pre>";

        $f = file_get_contents('item.out');
        $f = json_decode($f, true);

        echo "items: <br><pre>";
        print_r($f);
        echo "<pre>";
    }

?>
