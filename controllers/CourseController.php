<?php
/**
 * Контроллер CourseController
 */

include_once ROOT . '/models/Group.php';

class CourseController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex($course_id)
    {
        $GroupsList = Group::getGroupsListByIdCourse($course_id);

        // Подключаем вид
        require_once(ROOT . '/views/course/index.php');
        return true;
    }

}