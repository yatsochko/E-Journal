<?php
/**
 * Контроллер SubjectController
 */

include_once ROOT . '/models/Group.php';
include_once ROOT . '/models/Subject.php';
include_once ROOT . '/models/Student.php';
include_once ROOT . '/models/Marks.php';

class SubjectController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex($course_id, $group_id, $subject_id)
    {
        $GroupsList = Group::getGroupsListByIdCourse($course_id);

        $SubjectList = Subject::getSubjectsListByIdGroup($group_id);

        $StudentList = Student::getStudentListByIdGroup($group_id);

        $NumberLabsAndRgrs = Subject::getNumberLabsAndRgrs($group_id, $subject_id);

        $numLAB = $NumberLabsAndRgrs['num_lab'];
        $numLAB2 = $NumberLabsAndRgrs['num_lab'];
        $numRGR = $NumberLabsAndRgrs['num_rgr'];
        $numRGR2 = $NumberLabsAndRgrs['num_rgr'];

        // Подключаем вид
        require_once(ROOT . '/views/subject/index.php');
        return true;
    }

    public function getMarks($subject_id, $student_id){
        $MarksOfStudent = Marks::getMarksOfStudent($subject_id, $student_id);
        return $MarksOfStudent;
    }

}