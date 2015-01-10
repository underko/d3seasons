<?php
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

    function test() {
        $test = get_name_array("http://eu.battle.net/d3/en/rankings/era/1/rift-hardcore-crusader");

        echo var_dump($test);
        
        $opts = array('http'=>array('method'=>"GET",'timeout' => 60));
        $context = stream_context_create($opts);

        $f = file_get_contents("http://eu.battle.net/api/d3/profile/".$test[4]."/", false, $context);

        echo var_dump($f);

        $f = file_get_contents("http://eu.battle.net/api/d3/profile/".$test[0]."/", false, $context);

        echo var_dump($f);

        $charz = get_leaderboard_chars('eu', $test);

        echo var_dump($charz);
    }

    function get_leaderboard_chars($realm, $account_list) {
        $opts = array('http'=>array('method'=>"GET",'timeout' => 60));
        $context = stream_context_create($opts);
        
        $size = count($account_list);
        $char_array = array();

        for ($i = 0; $i < $size; $i++) { 
            $account = file_get_contents("http://". $realm .".battle.net/api/d3/profile/". $account_list[$i] ."/", false, $context);

            $heroes = $account['heroes'];
            $char_array[$account['battleTag']] = array();

            for ($i = 0; $i < count($heroes); $i++) { 
                $char_array[$account['battleTag']][$heroes[$i]['id']] = $heroes[$i]['name'];
            }
        }

        return $char_array
    }

    test();
?>
