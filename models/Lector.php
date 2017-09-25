<?php

class Lector
{
    public static function getLectorsList()
    {

        $db = Db::getConnection();

        $result = $db->query('SELECT *'
            . ' FROM lectors'
            . ' ORDER BY id');

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $LectorsList[$i]['id'] = $row['id'];
            $LectorsList[$i]['lector_fio'] = $row['lector_fio'];
            $LectorsList[$i]['login'] = $row['login'];
            $LectorsList[$i]['email'] = $row['email'];
            $i++;
        }

        return $LectorsList;
    }
}