<?php
    /* require */
    require "../season_01/get_histogram.php";
    require "../resource/database/dbs_connect.php";

    dbs_connect("b17_15475914_season_01");
    $histogram = array();
    global $histogram;
    
    /* HISTOGRAM DATA */
    $histogram['hardcore']['season']['barbarian'] = get_class_json('eu', 'hc', 'season', 'barbarian'); 	$histogram['hardcore']['non_season']['barbarian'] = get_class_json('eu', 'hc', 'non_season', 'barbarian');  $histogram['softcore']['season']['barbarian'] = get_class_json('eu', 'sc', 'season', 'barbarian');	$histogram['softcore']['non_season']['barbarian'] = get_class_json('eu', 'sc', 'non_season', 'barbarian');
    $histogram['hardcore']['season']['crusader'] = get_class_json('eu', 'hc', 'season', 'crusader');   	$histogram['hardcore']['non_season']['crusader'] = get_class_json('eu', 'hc', 'non_season', 'crusader');    $histogram['softcore']['season']['crusader'] = get_class_json('eu', 'sc', 'season', 'crusader');    $histogram['softcore']['non_season']['crusader'] = get_class_json('eu', 'sc', 'non_season', 'crusader');
    $histogram['hardcore']['season']['dh'] = get_class_json('eu', 'hc', 'season', 'dh');           		$histogram['hardcore']['non_season']['dh'] = get_class_json('eu', 'hc', 'non_season', 'dh');           		$histogram['softcore']['season']['dh'] = get_class_json('eu', 'sc', 'season', 'dh');               	$histogram['softcore']['non_season']['dh'] = get_class_json('eu', 'sc', 'non_season', 'dh');
    $histogram['hardcore']['season']['monk'] = get_class_json('eu', 'hc', 'season', 'monk');         	$histogram['hardcore']['non_season']['monk'] = get_class_json('eu', 'hc', 'non_season', 'monk');         	$histogram['softcore']['season']['monk'] = get_class_json('eu', 'sc', 'season', 'monk');            $histogram['softcore']['non_season']['monk'] = get_class_json('eu', 'sc', 'non_season', 'monk');
    $histogram['hardcore']['season']['wd'] = get_class_json('eu', 'hc', 'season', 'wd');           		$histogram['hardcore']['non_season']['wd'] = get_class_json('eu', 'hc', 'non_season', 'wd');           		$histogram['softcore']['season']['wd'] = get_class_json('eu', 'sc', 'season', 'wd');               	$histogram['softcore']['non_season']['wd'] = get_class_json('eu', 'sc', 'non_season', 'wd');
    $histogram['hardcore']['season']['wizard'] = get_class_json('eu', 'hc', 'season', 'wizard');       	$histogram['hardcore']['non_season']['wizard'] = get_class_json('eu', 'hc', 'non_season', 'wizard');       	$histogram['softcore']['season']['wizard'] = get_class_json('eu', 'sc', 'season', 'wizard');        $histogram['softcore']['non_season']['wizard'] = get_class_json('eu', 'sc', 'non_season', 'wizard');
    global $histogram;
    
    function prepare_histogram_array($game_mode, $season, $class_name, $histogram)
    {
        $size = count($histogram[$game_mode][$season][$class_name]['histogram']);
        $n = 0;
        
        foreach($histogram[$game_mode][$season][$class_name]['histogram'] as $key => $value) {
            if ($n < $size - 1) { echo "[$key, $value, $value], "; }
            else { echo "[$key, $value, $value]"; }
            $n += 1;
        }
    }

    /* DATA TABLES */
    $barbarian_hc_s = data_table('eu', 'hardcore', 'season', 'barbarian'); $barbarian_hc_ns = data_table('eu', 'hardcore', 'non_season', 'barbarian');  $barbarian_sc_s = data_table('eu', 'softcore', 'season', 'barbarian');    $barbarian_sc_ns = data_table('eu', 'softcore', 'non_season', 'barbarian');
    $crusader_hc_s = data_table('eu', 'hardcore', 'season', 'crusader');   $crusader_hc_ns = data_table('eu', 'hardcore', 'non_season', 'crusader');    $crusader_sc_s = data_table('eu', 'softcore', 'season', 'crusader');      $crusader_sc_ns = data_table('eu', 'softcore', 'non_season', 'crusader');
    $dh_hc_s = data_table('eu', 'hardcore', 'season', 'dh');               $dh_hc_ns = data_table('eu', 'hardcore', 'non_season', 'dh');                $dh_sc_s = data_table('eu', 'softcore', 'season', 'dh');                  $dh_sc_ns = data_table('eu', 'softcore', 'non_season', 'dh');
    $monk_hc_s = data_table('eu', 'hardcore', 'season', 'monk');           $monk_hc_ns = data_table('eu', 'hardcore', 'non_season', 'monk');            $monk_sc_s = data_table('eu', 'softcore', 'season', 'monk');              $monk_sc_ns = data_table('eu', 'softcore', 'non_season', 'monk');
    $wd_hc_s = data_table('eu', 'hardcore', 'season', 'wd');               $wd_hc_ns = data_table('eu', 'hardcore', 'non_season', 'wd');                $wd_sc_s = data_table('eu', 'softcore', 'season', 'wd');                  $wd_sc_ns = data_table('eu', 'softcore', 'non_season', 'wd');
    $wizard_hc_s = data_table('eu', 'hardcore', 'season', 'wizard');       $wizard_hc_ns = data_table('eu', 'hardcore', 'non_season', 'wizard');        $wizard_sc_s = data_table('eu', 'softcore', 'season', 'wizard');          $wizard_sc_ns = data_table('eu', 'softcore', 'non_season', 'wizard');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="mywebz diablo 3 greater rift statistics for each class and game type">
    <title>Greater Rift Level Statistics</title>
    <link rel="stylesheet" type="text/css" href="../resource/css_style/style.css">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

        function base_histogram ()
        {
            var xmlhttp;
            if ( window.XMLHttpRequest ) // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            else  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

            xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    document.getElementById("grift_histogram").innerHTML = xmlhttp.responseText;
            };
            return xmlhttp;
        }

        function base_graph ()
        {
            var xmlhttp;
            if ( window.XMLHttpRequest ) // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            else  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

            xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    document.getElementById("grift_graph").innerHTML = xmlhttp.responseText;
            };
            return xmlhttp;
        }

        /* LEFT PART - HISTOGRAM */
        /* HC SEASON */
        function load_ba_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_barbarian_histogram.php", true); xmlhttp.send(); }
        function load_cr_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_crusader_histogram.php",  true); xmlhttp.send(); }
        function load_dh_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_dhunter_histogram.php",   true); xmlhttp.send(); }
        function load_mo_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_monk_histogram.php",      true); xmlhttp.send(); }
        function load_wd_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_wdoctor_histogram.php",   true); xmlhttp.send(); }
        function load_wz_hc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc_season/get_wizard_histogram.php",    true); xmlhttp.send(); }

        /* HC NON SEASON */
        function load_ba_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_barbarian_histogram.php", true); xmlhttp.send(); }
        function load_cr_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_crusader_histogram.php",  true); xmlhttp.send(); }
        function load_dh_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_dhunter_histogram.php",   true); xmlhttp.send(); }
        function load_mo_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_monk_histogram.php",      true); xmlhttp.send(); }
        function load_wd_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_wdoctor_histogram.php",   true); xmlhttp.send(); }
        function load_wz_hc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/hc/get_wizard_histogram.php",    true); xmlhttp.send(); }

        /* SC SEASON */
        function load_ba_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_barbarian_histogram.php", true); xmlhttp.send(); }
        function load_cr_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_crusader_histogram.php",  true); xmlhttp.send(); }
        function load_dh_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_dhunter_histogram.php",   true); xmlhttp.send(); }
        function load_mo_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_monk_histogram.php",      true); xmlhttp.send(); }
        function load_wd_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_wdoctor_histogram.php",   true); xmlhttp.send(); }
        function load_wz_sc_s_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc_season/get_wizard_histogram.php",    true); xmlhttp.send(); }

        /* SC NON SEASON*/
        function load_ba_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_barbarian_histogram.php", true); xmlhttp.send(); }
        function load_cr_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_crusader_histogram.php",  true); xmlhttp.send(); }
        function load_dh_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_dhunter_histogram.php",   true); xmlhttp.send(); }
        function load_mo_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_monk_histogram.php",      true); xmlhttp.send(); }
        function load_wd_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_wdoctor_histogram.php",   true); xmlhttp.send(); }
        function load_wz_sc_ns_h() { xmlhttp = base_histogram(); xmlhttp.open("GET", "../season_01/sc/get_wizard_histogram.php",    true); xmlhttp.send(); }

        /* RIGHT PART - GRAPH */
        /* HC SEASON */
        function load_ba_hc_s_g() { prepTab('hardcore', 'season', 'barbarian'); drawChart('hardcore', 'season', 'barbarian'); }
        function load_cr_hc_s_g() { prepTab('hardcore', 'season', 'crusader'); drawChart('hardcore', 'season', 'crusader'); }
        function load_dh_hc_s_g() { prepTab('hardcore', 'season', 'dh'); drawChart('hardcore', 'season', 'dh'); }
        function load_mo_hc_s_g() { prepTab('hardcore', 'season', 'monk'); drawChart('hardcore', 'season', 'monk'); }
        function load_wd_hc_s_g() { prepTab('hardcore', 'season', 'wd'); drawChart('hardcore', 'season', 'wd'); }
        function load_wz_hc_s_g() { prepTab('hardcore', 'season', 'wizard'); drawChart('hardcore', 'season', 'wizard'); }

        /* HC NON SEASON */
        function load_ba_hc_ns_g() { prepTab('hardcore', 'non-season', 'barbarian'); drawChart('hardcore', 'non-season', 'barbarian'); }
        function load_cr_hc_ns_g() { prepTab('hardcore', 'non-season', 'crusader'); drawChart('hardcore', 'non-season', 'crusader'); }
        function load_dh_hc_ns_g() { prepTab('hardcore', 'non-season', 'dh'); drawChart('hardcore', 'non-season', 'dh'); }
        function load_mo_hc_ns_g() { prepTab('hardcore', 'non-season', 'monk'); drawChart('hardcore', 'non-season', 'monk'); }
        function load_wd_hc_ns_g() { prepTab('hardcore', 'non-season', 'wd'); drawChart('hardcore', 'non-season', 'wd'); }
        function load_wz_hc_ns_g() { prepTab('hardcore', 'non-season', 'wizard'); drawChart('hardcore', 'non-season', 'wizard'); }

        /* SC SEASON */
        function load_ba_sc_s_g() { prepTab('softcore', 'season', 'barbarian'); drawChart('softcore', 'season', 'barbarian'); }
        function load_cr_sc_s_g() { prepTab('softcore', 'season', 'crusader'); drawChart('softcore', 'season', 'crusader'); }
        function load_dh_sc_s_g() { prepTab('softcore', 'season', 'dh'); drawChart('softcore', 'season', 'dh'); }
        function load_mo_sc_s_g() { prepTab('softcore', 'season', 'monk'); drawChart('softcore', 'season', 'monk'); }
        function load_wd_sc_s_g() { prepTab('softcore', 'season', 'wd'); drawChart('softcore', 'season', 'wd'); }
        function load_wz_sc_s_g() { prepTab('softcore', 'season', 'wizard'); drawChart('softcore', 'season', 'wizard'); }

        /* SC NON SEASON*/
        function load_ba_sc_ns_g() { prepTab('softcore', 'non-season', 'barbarian'); drawChart('softcore', 'non-season', 'barbarian'); }
        function load_cr_sc_ns_g() { prepTab('softcore', 'non-season', 'crusader'); drawChart('softcore', 'non-season', 'crusader'); }
        function load_dh_sc_ns_g() { prepTab('softcore', 'non-season', 'dh'); drawChart('softcore', 'non-season', 'dh'); }
        function load_mo_sc_ns_g() { prepTab('softcore', 'non-season', 'monk'); drawChart('softcore', 'non-season', 'monk'); }
        function load_wd_sc_ns_g() { prepTab('softcore', 'non-season', 'wd'); drawChart('softcore', 'non-season', 'wd'); }
        function load_wz_sc_ns_g() { prepTab('softcore', 'non-season', 'wizard'); drawChart('softcore', 'non-season', 'wizard'); }



        /* GRAPH DATA */
        google.load('visualization', '1.0', {'packages':['corechart', 'table']});

        var table = {};
        table['hardcore'] = ['season', 'non-season'];
        table['softcore'] = ['season', 'non-season'];
        table['hardcore']['season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        table['hardcore']['non-season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        table['softcore']['season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        table['softcore']['non-season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        
        var data = {};
        data['hardcore'] = ['season', 'non-season'];
        data['softcore'] = ['season', 'non-season'];
        data['hardcore']['season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        data['hardcore']['non-season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        data['softcore']['season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];
        data['softcore']['non-season'] = ['barbarian', 'crusader', 'dh', 'monk','wd', 'wizard'];

        data['hardcore']['season']['barbarian'] =   <?php echo $barbarian_hc_s; ?>;   data['hardcore']['non-season']['barbarian'] =  <?php echo $barbarian_hc_ns; ?>;
        data['hardcore']['season']['crusader'] =    <?php echo $crusader_hc_s; ?>;    data['hardcore']['non-season']['crusader'] =   <?php echo $crusader_hc_ns; ?>;
        data['hardcore']['season']['dh'] =          <?php echo $dh_hc_s; ?>;          data['hardcore']['non-season']['dh'] =         <?php echo $dh_hc_ns; ?>;
        data['hardcore']['season']['monk'] =        <?php echo $monk_hc_s; ?>;        data['hardcore']['non-season']['monk'] =       <?php echo $monk_hc_ns; ?>;
        data['hardcore']['season']['wd'] =          <?php echo $wd_hc_s; ?>;          data['hardcore']['non-season']['wd'] =         <?php echo $wd_hc_ns; ?>;
        data['hardcore']['season']['wizard'] =      <?php echo $wizard_hc_s; ?>;      data['hardcore']['non-season']['wizard'] =     <?php echo $wizard_hc_ns; ?>;

        data['softcore']['season']['barbarian'] =   <?php echo $barbarian_sc_s; ?>;   data['softcore']['non-season']['barbarian'] =  <?php echo $barbarian_sc_ns; ?>;
        data['softcore']['season']['crusader'] =    <?php echo $crusader_sc_s; ?>;    data['softcore']['non-season']['crusader'] =   <?php echo $crusader_sc_ns; ?>;
        data['softcore']['season']['dh'] =          <?php echo $dh_sc_s; ?>;          data['softcore']['non-season']['dh'] =         <?php echo $dh_sc_ns; ?>;
        data['softcore']['season']['monk'] =        <?php echo $monk_sc_s; ?>;        data['softcore']['non-season']['monk'] =       <?php echo $monk_sc_ns; ?>;
        data['softcore']['season']['wd'] =          <?php echo $wd_sc_s; ?>;          data['softcore']['non-season']['wd'] =         <?php echo $wd_sc_ns; ?>;
        data['softcore']['season']['wizard'] =      <?php echo $wizard_sc_s; ?>;      data['softcore']['non-season']['wizard'] =     <?php echo $wizard_sc_ns; ?>;

        function prepTab(game_mode, season, d3_class) {
            var size = data[game_mode][season][d3_class].length;
            
            table[game_mode][season][d3_class] = new google.visualization.DataTable();
            table[game_mode][season][d3_class].addColumn('number', 'date');
            table[game_mode][season][d3_class].addColumn('number', 'top level');
            table[game_mode][season][d3_class].addColumn('number', 'avg level');
            table[game_mode][season][d3_class].addColumn('number', 'end level');

            var gm = 'hc'; var ss = 'season';

            if (game_mode == 'softcore') gm = 'sc';
            if (season == 'non-season') ss = 'non_season';

            for (var i = 0; i < size; i++) {
                table[game_mode][season][d3_class].addRow([
                    parseInt(data[game_mode][season][d3_class][i]['date']),
                    parseFloat(data[game_mode][season][d3_class][i][d3_class + '_top']),
                    parseFloat(data[game_mode][season][d3_class][i][d3_class + '_avg']),
                    parseFloat(data[game_mode][season][d3_class][i][d3_class + '_end'])

                ]);
            }
        }

        function drawChart(game_mode, season, d3_class) {
            var options = {
                'title': game_mode + ' ' + season + ' ' + d3_class,
                "vAxis":{"title":"grift level"},
                "hAxis":{"title":"time",showTextEvery:1},
                'width': 475,
                'height': 240
            };
            var chart = new google.visualization.LineChart(document.getElementById('grift_graph'));
            chart.draw(table[game_mode][season][d3_class], options);
        }

        function graphHistogram(game_mode, season, d3_class) {
            if (game_mode == 'hardcore') {
                var data;
                if (season == 'season') {
                    switch (d3_class) {
                        case 'barbarian':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'barbarian', $histogram);?>]); break;					
                        case 'crusader':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'crusader', $histogram);?>]); break;
                        case 'dh':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'dh', $histogram);?>]); break;
                        case 'monk':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'monk', $histogram);?>]); break;
                        case 'wd':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'wd', $histogram);?>]); break;
                        case 'wizard':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'season', 'wizard', $histogram);?>]); break;
                        default:
                            console.log('Error: graphHistogram: unkown class name');
                    }
                }
                else if (season == 'non_season' || season == 'non-season') {
                    switch (d3_class) {
                        case 'barbarian':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'barbarian', $histogram);?>]); break;
                        case 'crusader':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'crusader', $histogram);?>]); break;
                        case 'dh':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'dh', $histogram);?>]); break;
                        case 'monk':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'monk', $histogram);?>]); break;
                        case 'wd':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'wd', $histogram);?>]); break;
                        case 'wizard':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('hardcore', 'non_season', 'wizard', $histogram);?>]); break;
                        default:
                            console.log('Error: graphHistogram: unkown class name');
                    }
                }
            }
            else if (game_mode == 'softcore') {
                if (season == 'season') {
                    switch (d3_class) {
                        case 'barbarian':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'barbarian', $histogram);?>]); break;
                        case 'crusader':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'crusader', $histogram);?>]); break;
                        case 'dh':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'dh', $histogram);?>]); break;
                        case 'monk':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'monk', $histogram);?>]); break;
                        case 'wd':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'wd', $histogram);?>]); break;
                        case 'wizard':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'season', 'wizard', $histogram);?>]); break;
                        default:
                            console.log('Error: graphHistogram: unkown class name');
                    }
                }
                else if (season == 'non_season' || season == 'non-season') {
                    switch (d3_class) {
                        case 'barbarian':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'barbarian', $histogram);?>]); break;
                        case 'crusader':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'crusader', $histogram);?>]); break;
                        case 'dh':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'dh', $histogram);?>]); break;
                        case 'monk':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'monk', $histogram);?>]); break;
                        case 'wd':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'wd', $histogram);?>]); break;
                        case 'wizard':
                            data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('softcore', 'non_season', 'wizard', $histogram);?>]); break;
                        default:
                            console.log('Error: graphHistogram: unkown class name');
                    }
                }
		    }

		var options = {
			'title': 'players / grift lvl',
			"vAxis":{"title":"# of players","minValue":0},
			"hAxis":{"title":"greater rift level",showTextEvery:1},
			"legend":"none",
			'width': 475,
			'height': 240
		};

		var chart = new google.visualization.ColumnChart(document.getElementById('grift_histogram'));
		chart.draw(data, options);
	}

    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-56656340-1', 'auto');
      ga('send', 'pageview');
    </script>

