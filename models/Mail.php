<?php

class Mail
{
    public static function getMailList()
    {

        $db = Db::getConnection();

        $result = $db->query('SELECT *'
            . ' FROM mail'
            . ' ORDER BY id');

        $result->setFetchMode(PDO::FETCH_ASSOC); //[id] => 2

        $i = 0;
        while ($row = $result->fetch()) {
            $MailList[$i]['id'] = $row['id'];
            $MailList[$i]['new_fio'] = $row['new_fio'];
            $MailList[$i]['new_email'] = $row['new_email'];
            $MailList[$i]['mail_read'] = $row['mail_read'];
            $MailList[$i]['data_time'] = $row['data_time'];
            $MailList[$i]['for_signup'] = $row['for_signup'];
            $MailList[$i]['message'] = $row['message'];
            $i++;
        }

        return $MailList;
    }

    public static function getMailOne($id)
    {
        return $id;
    }
}