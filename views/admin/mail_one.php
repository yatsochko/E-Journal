<?php
if(isset($_SESSION['admin'])){
    $email = $mail[0]['new_email'];
    $fio = $mail[0]['new_fio'];
    $message = $mail[0]['message'];
    require_once("../models_admin/dbcontroller.php");
    $updquery = "UPDATE mail SET mail_read = '1' WHERE id='$mail_id'";
    $result = mysql_query($updquery);
    $data = $_POST;
    if(isset($data['do_write'])){
        $errors = array();
        if(empty($errors)){
            $new_fio = $data['fio'];
            $query = "INSERT INTO lectors (lector_fio) VALUES ('$new_fio')";
            mysqli_query($link, $query);
            $new_id =  mysqli_insert_id($link);
            $_SESSION['do_signup_lector'] = true;
            $_SESSION['idOFnew_lector'] = $new_id;
            $_SESSION['emailOFnew_lector'] = $data['email'];
            $_SESSION['fioOFnew_lector'] = $data['fio'];
            header('Location:../models_admin/signup_lector.php');
        }
    }
    if(isset($data['do_cancel'])){
        $errors = array();
        if(empty($errors)){
            $new_fio = $data['fio'];
            $_SESSION['do_cencel'] = true;
            $_SESSION['emailOFnew_lector'] = $data['email'];
            $_SESSION['fioOFnew_lector'] = $data['fio'];
            header('Location:../models_admin/signup_lector.php');
        }
    }
    if(isset($data['do_feedback'])){
        $errors = array();
        if(empty($errors)){
            $mess = $data['mess'];
            $fio = $data['fio'];
            $to  = $data['email'];
            $subject = "Відповідь адміністратора на відгук E-Journal FEІT";
            $message = '
            <html>
            <head>
            </head>
            <body>
            <div style="background-color: #e8e8e8; padding: 20px">
            <div style="background-color: white; margin: 20px; padding: 7px">
            <h2 style="text-align: center">E-Journal FEІT</h2>
            <p style="font-size: 17px">Шановний, <strong>'.$fio.'</strong></p>
            <p>'.$mess.'</p>
            </div>
            </div>
            </body>
            </html>';
            $headers  = "Content-type: text/html; charset=utf-8 \r\n";
            $headers .= "From: admin@feit.adr.com.ua\r\n";
            mail($to, $subject, $message, $headers);
            header('Location:admin_mail.php');
        }
    }
}
?>
<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>E-Journal FEІT</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/mystyle.css">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../css/bootstrap.js"></script>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">
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
                        <a class="navbar-brand" href="../index.php">E-Journal FEІT</a>
                    </div>
                    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1px;">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href=""><?=$_SESSION['logged_user']?><span class="sr-only">(current)</span></a></li>
                            <li><a href="../views_admin/admin.php">Управління</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="../models_admin/logout.php">Вихід</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="btn-group btn-group-justified" style="margin-bottom: 15px; margin-top: -10px">
                <a href="admin_mail.php" class="btn btn-default">Назад</a>
            </div>
            <?php if($for_signup){ ?>
                <div class="well bs-component shadow" style="float: right; width: 50%">
                    <form class="form-horizontal" action="admin_mail_proc.php" method="post">
                        <fieldset>
                            <legend>Запит на реєстрацію</legend>
                            <input type="hidden" value="<?=$email?>" name="email">
                            <div class="form-group">
                                <label for="inputLogin" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputLogin" value="<?=$email?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLogin" class="col-lg-2 control-label">FIO</label>
                                <div class="col-lg-10">
                                    <input name="fio" type="text" class="form-control" id="inputLogin" value="<?=$fio?>" spellcheck="false">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button name="do_write" type="submit" class="btn btn-success" style="width: 100%">Додати викладача до БД</button>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button name="do_cancel" type="submit" class="btn btn-danger" style="width: 100%">Скасувати заяву</button>
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
            <?php }else{ ?>
                <div class="well bs-component shadow">
                    <form class="form-horizontal" action="admin_mail_proc.php" method="post">
                        <fieldset>
                            <legend>Відповідь на відгук</legend>
                            <input type="hidden" value="<?=$email?>" name="email">
                            <input type="hidden" value="<?=$fio?>" name="fio">
                            <div class="form-group">
                                <label for="inputLogin" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputLogin" value="<?=$email?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Вігук від <?=$fio?></label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" id="textArea" disabled="disabled"><?=$message?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Вігук від <?=$fio?></label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" id="textArea" spellcheck="false" name="mess">Шановний, <?=$fio?> Дякуємо за ваш відгук.</textarea>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button name="do_feedback" type="submit" class="btn btn-info" style="width: 100%">Надіслати відповідь на email</button>
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
            <?php } ?>
        <?php }else{ ?>
            <nav class="navbar navbar-inverse shadow-nav">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../index.php">E-Journal FEIT</a>
                    </div>
                </div>
            </nav>
            <div class="alert alert-dismissible alert-warning">
                <h3>Access error!</h3>
                <p>У вас немає прав для перегляду цієї сторіники <a href="login.php" class="alert-link">Авторизуватися</a></p>
            </div>
        <?php } ?>
    </div>
    </div>
    </body>
</hmtl>