</head>

<body>
<div id="wrapper">
    <div id="header">
        Greater Rift Solo Statistics (last update <?php $query = "SELECT date FROM eu_hardcore_season ORDER BY date DESC LIMIT 1"; $row = get_array_query($query); echo gmdate("d.m.Y, H:m:s", $row['date']); ?>)
    </div>

    <?php include("../resource/header/header.php");?>

    <div id="content">

        <div id="season_table">
            <table border ="1" style="width:100%; cursor: default">
                <tr>
                    <td>EU / US / KR<br>top lvl<br>avg lvl<br>last lvl</td>
                    <td>Barbarian</td>
                    <td>Crusader</td>
                    <td>Demon Hunter</td>
                    <td>Monk</td>
                    <td>Witch Doctor</td>
                    <td>Wizard</td>
                </tr>
                <tr>
                    <td>Season HC</td>
                    <?php
                        $query_eu = 'SELECT * FROM eu_hardcore_season ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                        $query_us = 'SELECT * FROM us_hardcore_season ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                        $query_kr = 'SELECT * FROM kr_hardcore_season ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('hardcore', 'season', 'barbarian'); load_ba_hc_s_g();">
                        <?php echo
                            $row_eu['barbarian_top']." / ".   $row_us['barbarian_top']." / ".   $row_kr['barbarian_top']    ."<br>".
                            $row_eu['barbarian_avg']."<br>".  $row_us['barbarian_avg']."<br>".  $row_kr['barbarian_avg']    ."<br>".
                            $row_eu['barbarian_end']." / ".   $row_us['barbarian_end']." / ".   $row_kr['barbarian_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'crusader'); 	load_cr_hc_s_g();">
                        <?php echo
                            $row_eu['crusader_top']." / ".    $row_us['crusader_top']." / ".    $row_kr['crusader_top']     ."<br>".
                            $row_eu['crusader_avg']."<br>".   $row_us['crusader_avg']."<br>".   $row_kr['crusader_avg']     ."<br>".
                            $row_eu['crusader_end']." / ".    $row_us['crusader_end']." / ".    $row_kr['crusader_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'dh'); 		load_dh_hc_s_g();">
                        <?php echo
                            $row_eu['dh_top']." / ".          $row_us['dh_top']." / ".          $row_kr['dh_top']           ."<br>".
                            $row_eu['dh_avg']."<br>".         $row_us['dh_avg']."<br>".         $row_kr['dh_avg']           ."<br>".
                            $row_eu['dh_end']." / ".          $row_us['dh_end']." / ".          $row_kr['dh_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'monk'); 		load_mo_hc_s_g();">
                        <?php echo
                            $row_eu['monk_top']." / ".        $row_us['monk_top']." / ".        $row_kr['monk_top']         ."<br>".
                            $row_eu['monk_avg']."<br>".       $row_us['monk_avg']."<br>".       $row_kr['monk_avg']         ."<br>".
                            $row_eu['monk_end']." / ".        $row_us['monk_end']." / ".        $row_kr['monk_end'];        ?></td> <!-- Monk EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'wd'); 		load_wd_hc_s_g();">
                        <?php echo
                            $row_eu['wd_top']." / ".          $row_us['wd_top']." / ".          $row_kr['wd_top']           ."<br>".
                            $row_eu['wd_avg']."<br>".         $row_us['wd_avg']."<br>".         $row_kr['wd_avg']           ."<br>".
                            $row_eu['wd_end']." / ".          $row_us['wd_end']." / ".          $row_kr['wd_end'];          ?></td> <!-- Witch Doctor EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'wizard'); 	load_wz_hc_s_g();">
                        <?php echo
                            $row_eu['wizard_top']." / ".      $row_us['wizard_top']." / ".      $row_kr['wizard_top']       ."<br>".
                            $row_eu['wizard_avg']."<br>".     $row_us['wizard_avg']."<br>".     $row_kr['wizard_avg']       ."<br>".
                            $row_eu['wizard_end']." / ".      $row_us['wizard_end']." / ".      $row_kr['wizard_end'];      ?></td> <!-- Wizard EU/US/KR-->
                </tr>
                <tr>
                    <td>Season SC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_softcore_season ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_softcore_season ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_softcore_season ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('softcore', 'season', 'barbarian'); load_ba_sc_s_g();">
                        <?php echo
                            $row_eu['barbarian_top']." / ".   $row_us['barbarian_top']." / ".   $row_kr['barbarian_top']    ."<br>".
                            $row_eu['barbarian_avg']."<br>".  $row_us['barbarian_avg']."<br>".  $row_kr['barbarian_avg']    ."<br>".
                            $row_eu['barbarian_end']." / ".   $row_us['barbarian_end']." / ".   $row_kr['barbarian_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'crusader'); 	load_cr_sc_s_g();">
                        <?php echo
                            $row_eu['crusader_top']." / ".    $row_us['crusader_top']." / ".    $row_kr['crusader_top']     ."<br>".
                            $row_eu['crusader_avg']."<br>".   $row_us['crusader_avg']."<br>".   $row_kr['crusader_avg']     ."<br>".
                            $row_eu['crusader_end']." / ".    $row_us['crusader_end']." / ".    $row_kr['crusader_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'dh'); 		load_dh_sc_s_g();">
                        <?php echo
                            $row_eu['dh_top']." / ".          $row_us['dh_top']." / ".          $row_kr['dh_top']           ."<br>".
                            $row_eu['dh_avg']."<br>".         $row_us['dh_avg']."<br>".         $row_kr['dh_avg']           ."<br>".
                            $row_eu['dh_end']." / ".          $row_us['dh_end']." / ".          $row_kr['dh_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'monk'); 		load_mo_sc_s_g();">
                        <?php echo
                            $row_eu['monk_top']." / ".        $row_us['monk_top']." / ".        $row_kr['monk_top']         ."<br>".
                            $row_eu['monk_avg']."<br>".       $row_us['monk_avg']."<br>".       $row_kr['monk_avg']         ."<br>".
                            $row_eu['monk_end']." / ".        $row_us['monk_end']." / ".        $row_kr['monk_end'];        ?></td> <!-- Monk EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'wd'); 		load_wd_sc_s_g();">
                        <?php echo
                            $row_eu['wd_top']." / ".          $row_us['wd_top']." / ".          $row_kr['wd_top']           ."<br>".
                            $row_eu['wd_avg']."<br>".         $row_us['wd_avg']."<br>".         $row_kr['wd_avg']           ."<br>".
                            $row_eu['wd_end']." / ".          $row_us['wd_end']." / ".          $row_kr['wd_end'];          ?></td> <!-- Witch Doctor EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'wizard'); 	load_wz_sc_s_g();">
                        <?php echo
                            $row_eu['wizard_top']." / ".      $row_us['wizard_top']." / ".      $row_kr['wizard_top']       ."<br>".
                            $row_eu['wizard_avg']."<br>".     $row_us['wizard_avg']."<br>".     $row_kr['wizard_avg']       ."<br>".
                            $row_eu['wizard_end']." / ".      $row_us['wizard_end']." / ".      $row_kr['wizard_end'];      ?></td> <!-- Wizard EU/US/KR-->
                </tr>
                <tr>
                    <td>Non-Season HC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_hardcore_non_season ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_hardcore_non_season ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_hardcore_non_season ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('hardcore', 'non_season', 'barbarian'); load_ba_hc_ns_g();">
                        <?php echo
                            $row_eu['barbarian_top']." / ".   $row_us['barbarian_top']." / ".   $row_kr['barbarian_top']    ."<br>".
                            $row_eu['barbarian_avg']."<br>".  $row_us['barbarian_avg']."<br>".  $row_kr['barbarian_avg']    ."<br>".
                            $row_eu['barbarian_end']." / ".   $row_us['barbarian_end']." / ".   $row_kr['barbarian_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'crusader'); 	load_cr_hc_ns_g();">
                        <?php echo
                            $row_eu['crusader_top']." / ".    $row_us['crusader_top']." / ".    $row_kr['crusader_top']     ."<br>".
                            $row_eu['crusader_avg']."<br>".   $row_us['crusader_avg']."<br>".   $row_kr['crusader_avg']     ."<br>".
                            $row_eu['crusader_end']." / ".    $row_us['crusader_end']." / ".    $row_kr['crusader_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'dh'); 		load_dh_hc_ns_g();">
                        <?php echo
                            $row_eu['dh_top']." / ".          $row_us['dh_top']." / ".          $row_kr['dh_top']           ."<br>".
                            $row_eu['dh_avg']."<br>".         $row_us['dh_avg']."<br>".         $row_kr['dh_avg']           ."<br>".
                            $row_eu['dh_end']." / ".          $row_us['dh_end']." / ".          $row_kr['dh_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'monk'); 		load_mo_hc_ns_g();">
                        <?php echo
                            $row_eu['monk_top']." / ".        $row_us['monk_top']." / ".        $row_kr['monk_top']         ."<br>".
                            $row_eu['monk_avg']."<br>".       $row_us['monk_avg']."<br>".       $row_kr['monk_avg']         ."<br>".
                            $row_eu['monk_end']." / ".        $row_us['monk_end']." / ".        $row_kr['monk_end'];        ?></td> <!-- Monk EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'wd'); 		load_wd_hc_ns_g();">
                        <?php echo
                            $row_eu['wd_top']." / ".          $row_us['wd_top']." / ".          $row_kr['wd_top']           ."<br>".
                            $row_eu['wd_avg']."<br>".         $row_us['wd_avg']."<br>".         $row_kr['wd_avg']           ."<br>".
                            $row_eu['wd_end']." / ".          $row_us['wd_end']." / ".          $row_kr['wd_end'];          ?></td> <!-- Witch Doctor EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'wizard'); 	load_wz_hc_ns_g();">
                        <?php echo
                            $row_eu['wizard_top']." / ".      $row_us['wizard_top']." / ".      $row_kr['wizard_top']       ."<br>".
                            $row_eu['wizard_avg']."<br>".     $row_us['wizard_avg']."<br>".     $row_kr['wizard_avg']       ."<br>".
                            $row_eu['wizard_end']." / ".      $row_us['wizard_end']." / ".      $row_kr['wizard_end'];      ?></td> <!-- Wizard EU/US/KR-->
                </tr>
                <tr>
                    <td>Non-Season SC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_softcore_non_season ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_softcore_non_season ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_softcore_non_season ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('softcore', 'non_season', 'barbarian'); load_ba_sc_ns_g();">
                        <?php echo
                            $row_eu['barbarian_top']." / ".   $row_us['barbarian_top']." / ".   $row_kr['barbarian_top']    ."<br>".
                            $row_eu['barbarian_avg']."<br>".  $row_us['barbarian_avg']."<br>".  $row_kr['barbarian_avg']    ."<br>".
                            $row_eu['barbarian_end']." / ".   $row_us['barbarian_end']." / ".   $row_kr['barbarian_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'crusader'); 	load_cr_sc_ns_g();">
                        <?php echo
                            $row_eu['crusader_top']." / ".    $row_us['crusader_top']." / ".    $row_kr['crusader_top']     ."<br>".
                            $row_eu['crusader_avg']."<br>".   $row_us['crusader_avg']."<br>".   $row_kr['crusader_avg']     ."<br>".
                            $row_eu['crusader_end']." / ".    $row_us['crusader_end']." / ".    $row_kr['crusader_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'dh'); 		load_dh_sc_ns_g();">
                        <?php echo
                            $row_eu['dh_top']." / ".          $row_us['dh_top']." / ".          $row_kr['dh_top']           ."<br>".
                            $row_eu['dh_avg']."<br>".         $row_us['dh_avg']."<br>".         $row_kr['dh_avg']           ."<br>".
                            $row_eu['dh_end']." / ".          $row_us['dh_end']." / ".          $row_kr['dh_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'monk'); 		load_mo_sc_ns_g();">
                        <?php echo
                            $row_eu['monk_top']." / ".        $row_us['monk_top']." / ".        $row_kr['monk_top']         ."<br>".
                            $row_eu['monk_avg']."<br>".       $row_us['monk_avg']."<br>".       $row_kr['monk_avg']         ."<br>".
                            $row_eu['monk_end']." / ".        $row_us['monk_end']." / ".        $row_kr['monk_end'];        ?></td> <!-- Monk EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'wd'); 		load_wd_sc_ns_g();">
                        <?php echo
                            $row_eu['wd_top']." / ".          $row_us['wd_top']." / ".          $row_kr['wd_top']           ."<br>".
                            $row_eu['wd_avg']."<br>".         $row_us['wd_avg']."<br>".         $row_kr['wd_avg']           ."<br>".
                            $row_eu['wd_end']." / ".          $row_us['wd_end']." / ".          $row_kr['wd_end'];          ?></td> <!-- Witch Doctor EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'wizard'); 	load_wz_sc_ns_g();">
                        <?php echo
                            $row_eu['wizard_top']." / ".      $row_us['wizard_top']." / ".      $row_kr['wizard_top']       ."<br>".
                            $row_eu['wizard_avg']."<br>".     $row_us['wizard_avg']."<br>".     $row_kr['wizard_avg']       ."<br>".
                            $row_eu['wizard_end']." / ".      $row_us['wizard_end']." / ".      $row_kr['wizard_end'];      ?></td> <!-- Wizard EU/US/KR-->
                </tr>
            </table>
        </div>

        <div id="grift_histogram">
            Click on the cell to show the statistics!
        </div>

        <div id="grift_graph">
            Click on the cell to show the statistics!
        </div>

    </div>

    <?php include("../resource/footer/footer.php");?>

</div>
</body>

</html>