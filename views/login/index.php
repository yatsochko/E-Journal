<?php include ROOT . '/views/login/login_header.php'; ?>

<?php if(!isset($_SESSION['logged_user'])){ ?>

    <nav class="navbar navbar-inverse shadow-nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">E-Journal FEIT</a>
            </div>
        </div>
    </nav>
    <blockquote style="float: left; width: 47%; font-size: 15px; text-align: justify">
        <p>Реєстрація викладачів проводиться по запрошенням. Будь ласка, перевірте свою електронну пошту для отримання подальших інструкцій.</p>
        <p class="text-muted">Якщо на пошту не прийшло повідомлення, то можливо у базі данних немає інформації про вас. Напишіть адміністратору та отримайте запрошення найближчим часом.</p>
        <?php if($mail_succes){ ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Дякуємо! Ваш запит відправленний на обробку адміністртоору.</strong> Чекайте відповіді на Вашу електронну адресу <strong> <?php echo $data['new_email']; ?></strong>
            </div>
        <?php }else{ ?>
            <button onclick="style.display='none'; show()" class="btn btn-default" id="but" style="width: 100%">Написати адміністратору</button>
            <div id="adminM" style="display: none">
                <form class="form-horizontal" action="/login" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputFIO" class="col-lg-2 control-label">FIO</label>
                            <div class="col-lg-10">
                                <input name="new_fio" type="text" class="form-control" id="inputFIO" placeholder="Прізвище І.П.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input name="new_email" type="email" class="form-control" id="inputEmail" placeholder="example@gmail.com">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button name="do_mail" type="submit" class="btn btn-success" style="width: 100%">Send</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        <?php } ?>
    </blockquote>
    <div class="well bs-component shadow" style="float: right; width: 50%">
        <form class="form-horizontal" action="/login" method="post">
            <fieldset>
                <legend>Авторизація</legend>
                <div class="form-group">
                    <label for="inputLogin" class="col-lg-2 control-label">Login</label>
                    <div class="col-lg-10">
                        <input name="login" type="text" class="form-control" id="inputLogin" placeholder="Login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button name="do_login" type="submit" class="btn btn-primary" style="width: 100%">Log in</button>
                    </div>
                </div>
                <?php
                if(!empty($errors)){
                    ?>
                    <div class="form-group">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            <div class="alert alert-danger">
                                <strong><?=array_shift($errors)?></strong> Спробуйте ввести знову. <a href="#" class="alert-link">Забули логін або пароль?</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </fieldset>
        </form>
    </div>

<?php }else{ include ROOT . '/views/login/error.php'; }?>

<?php include ROOT . '/views/layouts/footer.php'; ?>