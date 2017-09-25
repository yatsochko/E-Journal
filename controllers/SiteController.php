<?php
/**
 * Контроллер SiteController
 */

class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {

        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

}
