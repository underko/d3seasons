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

?>
