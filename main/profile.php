    <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
        <meta name="description" content="d3seasons seasons summary">
		<title>Seasons Summary</title>
        <link rel="stylesheet" type="text/css" href="../resource/css_style/style.css">
	</head>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        google.load('visualization', '1.0', {'packages':['corechart', 'table']});

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            jQuery.ajaxSetup({cache: false});
            jQuery(function($){
                function nav(){
                    var theUrl = this.value ;
                    if (theUrl != ""){
                        $('#season_div').load(theUrl);
                    }
                }
                $('select[name="season_select"]').change(nav);
            });
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
                    <select name="season_select">
                        <option value="">----- Select A Season -----</option>
                        <option value="./season_page/season_01.php">Season 1</option>
                        <option value="./season_page/season_02.php">Season 2</option>
                        <option value="test.php">test</option>
                    </select>
                </form>
                <div id="season_div"></div>


			</div>

			<?php include("../resource/footer/footer.php");?>

		</div>

	</body>

</html>