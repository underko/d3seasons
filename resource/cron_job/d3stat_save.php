<?
	// connect to database
	require_once('../../resource/database/dbs_connect.php');
	dbs_connect();

    // d3 api access and data retrieval for profile
    $profile_file = file_get_contents('http://eu.battle.net/api/d3/profile/Underko-2505/');
    $profile_array = json_decode($profile_file, true);

    $date = time();

    $paragon = $profile_array['paragonLevel'];
    $paragon_hc = $profile_array['paragonLevelHardcore'];

    $kills_monster = $profile_array['kills']['monsters'];
    $kills_monster_hc = $profile_array['kills']['hardcoreMonsters'];
    $kills_elite = $profile_array['kills']['elites'];

    $pt_barbarian = $profile_array['timePlayed']['barbarian'];
    $pt_crusader = $profile_array['timePlayed']['crusader'];
    $pt_demon_hunter = $profile_array['timePlayed']['demon-hunter'];
    $pt_monk = $profile_array['timePlayed']['monk'];
    $pt_witch_doctor = $profile_array['timePlayed']['witch-doctor'];
    $pt_wizard = $profile_array['timePlayed']['wizard'];

    //insert into database
    $query = "insert into `d3_stat` (date, paragon, paragon_hc, kills_monster, kills_monster_hc, kills_elite, pt_barbarian, pt_crusader, pt_demon_hunter, pt_monk, pt_witch_doctor, pt_wizard)".
             "values ".
             "('$date', '$paragon', '$paragon_hc', '$kills_monster', '$kills_monster_hc', '$kills_elite', '$pt_barbarian', '$pt_crusader', '$pt_demon_hunter', '$pt_monk', '$pt_witch_doctor', '$pt_wizard')";

    $retval = mysql_query($query);

    if (!$retval) {
        die("Insertion of data failed.<br>Error: ".mysql_error());
    }
	
    //profile data save
    $file = file_get_contents('http://eu.battle.net/api/d3/profile/Underko-2505/');
	$array = json_decode($file, true);
	
	$date = time();
	
	$ret = file_put_contents('./profile/'.$date, json_encode($array));

    $log = gmdate("d.m.Y H:i:s", $date);
    $log .= "   Uploading of profile data done.\n";

    file_put_contents($log_file, $log, FILE_APPEND | LOCK_EX);
?>