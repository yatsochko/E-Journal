<?php
$groupID = $_GET['id'];
$link = mysqli_connect('localhost', 'root', '', 'feit');
$query = "SELECT * FROM students WHERE id_group = '$groupID'";
$result = mysqli_query($link, $query);

if(!$result)
    die(mysqli_error($link));

// Извлекаем данные
$n = mysqli_num_rows($result);
$students = array();

for ($i = 0; $i < $n; $i++)
{
    $row = mysqli_fetch_assoc($result);
    $students[] = $row;
}
$query2 = "SELECT * FROM groups WHERE id = '$groupID'";
$result2 = mysqli_query($link, $query2);
$n2 = mysqli_num_rows($result2);
$groupNAME = array();

for ($i = 0; $i < $n2; $i++)
{
    $row2 = mysqli_fetch_assoc($result2);
    $groupNAME[] = $row2;
}
header("Content-Type: text/html");
//echo "<div class=\"tab-pane fade\" id=\"dropdown".$students[0]['id_group']."\">";
echo "<div class=\"divtable shadow result\" id=\"showdiv\" style=\"width:50%; float: left; min-width: 400px; margin-bottom: 15px; margin-top: 15px\">";
echo "<div class=\"well\" style=\"text-align: center; font-size: 20px\">";
echo $groupNAME[0]['group_name'];
echo "</div>";
echo "<table class=\"table table-hover\" id=\"refr\">";
echo "<thead>";
echo "<tr>";
echo "<td id=\"namecell\">Призвіще Ім'я</td>";
echo "<td class=\"thcell\">delete</td>";
echo "</tr>";
echo "</thead>";
echo "<tbody id=\"tab3\">";
foreach($students as $student):
    echo "<tr  id=\"removestud".$student['id']."\">";
    echo "<td id=\"namecell\">".$student['student_fio']."</td>";
    echo "<td id=\"del_icon\"><img src=\"/template/images/delete.png\" onclick=\"delete_student(".$student['id'].",".$student['id'].")\" style=\"height: 17px;\"></td>";
    echo "</tr>";
endforeach;
echo "</body>";
echo "</table>";
echo "</div>";
?>