<?php
/**
 * Контроллер FeedbackController
 */

class FeedbackController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require "template/libs/rb.php";
        R::setup( 'mysql:host=localhost;dbname=feit', 'root', '' );
        $data = $_POST;
        $mail_succes = false;
        if(isset($data['do_mail'])){
            $mail = R::load('mail');
            $mail->new_fio = $data['new_fio'];
            $mail->new_email = $data['new_email'];
            $mail->data_time = date("d F Y H:i");
            $mail->mail_read = false;
            $mail->for_signup = false;
            $mail->message = $data['message'];
            R::store($mail);
            $mail_succes = true;
        }

        // Подключаем вид
        require_once(ROOT . '/views/feedback/index.php');
        return true;
    }

}