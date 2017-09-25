<?php include ROOT . '/views/admin/admin_header.php'; ?>

<?php if($_SESSION['admin']){ ?>

    <nav class="navbar navbar-default  navbar-fixed shadow-nav" role="navigation">
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
                    <li><a href="/admin/mail/list">Пошта<span class="mail_num"><?=$new_num?></span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout">Вихід</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Викладачі та предмети</a></li>
        <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Групи та студенти</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <div class="divtable shadow" style="width:55%; float: left; min-width: 400px; margin-bottom: 15px; margin-top: 15px">
                <button onclick="style.display='none'; show('true')" class="btn btn-default" id="but" style="width: 100%">Додати викладача</button>
                <div id="addForm" style="display: none">
                    <div style="margin-bottom: 10px">
                        <input name="new_fio" type="text" class="form-control" id="input_val" placeholder="Прізвище І.П." spellcheck="false">
                    </div>
                    <div style="margin-bottom: 10px">
                        <button name="do_mail" type="submit" class="btn btn-success" style="width: 100%" onclick="addLector()">Додати викладача</button>
                    </div>
                </div>
                <table class="table table-hover" id="refr">
                    <thead>
                    <tr>
                        <td id="namecell">Призвіще І.П.</td>
                        <td class="thcell">login</td>
                        <td id="emcell" class="thcell">email</td>
                        <td class="thcell">delete</td>
                    </tr>
                    </thead>
                    <tbody id="tab1">
                    <?php
                    $number=1;
                    foreach($LectorsList as $lector):
                        ?>
                        <tr id="remove<?php echo $lector['id'];?>" class="<?php if(($lector['login'])!=""){ echo "success"; }?>">
                            <td id="namecell"><?=$lector['lector_fio']?></td>
                            <td id=""><?=$lector['login']?></td>
                            <td id="emcell" contenteditable="true" onBlur="saveToDatabase(this,'email','<?php echo $lector['id']; ?>','<?php echo $lector['lector_fio']; ?>')" onClick="showEdit(this);"><?=$lector['email']?></td>
                            <td id="del_icon"><img src="/template/images/delete.png" onclick="delete_lector('<?php echo $lector['id']; ?>','<?php echo $lector['lector_fio']; ?>')" style="height: 17px;"></td>
                        </tr>
                        <?php
                        $number++;
                    endforeach
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="divtable shadow" style="width:45%; float: right; min-width: 300px; margin-bottom: 15px; margin-top: 15px">
                <button onclick="style.display='none'; show('false')" class="btn btn-default" id="but2" style="width: 100%">Додати предмет</button>
                <div id="addForm2" style="display: none">
                    <div style="margin-bottom: 10px">
                        <input name="new_subject" type="text" class="form-control" id="input_val2" placeholder="Прізвище І.П." spellcheck="false">
                    </div>
                    <div style="margin-bottom: 10px">
                        <button name="do_mail" type="submit" class="btn btn-info" style="width: 100%" onclick="addSubject()">Додати предмет</button>
                    </div>
                </div>
                <table class="table table-hover" id="refr">
                    <thead>
                    <tr>
                        <td id="namecell">Назва предмету</td>
                        <td class="thcell">delete</td>
                    </tr>
                    </thead>
                    <tbody id="tab2">
                    <?php
                    foreach($SubjectsList as $subject):
                        ?>
                        <tr id="removesub<?php echo $subject['id'];?>">
                            <td id="namecell"><?=$subject['subject_name']?></td>
                            <td id="del_icon"><img src="/template/images/delsub.png" onclick="delete_subject('<?php echo $subject['id']; ?>','<?php echo $subject['subject_name']; ?>')" style="height: 17px;"></td>
                        </tr>
                        <?php
                    endforeach
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <ul class="nav nav-tabs">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        1-й курс <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($groups1st as $group1){ ?>
                            <li><a href="#dropdown<?php echo $group1['id']; ?>" data-toggle="tab" onclick="show_student('<?php echo $group1['id']; ?>')"><?=$group1['group_name']?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        2-й курс <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($groups2st as $group2){ ?>
                            <li><a href="#dropdown<?php echo $group2['id']; ?>" data-toggle="tab" onclick="show_student('<?php echo $group2['id']; ?>')"><?=$group2['group_name']?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        3-й курс <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($groups3st as $group3){ ?>
                            <li><a href="#dropdown<?php echo $group3['id']; ?>" data-toggle="tab" onclick="show_student('<?php echo $group3['id']; ?>')"><?=$group3['group_name']?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        4-й курс <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($groups4st as $group4){ ?>
                            <li><a href="#dropdown<?php echo $group4['id']; ?>" data-toggle="tab" onclick="show_student('<?php echo $group4['id']; ?>')"><?=$group4['group_name']?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content result">

            </div>
            <div class="well bs-component shadow" style="float: right; width: 45%; margin-top: 15px">
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Додати студента</legend>
                        <div class="form-group">
                            <label for="inputLogin" class="col-lg-2 control-label">Призвіще Ім'я</label>
                            <div class="col-lg-10">
                                <input name="new_stud_fio" type="text" class="form-control" id="inputLogin">
                            </div>
                        </div>
                        <div id="course_group">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Оберіть курс</label>
                                <div class="col-lg-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" onclick="goto_groups(1)">
                                            1-й курс
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="goto_groups(2)">
                                            2-й курс
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" onclick="goto_groups(3)">
                                            3-й курс
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="goto_groups(4)">
                                            4-й курс
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-primary" style="width: 100%" onclick="addStudent()">Додати студента</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div style="display: none">
        <div class="form-group" id="resetradio">
            <label class="col-lg-2 control-label">Оберіть курс</label>
            <div class="col-lg-10">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" onclick="goto_groups(1)">
                        1-й курс
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="goto_groups(2)">
                        2-й курс
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" onclick="goto_groups(3)">
                        3-й курс
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="goto_groups(4)">
                        4-й курс
                    </label>
                </div>
            </div>
        </div>
    </div>

<?php }else{ include ROOT . '/views/layouts/error.php'; }?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
