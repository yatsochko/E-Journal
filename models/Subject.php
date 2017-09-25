<?php

class Subject
{
    public static function getSubjectsListByIdGroup($group_id)
    {
        $group_id = intval($group_id);

        $db = Db::getConnection();

        $result = $db->query('SELECT s.id AS id_subject, s.subject_name, l.lector_fio, l.id AS id_lector'
            . ' FROM subjects s'
            . ' INNER JOIN relations_gr_subj_lect r ON s.id=r.id_subject'
            . ' INNER JOIN lectors l ON l.id=r.id_lector'
            . ' WHERE r.id_group=' . $group_id);

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $SubjectsList[$i]['id_subject'] = $row['id_subject'];
            $SubjectsList[$i]['subject_name'] = $row['subject_name'];
            $SubjectsList[$i]['id_lector'] = $row['id_lector']; // Пока не используется
            $SubjectsList[$i]['lector_fio'] = $row['lector_fio'];
            $i++;
        }

        return $SubjectsList;
    }

    public static function getNumberLabsAndRgrs($group_id, $subject_id)
    {
        $group_id = intval($group_id);
        $subject_id = intval($subject_id);

        $db = Db::getConnection();

        $result = $db->query('SELECT num_lab, num_rgr'
            . ' FROM relations_gr_subj_lect'
            . ' WHERE id_group=' . $group_id
            . ' AND id_subject=' . $subject_id);

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $NumberLabsAndRgrs = $result->fetch();

        return $NumberLabsAndRgrs;
    }

    public static function getSubjectsListByLectorID($lector_id)
    {
        $group_id = intval($lector_id);

        $db = Db::getConnection();

        $result = $db->query('SELECT s.id AS idsubj, r.id_group, s.subject_name, l.lector_fio, r.num_lab, r.num_rgr, g.group_name, r.id AS rel_id, l.id AS idlect'
            . ' FROM subjects s'
            . ' INNER JOIN relations_gr_subj_lect r ON s.id=r.id_subject'
            . ' INNER JOIN groups g ON g.id=r.id_group'
            . ' INNER JOIN lectors l ON l.id=r.id_lector'
            . ' WHERE r.id_lector=' . $lector_id);

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $SubjectsList[$i]['idsubj'] = $row['idsubj'];
            $SubjectsList[$i]['id_group'] = $row['id_group'];
            $SubjectsList[$i]['subject_name'] = $row['subject_name'];
            $SubjectsList[$i]['lector_fio'] = $row['lector_fio'];
            $SubjectsList[$i]['num_lab'] = $row['num_lab'];
            $SubjectsList[$i]['num_rgr'] = $row['num_rgr'];
            $SubjectsList[$i]['group_name'] = $row['group_name'];
            $SubjectsList[$i]['rel_id'] = $row['rel_id'];
            $SubjectsList[$i]['idlect'] = $row['idlect'];
            $i++;
        }

        return $SubjectsList;
    }

    public static function getSubjectsList()
    {

        $db = Db::getConnection();

        $result = $db->query('SELECT *'
            . ' FROM subjects'
            . ' ORDER BY id');

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $SubjectsList[$i]['id'] = $row['id'];
            $SubjectsList[$i]['subject_name'] = $row['subject_name'];
            $i++;
        }

        return $SubjectsList;
    }
}