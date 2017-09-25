<?php include ROOT . '/views/layouts/header.php'; ?>

<ul class="nav nav-tabs">
    <li class="<?php if($GroupsList[0]['id_course']==1) echo "active"; ?>"><a href="/course/1">1-й курс</a></li>
    <li class="<?php if($GroupsList[0]['id_course']==2) echo "active"; ?>"><a href="/course/2">2-й курс</a></li>
    <li class="<?php if($GroupsList[0]['id_course']==3) echo "active"; ?>"><a href="/course/3">3-й курс</a></li>
    <li class="<?php if($GroupsList[0]['id_course']==4) echo "active"; ?>"><a href="/course/4">4-й курс</a></li>
</ul>

<ul class="nav nav-tabs">
    <?php foreach ($GroupsList as $groupItem): ?>
        <li class="<?php if($groupItem['id']==$group_id) echo "active"; ?>">
            <a href="/course/<?=$groupItem['id_course']?>/group/<?=$groupItem['id']?>"><?=$groupItem['group_name']?></a>
        </li>
    <?php endforeach ?>
</ul>

<br>

<ul class="list-group shadow-ntop" style="padding: 25px; border-top: 1px dashed rgba(221, 221, 221, 1)">
    <?php
    foreach($SubjectList as $subjectItem):
        ?>
        <li class="list-group-item" style="border-left: none; border-right: none" id="subjlist">
            <span class="badge"><?=$subjectItem['lector_fio']?></span>
            <a style="font-size: 17px; font-weight: 500; text-decoration: none;" href="/course/<?=$course_id?>/group/<?=$group_id?>/subject/<?=$subjectItem['id_subject']?>"><?=$subjectItem['subject_name']?></a>
        </li>
        <?php
    endforeach
    ?>
</ul>

<?php include ROOT . '/views/layouts/footer.php'; ?>