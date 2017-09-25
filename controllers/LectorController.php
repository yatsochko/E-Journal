<?php
/**
 * Контроллер LectorController
 */

include_once ROOT . '/models/Subject.php';
include_once ROOT . '/models/Student.php';
include_once ROOT . '/models/Marks.php';

class LectorController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        if(isset($_SESSION['lector_id'])){
            $lector_id = $_SESSION['lector_id'];

            $SubjectList = Subject::getSubjectsListByLectorID($lector_id);

        }
        // Подключаем вид
        require_once(ROOT . '/views/lector/index.php');
        return true;
    }

    public function actionMarks($group_id, $subject_id)
    {
        $StudentList = Student::getStudentListByIdGroup($group_id);

        $NumberLabsAndRgrs = Subject::getNumberLabsAndRgrs($group_id, $subject_id);

        $numLAB = $NumberLabsAndRgrs['num_lab'];
        $numLAB2 = $NumberLabsAndRgrs['num_lab'];
        $numRGR = $NumberLabsAndRgrs['num_rgr'];
        $numRGR2 = $NumberLabsAndRgrs['num_rgr'];

        // Подключаем вид
        require_once(ROOT . '/views/lector/marks.php');
        return true;
    }

    public function getMarks($subject_id, $student_id){
        $MarksOfStudent = Marks::getMarksOfStudent($subject_id, $student_id);
        return $MarksOfStudent;
    }

    public function actionAjaxEditMarks()
    {

        $db = Db::getConnection();
        $sql = "UPDATE relations_marks SET " . $_POST["column"] . " = :mark WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindparam(':id',$_POST["id"]);
        $result->bindparam(':mark',$_POST["editval"]);
        $result->execute();

    }

    public function actionAjaxEditNumberLabsAndRgrs()
    {

        $db = Db::getConnection();
        $sql = "UPDATE relations_gr_subj_lect SET " . $_POST["column"] . " = :num WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindparam(':id',$_POST["id"]);
        $result->bindparam(':num',$_POST["editval"]);
        $result->execute();

        $link = mysqli_connect('localhost', 'root', '', 'feit');
        $subjectID=$_POST["subjectID"];
        $groupID=$_POST["groupID"];

        $query = "SELECT id FROM students WHERE id_group = '$groupID'";
        $result = mysqli_query($link, $query);

        $n = mysqli_num_rows($result);
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $studID=$row['id'];
            $queryD = "SELECT id FROM relations_marks WHERE id_subject = '$subjectID' AND id_stud = '$studID'";
            $Duplicates = mysqli_query($link, $queryD);
            $nd = mysqli_num_rows($Duplicates);
            if($nd==0){
                $qAdd = "INSERT INTO relations_marks (id_subject, id_stud) VALUES ('$subjectID','$studID')";
                $addRel = mysqli_query($link, $qAdd);
            }
        }
    }
}