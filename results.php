<html>
	<head><title>Poll Form</title>
<style>
input[type=button], input[type=submit]
  {
  background-color: black;
  border: none;
  color: white;
  padding: 6px 8px;
  margin: 6px 2px;
  cursor: pointer;
}
</style>
        <center>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            function drawChart() 
            {
                var jsonData = $.ajax({
                    url: "connection.php",
                    dataType: "json",
                    async: false
                }).responseText;
                var data = new google.visualization.DataTable(jsonData);

                var chart = new google.visualization.PieChart(document.getElementById('chart_container'));
                chart.draw(data, {width: 900, height: 370, title:'3D PieChart', is3D: true});
                
            }
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        </script>
        </center>
	</head>
	<body>
		<?php

		$pollid = 'poll';
		$connect = mysqli_connect('localhost', 'root','','poll');
		$query = "SELECT * FROM polls WHERE pollid='$pollid'";
		$q = mysqli_query($connect, $query);
		while($row = mysqli_fetch_array($q)) 
                {
			$id = $row[0];
			$pollid = $row[1];
			$ipaddress = $row[2];
		?>
                               <table>
				<form action="" method="POST">
	                  <?php
				$questions = "SELECT * FROM questions WHERE pollid='$pollid'";
				$q2 = mysqli_query($connect, $questions);
				while($r = mysqli_fetch_array($q2)) 
                                {
                                $option = $r[1];
				$votes = $r[2];
				$newvotes = $votes + 1;
                                
                                echo '<tr><td><h4>'.$option.'</h4></td><td></td><td></td><td></td><td><h4>'.$votes.' votes</h4></td></tr>';
                                
                                if($votes >= 5)
                                {
                                   echo '<span style="color:RED;font-size:17px;font-family:calibri;"><center>The most voted option is" '. $option .' " with " '. $votes .' " number of votes.</center><br></span>';

                                }
                                }
                                 echo '<h2>Who is your favourite author ?</h2>';
                                }
		?>                                    
               </form>
	</table>
            <a href="index.php"><input type="button" name="back" value="Back"/></a>
            <center><h2><div id="chart_container"></div></h2></center>
	</body
</html>