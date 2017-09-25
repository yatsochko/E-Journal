<?php include ROOT . '/views/lector/marks_header.php'; ?>

<?php if(isset($_SESSION['lector_id'])){ ?>
    <nav class="navbar navbar-inverse  navbar-fixed shadow-nav" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">E-Journal FEІT</a>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><?=$_SESSION['logged_user']?><span class="sr-only">(current)</span></a></li>
                    <li><a href="/lector">Повернутися у кабінет</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout">Вихід</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <br>

    <div class="divtable shadow">
        <table class="table table-hover">
            <thead>
            <tr>
                <th id="numcell">#</th>
                <th id="fio">Прізвище Ім’я</th>
                <?php
                $cl=0;
                while($numLAB!=0){
                    $cl++;
                    ?>
                    <th id="markh" class='<?php echo "lab$cl"; ?>'>ЛАБА<?=$cl?></th>
                    <?php
                    $numLAB--;
                }
                ?>
                <?php
                $cr=0;
                while($numRGR!=0){
                    $cr++;
                    ?>
                    <th id="markh" class='<?php echo "rgr$cr"; ?>'><span>  </span>РГР<?=$cr?><span>  </span></th>
                    <?php
                    $numRGR--;
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php $number=0; foreach($StudentList as $student): $number ++; ?>
                <tr>
                    <td id="numcell"><?=$number?></td>
                    <td><?=$student['student_fio']?></td>
                    <?php $mark = LectorController::getMarks($subject_id, $student['id']); ?>
                    <?php $i=$numLAB2; $c=1; while($i!=0) { ?>
                        <td id="mark" class='<?php echo "lab$c"; ?>' onmouseover="lightcol('<?php echo "lab$c"; ?>'); light(this)" onmouseout="unlightcol('<?php echo "lab$c"; ?>')" contenteditable="true" onBlur="saveToDatabase(this,'<?php echo "lab$c"; ?>','<?php echo $mark['id']; ?>')" onClick="showEdit(this);"><?= $mark["lab$c"] ?></td>
                        <?php $i--; $c++; } $l=$numRGR2; $k=1; while($l!=0) { ?>
                        <td id="mark" class='<?php echo "rgr$k"; ?>' onmouseover="lightcol('<?php echo "rgr$k"; ?>'); light(this)" onmouseout="unlightcol('<?php echo "rgr$k"; ?>')" contenteditable="true" onBlur="saveToDatabase(this,'<?php echo "rgr$k"; ?>','<?php echo $mark['id']; ?>')" onClick="showEdit(this);"><?= $mark["rgr$k"] ?></td>
                        <?php $l--;$k++; } ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>

<?php }else{ include ROOT . '/views/layouts/error.php'; }?>

<?php include ROOT . '/views/layouts/footer.php'; ?>

