<?php include ROOT . '/views/lector/lector_header.php'; ?>

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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout">Вихід</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <table class="table table_lec table-hover shadow">
        <thead>
        <tr>
            <td id="fcell">#</td>
            <td>Предмет</td>
            <td id="gcell">Группа</td>
            <td id="ncell">Лабы</td>
            <td id="ncell">РГР</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $number=1;
        foreach($SubjectList as $subject):
            ?>
            <tr>
                <td id="fcell"><?=$number?></td>
                <td><a href="/lector/marks/<?=$subject['id_group']?>/<?=$subject['idsubj']?>"><?=$subject['subject_name']?></a></td>
                <td id="gcell"><?=$subject['group_name']?></td>
                <td id="ncell" contenteditable="true" onBlur="saveToDatabase(this,'num_lab','<?php echo $subject['rel_id']; ?>','<?php echo $subject['id_group']; ?>','<?php echo $subject['idsubj']; ?>')" onClick="showEdit(this);"><?=$subject['num_lab']?></td>
                <td id="ncell" contenteditable="true" onBlur="saveToDatabase(this,'num_rgr','<?php echo $subject['rel_id']; ?>','<?php echo $subject['id_group']; ?>','<?php echo $subject['idsubj']; ?>')" onClick="showEdit(this);"><?=$subject['num_rgr']?></td>
            </tr>
            <?php
            $number++;
        endforeach
        ?>
        </tbody>
    </table>

<?php }else{ include ROOT . '/views/layouts/error.php'; }?>

<?php include ROOT . '/views/layouts/footer.php'; ?>