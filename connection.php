<?php 
$connection = mysqli_connect("localhost","root","","poll") or die("Error " . mysqli_error($connection));
$sql = "SELECT * FROM questions";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
$array = array();
$i = 0;

while($row = mysqli_fetch_assoc($result))
{  
    $orgname = $row['option'];
    $count = $row['votes'];
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $orgname), array('v'=>(int)$count)) );
}
$data = json_encode($array);
echo $data;
?>

