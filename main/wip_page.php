<?php
    /* require */
    require "../season_01/get_histogram.php";
    require "../resource/database/dbs_connect.php";

    /* DB b17_15475914_season_01 */
    dbs_connect("b17_15475914_season_01");
    
    /* HISTOGRAM DATA */
    $histogram = array();
    global $histogram;

    $histogram['eu']['hardcore']['season']['team_2'] = get_class_json('eu', 'hc', 'season', 'team_2'); 	$histogram['eu']['hardcore']['non_season']['team_2'] = get_class_json('eu', 'hc', 'non_season', 'team_2');  $histogram['softcore']['season']['team_2'] = get_class_json('eu', 'sc', 'season', 'team_2');  $histogram['softcore']['non_season']['team_2'] = get_class_json('eu', 'sc', 'non_season', 'team_2');
    $histogram['eu']['hardcore']['season']['team_3'] = get_class_json('eu', 'hc', 'season', 'team_3');  $histogram['eu']['hardcore']['non_season']['team_3'] = get_class_json('eu', 'hc', 'non_season', 'team_3');  $histogram['softcore']['season']['team_3'] = get_class_json('eu', 'sc', 'season', 'team_3');  $histogram['softcore']['non_season']['team_3'] = get_class_json('eu', 'sc', 'non_season', 'team_3');
    $histogram['eu']['hardcore']['season']['team_4'] = get_class_json('eu', 'hc', 'season', 'team_4');  $histogram['eu']['hardcore']['non_season']['team_4'] = get_class_json('eu', 'hc', 'non_season', 'team_4');  $histogram['softcore']['season']['team_4'] = get_class_json('eu', 'sc', 'season', 'team_4');  $histogram['softcore']['non_season']['team_4'] = get_class_json('eu', 'sc', 'non_season', 'team_4');

    $histogram['us']['hardcore']['season']['team_2'] = get_class_json('us', 'hc', 'season', 'team_2'); 	$histogram['us']['hardcore']['non_season']['team_2'] = get_class_json('us', 'hc', 'non_season', 'team_2');  $histogram['softcore']['season']['team_2'] = get_class_json('us', 'sc', 'season', 'team_2');  $histogram['softcore']['non_season']['team_2'] = get_class_json('us', 'sc', 'non_season', 'team_2');
    $histogram['us']['hardcore']['season']['team_3'] = get_class_json('us', 'hc', 'season', 'team_3');  $histogram['us']['hardcore']['non_season']['team_3'] = get_class_json('us', 'hc', 'non_season', 'team_3');  $histogram['softcore']['season']['team_3'] = get_class_json('us', 'sc', 'season', 'team_3');  $histogram['softcore']['non_season']['team_3'] = get_class_json('us', 'sc', 'non_season', 'team_3');
    $histogram['us']['hardcore']['season']['team_4'] = get_class_json('us', 'hc', 'season', 'team_4');  $histogram['us']['hardcore']['non_season']['team_4'] = get_class_json('us', 'hc', 'non_season', 'team_4');  $histogram['softcore']['season']['team_4'] = get_class_json('us', 'sc', 'season', 'team_4');  $histogram['softcore']['non_season']['team_4'] = get_class_json('us', 'sc', 'non_season', 'team_4');

    $histogram['kr']['hardcore']['season']['team_2'] = get_class_json('kr', 'hc', 'season', 'team_2'); 	$histogram['kr']['hardcore']['non_season']['team_2'] = get_class_json('kr', 'hc', 'non_season', 'team_2');  $histogram['softcore']['season']['team_2'] = get_class_json('kr', 'sc', 'season', 'team_2');  $histogram['softcore']['non_season']['team_2'] = get_class_json('kr', 'sc', 'non_season', 'team_2');
    $histogram['kr']['hardcore']['season']['team_3'] = get_class_json('kr', 'hc', 'season', 'team_3');  $histogram['kr']['hardcore']['non_season']['team_3'] = get_class_json('kr', 'hc', 'non_season', 'team_3');  $histogram['softcore']['season']['team_3'] = get_class_json('kr', 'sc', 'season', 'team_3');  $histogram['softcore']['non_season']['team_3'] = get_class_json('kr', 'sc', 'non_season', 'team_3');
    $histogram['kr']['hardcore']['season']['team_4'] = get_class_json('kr', 'hc', 'season', 'team_4');  $histogram['kr']['hardcore']['non_season']['team_4'] = get_class_json('kr', 'hc', 'non_season', 'team_4');  $histogram['softcore']['season']['team_4'] = get_class_json('kr', 'sc', 'season', 'team_4');  $histogram['softcore']['non_season']['team_4'] = get_class_json('kr', 'sc', 'non_season', 'team_4');

    /* TABLE DATA */
    $table = array();
    global $table;

    $table['eu']['hardcore']['season']['team_2'] = data_table('eu', 'hc', 'season', 'team_2'); 	$table['eu']['hardcore']['non_season']['team_2'] = data_table('eu', 'hc', 'non_season', 'team_2');  $table['softcore']['season']['team_2'] = data_table('eu', 'sc', 'season', 'team_2');  $table['softcore']['non_season']['team_2'] = data_table('eu', 'sc', 'non_season', 'team_2');
    $table['eu']['hardcore']['season']['team_3'] = data_table('eu', 'hc', 'season', 'team_3');  $table['eu']['hardcore']['non_season']['team_3'] = data_table('eu', 'hc', 'non_season', 'team_3');  $table['softcore']['season']['team_3'] = data_table('eu', 'sc', 'season', 'team_3');  $table['softcore']['non_season']['team_3'] = data_table('eu', 'sc', 'non_season', 'team_3');
    $table['eu']['hardcore']['season']['team_4'] = data_table('eu', 'hc', 'season', 'team_4');  $table['eu']['hardcore']['non_season']['team_4'] = data_table('eu', 'hc', 'non_season', 'team_4');  $table['softcore']['season']['team_4'] = data_table('eu', 'sc', 'season', 'team_4');  $table['softcore']['non_season']['team_4'] = data_table('eu', 'sc', 'non_season', 'team_4');
    
    $table['us']['hardcore']['season']['team_2'] = data_table('us', 'hc', 'season', 'team_2'); 	$table['us']['hardcore']['non_season']['team_2'] = data_table('us', 'hc', 'non_season', 'team_2');  $table['softcore']['season']['team_2'] = data_table('us', 'sc', 'season', 'team_2');  $table['softcore']['non_season']['team_2'] = data_table('us', 'sc', 'non_season', 'team_2');
    $table['us']['hardcore']['season']['team_3'] = data_table('us', 'hc', 'season', 'team_3');  $table['us']['hardcore']['non_season']['team_3'] = data_table('us', 'hc', 'non_season', 'team_3');  $table['softcore']['season']['team_3'] = data_table('us', 'sc', 'season', 'team_3');  $table['softcore']['non_season']['team_3'] = data_table('us', 'sc', 'non_season', 'team_3');
    $table['us']['hardcore']['season']['team_4'] = data_table('us', 'hc', 'season', 'team_4');  $table['us']['hardcore']['non_season']['team_4'] = data_table('us', 'hc', 'non_season', 'team_4');  $table['softcore']['season']['team_4'] = data_table('us', 'sc', 'season', 'team_4');  $table['softcore']['non_season']['team_4'] = data_table('us', 'sc', 'non_season', 'team_4');
    
    $table['kr']['hardcore']['season']['team_2'] = data_table('kr', 'hc', 'season', 'team_2'); 	$table['kr']['hardcore']['non_season']['team_2'] = data_table('kr', 'hc', 'non_season', 'team_2');  $table['softcore']['season']['team_2'] = data_table('kr', 'sc', 'season', 'team_2');  $table['softcore']['non_season']['team_2'] = data_table('kr', 'sc', 'non_season', 'team_2');
    $table['kr']['hardcore']['season']['team_3'] = data_table('kr', 'hc', 'season', 'team_3');  $table['kr']['hardcore']['non_season']['team_3'] = data_table('kr', 'hc', 'non_season', 'team_3');  $table['softcore']['season']['team_3'] = data_table('kr', 'sc', 'season', 'team_3');  $table['softcore']['non_season']['team_3'] = data_table('kr', 'sc', 'non_season', 'team_3');
    $table['kr']['hardcore']['season']['team_4'] = data_table('kr', 'hc', 'season', 'team_4');  $table['kr']['hardcore']['non_season']['team_4'] = data_table('kr', 'hc', 'non_season', 'team_4');  $table['softcore']['season']['team_4'] = data_table('kr', 'sc', 'season', 'team_4');  $table['softcore']['non_season']['team_4'] = data_table('kr', 'sc', 'non_season', 'team_4');

    /* FUNCTIONS */
    function prepare_histogram_array($realm, $game_mode, $season, $class_name, $histogram)
    {
        $size = count($histogram[$realm][$game_mode][$season][$class_name]['histogram']);
        $n = 0;

        foreach($histogram[$realm][$game_mode][$season][$class_name]['histogram'] as $key => $value) {
            if ($n < $size - 1) { echo "[$key, $value, $value], "; }
            else { echo "[$key, $value, $value]"; }
            $n += 1;
        }
    }
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

    function base (type) {
        var xmlhttp;
        if ( window.XMLHttpRequest ) xmlhttp = new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
        else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                switch (type) {
                    case 'h':
                        document.getElementById("grift_histogram").innerHTML = xmlhttp.responseText;
                        break;
                    case 'g':
                        document.getElementById("grift_graph").innerHTML = xmlhttp.responseText;
                        break;
                    default:
                        break;
                }
            }
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
    table['hardcore']['season'] = ['team_2', 'team_3', 'team_4'];
    table['hardcore']['non-season'] = ['team_2', 'team_3', 'team_4'];
    table['softcore']['season'] = ['team_2', 'team_3', 'team_4'];
    table['softcore']['non-season'] = ['team_2', 'team_3', 'team_4'];
    
    var data = {};
    data['hardcore'] = ['season', 'non-season'];
    data['softcore'] = ['season', 'non-season'];
    data['hardcore']['season'] = ['team_2', 'team_3', 'team_4'];
    data['hardcore']['non-season'] = ['team_2', 'team_3', 'team_4'];
    data['softcore']['season'] = ['team_2', 'team_3', 'team_4'];
    data['softcore']['non-season'] = ['team_2', 'team_3', 'team_4'];
    
    data['hardcore']['season']['team_2'] =   <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;   data['hardcore']['non-season']['barbarian'] =  <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;
    data['hardcore']['season']['team_2'] =    <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;    data['hardcore']['non-season']['crusader'] =   <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;
    data['hardcore']['season']['team_2'] =          <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;          data['hardcore']['non-season']['dh'] =         <?php echo data_table('eu', 'hardcore', 'season', 'team_2'); ?>;
    
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
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'barbarian', $histogram);?>]); break;
                    case 'crusader':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'crusader', $histogram);?>]); break;
                    case 'dh':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'dh', $histogram);?>]); break;
                    case 'monk':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'monk', $histogram);?>]); break;
                    case 'wd':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'wd', $histogram);?>]); break;
                    case 'wizard':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'wizard', $histogram);?>]); break;
                    case 'team_2':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'team_2', $histogram);?>]); break;
                    case 'team_3':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'team_3', $histogram);?>]); break;
                    case 'team_4':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'season', 'team_4', $histogram);?>]); break;
                    default:
                        console.log('Error: graphHistogram: unkown class name');
                }
            }
            else if (season == 'non_season' || season == 'non-season') {
                switch (d3_class) {
                    case 'barbarian':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'barbarian', $histogram);?>]); break;
                    case 'crusader':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'crusader', $histogram);?>]); break;
                    case 'dh':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'dh', $histogram);?>]); break;
                    case 'monk':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'monk', $histogram);?>]); break;
                    case 'wd':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'wd', $histogram);?>]); break;
                    case 'wizard':
                        data = google.visualization.arrayToDataTable([['Level', 'Players', { role: 'annotation' }], <?php prepare_histogram_array('eu', 'hardcore', 'non_season', 'wizard', $histogram);?>]); break;
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
    
    </head>

