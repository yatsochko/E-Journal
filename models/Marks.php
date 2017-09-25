<?php

class Marks
{
    public static function getMarksOfStudent($subject_id, $student_id)
    {
        $subject_id = intval($subject_id);
        $student_id = intval($student_id);

        $db = Db::getConnection();

        $result = $db->query('SELECT *'
            . ' FROM relations_marks'
            . ' WHERE id_subject=' . $subject_id
            . ' AND id_stud=' . $student_id);

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $MarksOfStudent = $result->fetch();

        return $MarksOfStudent;
    }
}