<?php
/**
 * Контроллер GroupController
 */

include_once ROOT . '/models/Group.php';
include_once ROOT . '/models/Subject.php';

class GroupController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex($course_id, $group_id)
    {
        $GroupsList = Group::getGroupsListByIdCourse($course_id);

        $SubjectList = Subject::getSubjectsListByIdGroup($group_id);

        // Подключаем вид
        require_once(ROOT . '/views/group/index.php');
        return true;
    }

}