<body>
<div id="wrapper">
    <div id="header">
        Greater Rift Team Statistics (last update <?php $query = "SELECT date FROM eu_hardcore_season_team ORDER BY date DESC LIMIT 1"; $row = get_array_query($query); echo gmdate("d.m.Y, H:m:s", $row['date']); ?>)
    </div>

    <?php include("../resource/header/header.php");?>

    <div id="content">

        <div id="season_table">
            <table border ="1" style="width:100%; cursor: default">
                <tr>
                    <td>EU / US / KR<br>top lvl<br>avg lvl<br>last lvl</td>
                    <td>2 Player Team</td>
                    <td>3 Player Team</td>
                    <td>4 Player Team</td>
                </tr>
                <tr>
                    <td>Season HC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_hardcore_season_team ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_hardcore_season_team ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_hardcore_season_team ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('hardcore', 'season', 'team_2'); load_ba_hc_s_g();">
                        <?php echo
                            $row_eu['team_2_top']." / ".   $row_us['team_2_top']." / ".   $row_kr['team_2_top']    ."<br>".
                            $row_eu['team_2_avg']."<br>".  $row_us['team_2_avg']."<br>".  $row_kr['team_2_avg']    ."<br>".
                            $row_eu['team_2_end']." / ".   $row_us['team_2_end']." / ".   $row_kr['team_2_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'team_3'); 	load_cr_hc_s_g();">
                        <?php echo
                            $row_eu['team_3_top']." / ".    $row_us['team_3_top']." / ".    $row_kr['team_3_top']     ."<br>".
                            $row_eu['team_3_avg']."<br>".   $row_us['team_3_avg']."<br>".   $row_kr['team_3_avg']     ."<br>".
                            $row_eu['team_3_end']." / ".    $row_us['team_3_end']." / ".    $row_kr['team_3_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'season', 'team_4'); 		load_dh_hc_s_g();">
                        <?php echo
                            $row_eu['team_4_top']." / ".          $row_us['team_4_top']." / ".          $row_kr['team_4_top']           ."<br>".
                            $row_eu['team_4_avg']."<br>".         $row_us['team_4_avg']."<br>".         $row_kr['team_4_avg']           ."<br>".
                            $row_eu['team_4_end']." / ".          $row_us['team_4_end']." / ".          $row_kr['team_4_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                </tr>
                <tr>
                    <td>Season SC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_softcore_season_team ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_softcore_season_team ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_softcore_season_team ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('softcore', 'season', 'team_2'); load_ba_sc_s_g();">
                        <?php echo
                            $row_eu['team_2_top']." / ".   $row_us['team_2_top']." / ".   $row_kr['team_2_top']    ."<br>".
                            $row_eu['team_2_avg']."<br>".  $row_us['team_2_avg']."<br>".  $row_kr['team_2_avg']    ."<br>".
                            $row_eu['team_2_end']." / ".   $row_us['team_2_end']." / ".   $row_kr['team_2_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'team_3'); 	load_cr_sc_s_g();">
                        <?php echo
                            $row_eu['team_3_top']." / ".    $row_us['team_3_top']." / ".    $row_kr['team_3_top']     ."<br>".
                            $row_eu['team_3_avg']."<br>".   $row_us['team_3_avg']."<br>".   $row_kr['team_3_avg']     ."<br>".
                            $row_eu['team_3_end']." / ".    $row_us['team_3_end']." / ".    $row_kr['team_3_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'season', 'team_4'); 		load_team_4_sc_s_g();">
                        <?php echo
                            $row_eu['team_4_top']." / ".          $row_us['team_4_top']." / ".          $row_kr['team_4_top']           ."<br>".
                            $row_eu['team_4_avg']."<br>".         $row_us['team_4_avg']."<br>".         $row_kr['team_4_avg']           ."<br>".
                            $row_eu['team_4_end']." / ".          $row_us['team_4_end']." / ".          $row_kr['team_4_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                </tr>
                <tr>
                    <td>Non-Season HC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_hardcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_hardcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_hardcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('hardcore', 'non_season', 'team_2'); load_ba_hc_ns_g();">
                        <?php echo
                            $row_eu['team_2_top']." / ".   $row_us['team_2_top']." / ".   $row_kr['team_2_top']    ."<br>".
                            $row_eu['team_2_avg']."<br>".  $row_us['team_2_avg']."<br>".  $row_kr['team_2_avg']    ."<br>".
                            $row_eu['team_2_end']." / ".   $row_us['team_2_end']." / ".   $row_kr['team_2_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'team_3'); 	load_cr_hc_ns_g();">
                        <?php echo
                            $row_eu['team_3_top']." / ".    $row_us['team_3_top']." / ".    $row_kr['team_3_top']     ."<br>".
                            $row_eu['team_3_avg']."<br>".   $row_us['team_3_avg']."<br>".   $row_kr['team_3_avg']     ."<br>".
                            $row_eu['team_3_end']." / ".    $row_us['team_3_end']." / ".    $row_kr['team_3_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('hardcore', 'non_season', 'team_4'); 		load_team_4_hc_ns_g();">
                        <?php echo
                            $row_eu['team_4_top']." / ".          $row_us['team_4_top']." / ".          $row_kr['team_4_top']           ."<br>".
                            $row_eu['team_4_avg']."<br>".         $row_us['team_4_avg']."<br>".         $row_kr['team_4_avg']           ."<br>".
                            $row_eu['team_4_end']." / ".          $row_us['team_4_end']." / ".          $row_kr['team_4_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
                </tr>
                <tr>
                    <td>Non-Season SC</td>
                    <?php
                    $query_eu = 'SELECT * FROM eu_softcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_eu = get_array_query($query_eu);
                    $query_us = 'SELECT * FROM us_softcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_us = get_array_query($query_us);
                    $query_kr = 'SELECT * FROM kr_softcore_non_season_team ORDER BY date DESC LIMIT 1'; $row_kr = get_array_query($query_kr);
                    ?>
                    <td onclick="graphHistogram('softcore', 'non_season', 'team_2'); load_ba_sc_ns_g();">
                        <?php echo
                            $row_eu['team_2_top']." / ".   $row_us['team_2_top']." / ".   $row_kr['team_2_top']    ."<br>".
                            $row_eu['team_2_avg']."<br>".  $row_us['team_2_avg']."<br>".  $row_kr['team_2_avg']    ."<br>".
                            $row_eu['team_2_end']." / ".   $row_us['team_2_end']." / ".   $row_kr['team_2_end'];   ?></td> <!-- Barbarian EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'team_3'); 	load_cr_sc_ns_g();">
                        <?php echo
                            $row_eu['team_3_top']." / ".    $row_us['team_3_top']." / ".    $row_kr['team_3_top']     ."<br>".
                            $row_eu['team_3_avg']."<br>".   $row_us['team_3_avg']."<br>".   $row_kr['team_3_avg']     ."<br>".
                            $row_eu['team_3_end']." / ".    $row_us['team_3_end']." / ".    $row_kr['team_3_end'];    ?></td> <!-- Crusader EU/US/KR-->
                    <td onclick="graphHistogram('softcore', 'non_season', 'team_4'); 		load_team_4_sc_ns_g();">
                        <?php echo
                            $row_eu['team_4_top']." / ".          $row_us['team_4_top']." / ".          $row_kr['team_4_top']           ."<br>".
                            $row_eu['team_4_avg']."<br>".         $row_us['team_4_avg']."<br>".         $row_kr['team_4_avg']           ."<br>".
                            $row_eu['team_4_end']." / ".          $row_us['team_4_end']." / ".          $row_kr['team_4_end'];          ?></td> <!-- Demon Hunter EU/US/KR-->
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