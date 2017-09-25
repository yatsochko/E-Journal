<?php
$link = mysqli_connect('localhost', 'root', '', 'feit');
$fio=$_GET['fio'];
$query = "INSERT INTO lectors (lector_fio) VALUES ('$fio')";
mysqli_query($link, $query);
$last_id =  mysqli_insert_id($link);
$query2 = "SELECT * FROM lectors WHERE id = '$last_id'";
$result = mysqli_query($link, $query2);
$n = mysqli_num_rows($result);
$lector = array();
for ($i = 0; $i < $n; $i++)
{
    $row = mysqli_fetch_assoc($result);
    $lector[] = $row;
}
header("Content-Type: application/json\n\n");
echo "{\"data\":{\"fio\":\"".$lector[0]['lector_fio']."\",\"id\":\"".$lector[0]['id']."\"}}";
//$_SESSION['request_afterAddL'] = $lector;
?>