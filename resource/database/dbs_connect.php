<?php
    function dbs_connect($database)
    {
        //database variables for connection
        $username = "b17_15475914";
        $password = "5a5636f81e1919c09a3112d3a";
        $hostname = "sql213.byethost17.com";

        //connection to the database
        $dbhandle = mysql_connect($hostname, $username, $password)
        or die("Unable to connect to MySQL");

        $selected = mysql_select_db($database, $dbhandle)
        or die("Could not select database: '$database'");
    }

    function db_query($query)
    {
        $retval = mysql_query($query);

        if (!$retval) {
            die("Insertion of data failed.<br>Error: ".mysql_error());
        }
    }

    function get_array_query($query)
    {
        $retval = mysql_query($query);

        if (!$retval) {
            die("Database transfer failed.<br>Error: ".mysql_error());
        }

        return mysql_fetch_array($retval);
    }

    function data_table($realm, $game_mode, $season, $class)
    {
        $query = "SELECT date, ".$class."_top, ".$class."_avg, ".$class."_end
                  FROM ".$realm."_".$game_mode."_".$season."
                  ORDER BY date ASC";

        $result = mysql_query($query);
        $data = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($data, $row);
        }

        return json_encode($data);
    }
?>
