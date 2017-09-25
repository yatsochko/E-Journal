<?php
/**
 * Контроллер LogoutController
 */

class LogoutController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        unset($_SESSION['logged_user']);
        unset($_SESSION['lector_id']);
        unset($_SESSION['logged_admin']);
        unset($_SESSION['admin']);
        // Подключаем вид
        header('Location:/');
        return true;
    }

}