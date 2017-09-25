<?php
$link = mysqli_connect('localhost', 'root', '', 'feit');
$subjectGET=$_GET['subject'];
$query = "INSERT INTO subjects (subject_name) VALUES ('$subjectGET')";
mysqli_query($link, $query);
$last_id =  mysqli_insert_id($link);
$query2 = "SELECT * FROM subjects WHERE id = '$last_id'";
$result = mysqli_query($link, $query2);
$n = mysqli_num_rows($result);
$subject = array();
for ($i = 0; $i < $n; $i++)
{
    $row = mysqli_fetch_assoc($result);
    $subject[] = $row;
}
header("Content-Type: application/json\n\n");
echo "{\"data\":{\"subject\":\"".$subject[0]['subject_name']."\",\"id\":\"".$subject[0]['id']."\"}}";
//$_SESSION['request_afterAddL'] = $lector;
?>