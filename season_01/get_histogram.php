<?php
	function get_class_json($realm, $game_mode, $season, $class_name)
    {
    	if ($game_mode == "hc" || $game_mode == "hardcore")
        	$game_mode = "hc";
        else if ($game_mode == "sc" || $game_mode == "softcore") 
    		$game_mode = "sc";
        
        if ($season == "non-season" || $season == "non_season") 
    		$season = "";
        else if ($season == "season") 
        	$season = "_season";
        
        $path = dirname(__FILE__)."/".$realm."/".$game_mode.$season."/".$class_name."/";
        $files = scandir($path, 1);
        $newest_file = $files[0];

        return json_decode(file_get_contents($path.$newest_file), true);
    }
?>