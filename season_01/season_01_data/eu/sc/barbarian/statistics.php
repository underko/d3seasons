<html style="width: 1000px">
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

        google.load('visualization', '1.0', {'packages':['corechart', 'table']});
        google.setOnLoadCallback(drawActiveSkillGraph);

        function drawActiveSkillGraph()
        {
            var data = google.visualization.arrayToDataTable([
                ['Skill', 'Count'],
                <?php

                    $n = 1;
                    $file = json_decode(file_get_contents('skill_active.out'), true);
                    $size = count($file);

                    uasort($file, function($a, $b) { return $a['count'] > $b['count'] ? -1 : 1; });
                    //echo "<pre>";
                    //print_r($file); 

                    foreach ($file as $skill => $data)
                    {
                        if ($n < $size) { echo "[\"$skill\", ".$data['count']."], "; }
                        else { echo "[\"$skill\", ".$data['count']."]"; }
                        $n++;
                    }
                ?>
            ]);

            var options = {
                chartArea: {
                    top: '5%',
                    left: '50%',
                    width: '50%'
                },
                "vAxis":{"title":"# of items","minValue":0 },
                "hAxis":{"title":"# out of 1000",showTextEvery: 1},
                "legend":"none",
                "width": 400,
                "height": 500
            };

            var chart = new google.visualization.BarChart(document.getElementById('active_skills_graph'));
            chart.draw(data, options);
        }

    </script>


    <div id="active_skills_graph" style="width: 450px; height: 540px;float: left; border-style: dotted; border-width: 1px;"></div>
    <div id="active_skills_text" style="width: 490px; height: 500px; float: left; border-style: dotted; border-width: 1px; padding: 20px">asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br></div>

    <div id="active_skills_graph" style="width: 450px; height: 540px;float: left; border-style: dotted; border-width: 1px;"></div>
    <div id="active_skills_text" style="width: 450px; height: 500px; float: left; border-style: dotted; border-width: 1px; padding: 20px">asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br></div>

    <div id="active_skills_graph" style="width: 450px; height: 540px;float: left; border-style: dotted; border-width: 1px;"></div>
    <div id="active_skills_text" style="width: 450px; height: 500px; float: left; border-style: dotted; border-width: 1px; padding: 20px">asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br></div>

    <div id="active_skills_graph" style="width: 450px; height: 540px;float: left; border-style: dotted; border-width: 1px;"></div>
    <div id="active_skills_text" style="width: 450px; height: 500px; float: left; border-style: dotted; border-width: 1px; padding: 20px">asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br>asdadasdasdasd<br></div>

    <div id="passive_skills_graph"></div> <div id="passive_skills_text"></div>
    <div id="item_graph"></div> <div id="item_text"></div>

</html>