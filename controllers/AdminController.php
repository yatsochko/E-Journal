<?php
/**
 * Контроллер AdminController
 */

include_once ROOT . '/models/Lector.php';
include_once ROOT . '/models/Subject.php';
include_once ROOT . '/models/Group.php';
include_once ROOT . '/models/Mail.php';

include_once ROOT . '/models/Student.php';

class AdminController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {

        if (isset($_SESSION['admin'])) {
            $LectorsList = array_reverse(Lector::getLectorsList());
            $SubjectsList = array_reverse(Subject::getSubjectsList());
            $groups1st = Group::getGroupsListByIdCourse(1);
            $groups2st = Group::getGroupsListByIdCourse(2);
            $groups3st = Group::getGroupsListByIdCourse(3);
            $groups4st = Group::getGroupsListByIdCourse(4);
            $MailList = Mail::getMailList();
            $new_num = $this->NumberOfNewMail($MailList);


//            require_once("../database.php");
//            require_once("../models_admin/lectors_info.php");
//            $link = db_connect();
//            $lectors = array_reverse(lectorsinfo_all($link));
//            require_once("../models_admin/subjects_info.php");
//            $subjects = array_reverse(subjectsinfo_all($link));
//            require_once("../models_admin/admin_mail_show.php");
//            $mail = mail_all($link);
//            require_once("../models_admin/admin_mail_show.php");
//            $new_num = new_num($mail);
//            require_once("../models/groupsmysql.php");
//            $groups1st = groups_all($link, 1);
//            require_once("../models/groupsmysql.php");
//            $groups2st = groups_all($link, 2);
//            require_once("../models/groupsmysql.php");
//            $groups3st = groups_all($link, 3);
//            require_once("../models/groupsmysql.php");
//            $groups4st = groups_all($link, 4);
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionMail()
    {
        $MailList = Mail::getMailList();

        // Подключаем вид
        require_once(ROOT . '/views/admin/mail_list.php');
    }

    public function actionMailOne($id)
    {
        $MailOne = Mail::getMailOne($id);

        // Подключаем вид
        require_once(ROOT . '/views/admin/mail_one.php');
    }

    public function actionAjaxDeleteMail()
    {
        $id = $_POST["id"];

        $db = Db::getConnection();

        $sql = 'DELETE FROM mail WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
    }

    public function NumberOfNewMail($MailList)
    {
        $new_num = 0;
        foreach ($MailList as $letters) {
            if (!$letters['mail_read']) {
                $new_num++;
            }
        }
        return $new_num;
    }

    public function actionAjaxAddLector()
    {
        $fio = $_GET['fio'];
        $link = mysqli_connect('localhost', 'root', '', 'feit');
        $query = "INSERT INTO lectors (lector_fio) VALUES ('$fio')";
        mysqli_query($link, $query);
        $last_id = mysqli_insert_id($link);
        $query2 = "SELECT * FROM lectors WHERE id = '$last_id'";
        $result = mysqli_query($link, $query2);
        $n = mysqli_num_rows($result);
        $lector = array();
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $lector[] = $row;
        }

        header("Content-Type: application/json\n\n");
        echo "{\"data\":{\"fio\":\"" . $lector[0]['lector_fio'] . "\",\"id\":\"" . $lector[0]['id'] . "\"}}";
    }

    public function actionAjaxDeleteLector()
    {
        $id = $_POST["id"];

        $db = Db::getConnection();

        $sql = 'DELETE FROM lectors WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
    }

    public function actionAjaxAddSubject()
    {
        $link = mysqli_connect('localhost', 'root', '', 'feit');
        $subjectGET = $_GET['subject'];
        $query = "INSERT INTO subjects (subject_name) VALUES ('$subjectGET')";
        mysqli_query($link, $query);
        $last_id = mysqli_insert_id($link);
        $query2 = "SELECT * FROM subjects WHERE id = '$last_id'";
        $result = mysqli_query($link, $query2);
        $n = mysqli_num_rows($result);
        $subject = array();
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $subject[] = $row;
        }
        header("Content-Type: application/json\n\n");
        echo "{\"data\":{\"subject\":\"" . $subject[0]['subject_name'] . "\",\"id\":\"" . $subject[0]['id'] . "\"}}";

    }

    public function actionAjaxDeleteSubject()
    {
        $id = $_POST["id"];

        $db = Db::getConnection();

        $sql = 'DELETE FROM subjects WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
    }

    public function actionAjaxGetGroupsByIdCourse($course_id)
    {
        $course = $course_id;
        $link = mysqli_connect('localhost', 'root', '', 'feit');
        $query = "SELECT * FROM groups WHERE id_course = '$course'";
        $result = mysqli_query($link, $query);
        // Извлекаем данные
        $n = mysqli_num_rows($result);
        $groups = array();

        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $groups[] = $row;
        }
        header("Content-Type: text/html");
        echo "<div class=\"form-group\">";
        echo "<label for=\"select\" class=\"col-lg-2 control-label\">Оберіть групу</label>";
        echo "<div class=\"col-lg-10\">";
        echo "<select class=\"form-control\" id=\"select\">";
        foreach ($groups as $group):
            echo "<option value=\"" . $group['id'] . "\">" . $group['group_name'] . "</option>";
        endforeach;
        echo "</select>";
        echo "</div>";
        echo "</div>";
    }

    public function actionAjaxAddStudent()
    {
        $link = mysqli_connect('localhost', 'root', '', 'feit');
        $groupID = $_GET['group'];
        $studentFIO = $_GET['fio'];
        $query = "INSERT INTO students (student_fio, id_group) VALUES ('$studentFIO', '$groupID')";
        mysqli_query($link, $query);
        header("Content-Type: application/json\n\n");
        echo "{\"data\":{\"fio\":\"" . $groupID . "\",\"id\":\"" . $studentFIO . "\"}}";

    }

    public function actionAjaxDeleteStudent()
    {
        $id = $_POST["id"];

        $db = Db::getConnection();

        $sql = 'DELETE FROM students WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
    }
}