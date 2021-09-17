<?php

$url = 'https://i.postimg.cc/Y0d3QZdQ/imageonline-co-overlayed-image-2.png';
?>
<!doctype html>
<html>
    <head><title> Poll Form </title>
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
    </head>
	<body>
		<?php
                $pollid = 'poll';
		$connect = mysqli_connect('localhost', 'root','','poll');
		$query = "SELECT * FROM polls WHERE pollid='$pollid'";
		$q1 = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($q1)) 
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
				$ip = $_SERVER['REMOTE_ADDR'];
				$newipaddress = $ipaddress."$ip,";
                                
				if (isset($_POST['vote'])) 
                                {
                                        $polloption = (isset($_POST['polloption']) ? $_POST['polloption'] : '');
                                        $ErrorTest="";
					if ($polloption == "")
                                        {
                                            echo '<script>alert("Select your option..!")</script>';
                                            die(); 
                                           
                                        }
                                        else 
                                        {
                                            $ipaddresse = explode(",", $ipaddress);
					    if (in_array($ip, $ipaddresse)) 
                                           {
                                            echo '<script>alert("You have already submitted..!")</script>';
                                            die();
					   } 
                                            else 
                                           {
					    mysqli_query($connect, "UPDATE questions SET votes='$newvotes' WHERE pollid='$pollid' AND option='$polloption'");
					    mysqli_query($connect, "UPDATE polls SET ipaddress='$newipaddress' WHERE pollid='$pollid'");
                                            echo '<script>alert("Submitted Successfully..!")</script>';
                                            die();
					   }
					
                                        }
				}
                                echo '<tr><td><input type="radio" id="authors "name="polloption"  value="'.$option.'"/></td><td><h3>'.$option.'</h3></td></tr>';	
                                }                         
                                
                                echo '<span style="color:RED;font-size:20px;font-family:calibri;"><center><h1>POLL FORM</h1></center></span>';
                         echo '<h2><br>Who is your favourite author ?</h2>';
		}
                ?>
                    <tr><td><input type="submit" name="vote" value="Submit" /></td></tr>
            </form>
	</table>
                <a href="results.php"><input type="button" name="viewresults" value="View Results"/></a>
    </body>
</html>


<html lang="en">
<head><title></title>
<style type="text/css">
body
{
background-image:url('<?php echo $url ?>');
background-size: 1365px 700px;
}
</style>
</head>
<body>  
</body>
</html>
