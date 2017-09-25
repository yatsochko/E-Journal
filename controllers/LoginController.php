<?php
/**
 * Контроллер LoginController
 */


class LoginController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require "/template/libs/rb.php";
        R::setup( 'mysql:host=localhost;dbname=feit', 'root', '' );
        $data = $_POST;
        $mail_succes = false;
        if(isset($data['do_mail'])){
            $mail = R::load('mail');
            $mail->new_fio = $data['new_fio'];
            $mail->new_email = $data['new_email'];
            $mail->data_time = date("d F Y H:i");
            $mail->mail_read = false;
            $mail->for_signup = true;
            R::store($mail);
            $mail_succes = true;
        }
        if(isset($data['do_login'])){
            $errors = array();
            if($data['login']=="admin"){
                if($data['password'] == "111"){
                    $_SESSION['logged_user'] = "Адміністратор";
                    $_SESSION['admin'] = true;
                    header('Location:/admin');
                }else{
                    $errors[] = 'Невірно введенний пароль!';
                }
            }else{
                if($data['login']){
                    $user = R::findOne('lectors', 'login = ?', array($data['login']));
                }
                if($user){
                    if(md5($data['password']) == $user->password){
                        $_SESSION['admin'] = false;
                        $_SESSION['logged_user'] = $user->lector_fio;
                        $_SESSION['lector_id'] = $user->id;
                        $id=$user->id;
                        header('Location:/lector');
                    }else{
                        $errors[] = 'Невірно введенний пароль!';
                    }
                }else{
                    $errors[] = 'Користувача с таким логіном не існує!';
                }
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/login/index.php');
        return true;
    }

}