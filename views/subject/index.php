<?php include ROOT . '/views/layouts/header.php'; ?>
<script src="/template/js/subject.js"></script>

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

<div class="divtable shadow-ntop">
    <table class="table table-hover">
        <thead>
        <tr>
            <th id="numcell">#</th>
            <th>Прізвище Ім’я</th>
            <?php $cl=0; while($numLAB!=0){ $cl++; ?>
                <th id="markh" class='<?php echo "lab$cl"; ?>'>ЛАБА<?=$cl?></th>
            <?php $numLAB--; } ?>
            <?php $cr=0; while($numRGR!=0){ $cr++; ?>
                <th id="markh" class='<?php echo "rgr$cr"; ?>'><span>  </span>РГР<?=$cr?><span>  </span></th>
            <?php $numRGR--; } ?>
        </tr>
        </thead>
        <tbody>
        <?php $number=0; foreach($StudentList as $student): $number ++; ?>
            <tr>
                <td id="numcell"><?=$number?></td>
                <td><?=$student['student_fio']?></td>
                <?php $mark = SubjectController::getMarks($subject_id, $student['id']); ?>
                <?php $i=$numLAB2; $c=1; while($i!=0) { ?>
                    <td id="mark" class='<?php echo "lab$c"; ?>' onmouseover="lightcol('<?php echo "lab$c"; ?>'); light(this)" onmouseout="unlightcol('<?php echo "lab$c"; ?>')"><?= $mark["lab$c"] ?></td>
                <?php $i--; $c++; } $l=$numRGR2; $k=1; while($l!=0) { ?>
                    <td id="mark" class='<?php echo "rgr$k"; ?>' onmouseover="lightcol('<?php echo "rgr$k"; ?>'); light(this)" onmouseout="unlightcol('<?php echo "rgr$k"; ?>')"><?= $mark["rgr$k"] ?></td>
                <?php $l--;$k++; } ?>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<!---->
<?php
//echo '<pre>';
//print_r($NumberLabsAndRgrs);
//print_r($StudentList);
//echo '</pre>';
//?>
<!---->

<?php include ROOT . '/views/layouts/footer.php'; ?>
