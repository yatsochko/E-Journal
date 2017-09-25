<?php

class Student
{
    public static function getStudentListByIdGroup($group_id)
    {
        $group_id = intval($group_id);

        $db = Db::getConnection();

        $result = $db->query('SELECT *'
            . ' FROM students'
            . ' WHERE id_group=' . $group_id);

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $StudentList[$i]['id'] = $row['id'];
            $StudentList[$i]['student_fio'] = $row['student_fio'];
            $StudentList[$i]['id_group'] = $row['id_group'];
            $i++;
        }

        return $StudentList;
    }
}