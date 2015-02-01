<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
        <meta name="description" content="d3seasons seasons summary">
		<title>Seasons Summary</title>
        <link rel="stylesheet" type="text/css" href="../resource/css_style/style.css">
	</head>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script>

            function resizeIframe(obj) {
                obj.style.height = "0px";
                obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
            }

            function load_data(){

                var element = document.getElementById("select_season");
                var season  = element.options[element.selectedIndex].value;

                element = document.getElementById("select_realm");
                var realm = element.options[element.selectedIndex].value;

                element = document.getElementById("select_game_mode");
                var game_mode = element.options[element.selectedIndex].value;

                element = document.getElementById("select_class");
                var ch_class = element.options[element.selectedIndex].value;

                if (season == "null" || realm == "null" || game_mode == "null" || ch_class == "null")
                { document.getElementById("frame").src = "404.php"; return; }
                else if (season == "02")
                { document.getElementById("frame").src = "season_page/season_02.php"; return; }

                var file_path="../season_"+season+"/season_"+season+"_data/"+realm+"/"+game_mode+"/"+ch_class+"/statistics.php";
                console.log("path: "+ file_path);

                document.getElementById("frame").src = file_path;
            }
        </script>
	
	<body>
		<div id="wrapper">
			<div id="header">
				Final Seasons Statistics Summary
			</div>
			
			<?php include("../resource/header/header.php");?>

			<div id="content" style="font-family: exocetlight;">
				<h1>Hello WIP</h1>

                <form action="no_value">
                    <select id="select_season">
                        <option id="1" value="null" disabled selected>Select A Season</option>
                        <option id="2" value="01">Season 1</option>
                        <option id="3" value="02">Season 2</option>
                    </select>
                </form>

                <form action="no_value">
                    <select id="select_realm">
                        <option value="null" disabled selected>Select A Realm</option>
                        <option value="eu">Europe</option>
                        <option value="us">United States</option>
                        <option value="kr">Korea</option>
                    </select>
                </form>

                <form action="no_value">
                    <select id="select_game_mode">
                        <option value="null" disabled selected>Select A Game Mode</option>
                        <option value="hc_season" >Hardcore Season</option>
                        <option value="hc">Hardcore</option>
                        <option value="sc_season" >Softcore Season</option>
                        <option value="sc" >Softcore</option>
                    </select>
                </form>

                <form action="no_value">
                    <select id="select_class">
                        <option value="null" disabled selected>Select A Class</option>
                        <option value="barbarian">Barbarian</option>
                        <option value="crusader">Crusader</option>
                        <option value="dh" >Demon Hunter</option>
                        <option value="monk">Monk</option>
                        <option value="wd">Witch Doctor</option>
                        <option value="wizard">Wizard</option>
                    </select>
                </form>

                <!--onclick='document.getElementById("frame").src = "http://d3seasons.byethost17.com/main/test.php"'-->
                <button type="button" id="load_data" onclick="load_data()" >Load Data</button>

                <div id="season_div">

                    <iframe id="frame" onload='resizeIframe(this)' frameborder="0" scrolling="no" style="width: inherit; height: 200px; ">
                        <p>Your browser does not support iframes.</p>
                    </iframe>

                </div>
			</div>

			<?php include("../resource/footer/footer.php");?>

		</div>

	</body>

</html>