<?php
if($_SESSION['do_signup_lector']){
    $_POST["column"]="email";
    $_POST["editval"]=$_SESSION['emailOFnew_lector'];
    $_POST["id"]=$_SESSION['idOFnew_lector'];
    $_POST['fio']=$_SESSION['fioOFnew_lector'];
}
if(!$_SESSION['do_cencel']){
    $dbhost = "mysql.zzz.com.ua";
    $dbusername = "feit";
    $dbpassword = "script777";
    $dbname = "feit";
    $connection = mysql_connect($dbhost, $dbusername, $dbpassword) or die('Could not connect');
    $db = mysql_select_db($dbname);
    $result = mysql_query("UPDATE lectors set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id=".$_POST["id"]);
    function generateCodeword(){
        $length = 8;
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    $codeword = md5(generateCodeword());
    $writeCodeword = mysql_query("UPDATE lectors set codeword = '".$codeword."' WHERE  id=".$_POST["id"]);
    $id = $_POST["id"];
    $fio = $_POST['fio'];
    $to  = $_POST["editval"];
    $subject = "Реєстрація на E-Journal FEІT";
    $message = '
<html>
<head>
<style>
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700");
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 8px 12px;
    font-size: 15px;
    line-height: 1.4;
    border-radius: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.btn:focus,
.btn:active:focus,
.btn.active:focus,
.btn.focus,
.btn:active.focus,
.btn.active.focus {
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}
.btn:hover,
.btn:focus,
.btn.focus {
    color: #333333;
    text-decoration: none;
}
.btn:active,
.btn.active {
    outline: 0;
    background-image: none;
    -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn.disabled,
.btn[disabled],
fieldset[disabled] .btn {
    cursor: not-allowed;
    opacity: 0.65;
    filter: alpha(opacity=65);
    -webkit-box-shadow: none;
    box-shadow: none;
}
a.btn.disabled,
fieldset[disabled] a.btn {
    pointer-events: none;
}
.btn-success {
    color: #ffffff;
    background-color: #43ac6a;
    border-color: #3c9a5f;
}
.btn-success:focus,
.btn-success.focus {
    color: #ffffff;
    background-color: #358753;
    border-color: #183e26;
}
.btn-success:hover {
    color: #ffffff;
    background-color: #358753;
    border-color: #2b6e44;
}
.btn-success:active,
.btn-success.active,
.open > .dropdown-toggle.btn-success {
    color: #ffffff;
    background-color: #358753;
    border-color: #2b6e44;
}
.btn-success:active:hover,
.btn-success.active:hover,
.open > .dropdown-toggle.btn-success:hover,
.btn-success:active:focus,
.btn-success.active:focus,
.open > .dropdown-toggle.btn-success:focus,
.btn-success:active.focus,
.btn-success.active.focus,
.open > .dropdown-toggle.btn-success.focus {
    color: #ffffff;
    background-color: #2b6e44;
    border-color: #183e26;
}
.btn-success:active,
.btn-success.active,
.open > .dropdown-toggle.btn-success {
    background-image: none;
}
.btn-success.disabled:hover,
.btn-success[disabled]:hover,
fieldset[disabled] .btn-success:hover,
.btn-success.disabled:focus,
.btn-success[disabled]:focus,
fieldset[disabled] .btn-success:focus,
.btn-success.disabled.focus,
.btn-success[disabled].focus,
fieldset[disabled] .btn-success.focus {
    background-color: #43ac6a;
    border-color: #3c9a5f;
}
.btn-success .badge {
    color: #43ac6a;
    background-color: #ffffff;
}
a{
    text-decoration: none;
}
</style>
</head>
<body>
<div style="background-color: #e8e8e8; padding: 20px">
<div style="background-color: white; margin: 20px; padding: 7px">
<h2 style="text-align: center">Ласкаво просимо до E-Journal FEІT</h2>
<p style="font-size: 17px">Вітаємо, <strong>'.$fio.'</strong></p>
<p>Для Вас вже створено аккаунт в електронному журналі ФЕІТ. Всі ваші предмети, групи та студенти вже чекають на Вас.
Для завершення реєстрації потрібно придумати логін та пароль для аутентифікації на сайті.
Після цього Ви отримаєте доступ до своєї особстої сторінки і матимете змогу виставляти оцінки студентам в електронному журналі.</p>
<p style="text-align: center"><a href="http://e-journal-feit.zzz.com.ua/signup/'.$id.'/'.$codeword.'" class="btn btn-success">Завершити реєстрацію</a></p>
</div>
</div>
</body>
</html>
';
    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: admin@e-journal-feit.zzz.com.ua\r\n";
    mail($to, $subject, $message, $headers);
}else{
    $fio = $_SESSION['fioOFnew_lector'];
    $to  = $_SESSION['emailOFnew_lector'];
    $subject = "Відповідь на запит рєстрації в E-Journal FEІT";
    $message = '
<html>
<head>
<style>
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700");
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 8px 12px;
    font-size: 15px;
    line-height: 1.4;
    border-radius: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.btn:focus,
.btn:active:focus,
.btn.active:focus,
.btn.focus,
.btn:active.focus,
.btn.active.focus {
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}
.btn:hover,
.btn:focus,
.btn.focus {
    color: #333333;
    text-decoration: none;
}
.btn:active,
.btn.active {
    outline: 0;
    background-image: none;
    -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn.disabled,
.btn[disabled],
fieldset[disabled] .btn {
    cursor: not-allowed;
    opacity: 0.65;
    filter: alpha(opacity=65);
    -webkit-box-shadow: none;
    box-shadow: none;
}
a.btn.disabled,
fieldset[disabled] a.btn {
    pointer-events: none;
}
.btn-success {
    color: #ffffff;
    background-color: #43ac6a;
    border-color: #3c9a5f;
}
.btn-success:focus,
.btn-success.focus {
    color: #ffffff;
    background-color: #358753;
    border-color: #183e26;
}
.btn-success:hover {
    color: #ffffff;
    background-color: #358753;
    border-color: #2b6e44;
}
.btn-success:active,
.btn-success.active,
.open > .dropdown-toggle.btn-success {
    color: #ffffff;
    background-color: #358753;
    border-color: #2b6e44;
}
.btn-success:active:hover,
.btn-success.active:hover,
.open > .dropdown-toggle.btn-success:hover,
.btn-success:active:focus,
.btn-success.active:focus,
.open > .dropdown-toggle.btn-success:focus,
.btn-success:active.focus,
.btn-success.active.focus,
.open > .dropdown-toggle.btn-success.focus {
    color: #ffffff;
    background-color: #2b6e44;
    border-color: #183e26;
}
.btn-success:active,
.btn-success.active,
.open > .dropdown-toggle.btn-success {
    background-image: none;
}
.btn-success.disabled:hover,
.btn-success[disabled]:hover,
fieldset[disabled] .btn-success:hover,
.btn-success.disabled:focus,
.btn-success[disabled]:focus,
fieldset[disabled] .btn-success:focus,
.btn-success.disabled.focus,
.btn-success[disabled].focus,
fieldset[disabled] .btn-success.focus {
    background-color: #43ac6a;
    border-color: #3c9a5f;
}
.btn-success .badge {
    color: #43ac6a;
    background-color: #ffffff;
}
a{
    text-decoration: none;
}
</style>
</head>
<body>
<div style="background-color: #e8e8e8; padding: 20px">
<div style="background-color: #ffcccc; margin: 20px; padding: 7px">
<h2 style="text-align: center">E-Journal FEІT</h2>
<p style="font-size: 17px">Шановний, <strong>'.$fio.'</strong></p>
<p>Нажаль, адміністратор не знайшов доказів, що Ви являетесь викладачем кафедри ФЕІТ. Якщо адміністратор помиляеться, будь ласка,
напишіть йому повідомлення з більшь докладною інформацією про Вас.</p>
<p style="text-align: center"><a href="http://e-journal-feit/feedback" class="btn btn-success">Написати адміністратору</a></p>
</div>
</div>
</body>
</html>
';
    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: admin@e-journal-feit.zzz.com.ua\r\n";
    mail($to, $subject, $message, $headers);
}
if($_SESSION['do_signup_lector']||$_SESSION['do_cencel']){
    unset($_SESSION['emailOFnew_lector']);
    unset($_SESSION['idOFnew_lector']);
    unset($_SESSION['fioOFnew_lector']);
    unset($_SESSION['do_signup_lector']);
    unset($_SESSION['do_cencel']);
    header('Location:/admin/mail/list');
}
?>