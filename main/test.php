<?php
    include "../season_01/eu/hc_season/get_crusader_histogram.php";

    $file = get_json();
    $histogram = $file['histogram'];
?>


<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    google.load('visualization', '1.0', {'packages':['corechart', 'table']});

    google.setOnLoadCallback(drawChart_PlayTime);

    function drawChart_PlayTime() {
        var data = google.visualization.arrayToDataTable([
            ['Level', 'Players', { role: 'annotation' }],
            <?php
                $size = count($histogram);
                $n = 0;

                foreach($histogram as $key => $value) {
                    if ($n < $size - 1) { echo "[$key, $value, $value], "; }
                    else { echo "[$key, $value, $value]"; }
                    $n += 1;
                }
            ?>
        ]);

        var options = {
            'title': 'Players/Rift lvl',
            "vAxis":{"title":"# of players","minValue":0},
            "hAxis":{"title":"greater rift level",showTextEvery:1},
            "legend":"none",
            'width': 470,
            'height': 240
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_PlayTime'));
        chart.draw(data, options);
    }

</script>

<div id="chart_PlayTime"></div>
