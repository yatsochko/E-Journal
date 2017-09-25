<?php

/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 25.09.2017
 * Time: 5:29
 */
class SignupController
{
    public function actionIndex($id, $codeword)
    {
//        echo $id;
//        echo $codeword;
        require_once(ROOT . '/views/signup/index.php');

        return true;
    }
}