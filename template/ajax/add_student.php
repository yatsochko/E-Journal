<?php
$link = mysqli_connect('localhost', 'root', '', 'feit');
$groupID=$_GET['group'];
$studentFIO=$_GET['fio'];
$query = "INSERT INTO students (student_fio, id_group) VALUES ('$studentFIO', '$groupID')";
mysqli_query($link, $query);
header("Content-Type: application/json\n\n");
echo "{\"data\":{\"fio\":\"".$groupID."\",\"id\":\"".$studentFIO."\"}}";
//$_SESSION['request_afterAddL'] = $lector;
?>