<?php
define('MYSQL_SERVER', 'mysql.zzz.com.ua');
define('MYSQL_USER', 'feit');
define('MYSQL_PASSWORD', 'script777');
define('MYSQL_DB', 'feit');

function db_connect(){
    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
    or die("Error: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8")){
        printf("Error: ".mysqli_error($link));}
    return $link;
}
$link = db_connect();
$lectorID = $id;
$lectorCodeword = $codeword;
$query = "SELECT codeword, lector_fio, email FROM lectors WHERE id = '$lectorID'";
$result = mysqli_query($link, $query);
$temp = mysqli_fetch_assoc($result);
$trueCodeword = $temp['codeword'];
$lectorFIO = $temp['lector_fio'];
$lectorEmail = $temp['email'];
function translit($string) {
    $charlist = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"," "=>"_"
    );
    $aftertr = (strtr($string,$charlist));
    $cut = substr($aftertr, 0, -5);
    return strtolower($cut);
}
$translitFIO = translit($lectorFIO);
if($trueCodeword == $lectorCodeword){
    $access_signup = true;
}else{
    $access_signup = false;
}
require_once "template/libs/rb.php";
R::setup( 'mysql:host=mysql.zzz.com.ua;dbname=feit',
    'feit', 'script777' );
$data = $_POST;
if(isset($data['do_signup'])){
    $errors = array();
    if(trim($data['login'])==""){
        $errors[]='Введіть логін!';
    }
    if(trim($data['password'])==""){
        $errors[]='Введіть пароль!';
    }
    if(($data['password2'])!=$data['password']){
        $errors[]='Паролі не співпадають!';
    }
    if(R::count('lectors',"login = ?",array($data['login']))>0){
        $errors[]='Користувач з таким логіном вже ісунує!!';
    }
    if(empty($errors)){
        $id = $lectorID;
        $lector = R::load('lectors', $data['id']);
        $lector->login = $data['login'];
        $lector->password = md5($data['password']);
        $lector->codeword = "";
        R::store($lector);
        $_SESSION['admin'] = false;
        $_SESSION['logged_user'] = $data['fio'];
        $_SESSION['lector_id'] = $data['id'];
        header('Location:/lector');
    }
}
?>
<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="UTF-8">
        <title>E-Journal FEІT</title>
        <link rel="stylesheet" href="/template/css/style.css">
        <link rel="stylesheet" href="/template/css/mystyle.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">
        <?php if($access_signup){ ?>
            <nav class="navbar navbar-inverse shadow-nav">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">E-Journal FEIT</a>
                    </div>
                </div>
            </nav>
            <div class="well well-lg" style="float: left; width: 47%; font-size: 15px; text-align: justify">
                <p>Шановний(а), <strong><?=$lectorFIO?></strong> вітаємо Вас на сайті "E-Journal FEIT". Зареєструватися легко, як ніколи. Придумайте унікальний логін та надійний пароль.
                    Ще одне натискання і на Вас вже чекають всі ваші предмети, групи та студенти.</p>
                <img src="/template/images/GIF3.gif" alt="Пример" width="100%">
            </div>
            <div class="well bs-component shadow" style="float: right; width: 50%">
                <form class="form-horizontal" action="signup.php" method="post">
                    <fieldset>
                        <legend>Реєстрація</legend>
                        <input type="hidden" value="<?=$lectorID?>" name="id">
                        <input type="hidden" value="<?=$lectorFIO?>" name="fio">
                        <div class="form-group">
                            <label for="inputLogin" class="col-lg-2 control-label">FIO</label>
                            <div class="col-lg-10">
                                <input name="login" type="text" class="form-control" id="inputLogin" placeholder="<?=$lectorFIO?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLogin" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input name="login" type="text" class="form-control" id="inputLogin" placeholder="<?=$lectorEmail?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLogin" class="col-lg-2 control-label">Login</label>
                            <div class="col-lg-10">
                                <input name="login" type="text" class="form-control" id="inputLogin" placeholder="Enter login. For example: <?=$translitFIO?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Confirm password</label>
                            <div class="col-lg-10">
                                <input name="password2" type="password" class="form-control" id="inputPassword" placeholder="Confirm your password">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button name="do_signup" type="submit" class="btn btn-primary" style="width: 100%">Sign up</button>
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
            <nav class="navbar navbar-inverse shadow-nav">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">E-Journal FEIT</a>
                    </div>
                </div>
            </nav>
            <div class="alert alert-dismissible alert-warning">
                <h3>Access error!</h3>
                <p>Ви не отримали права зареєструватися!</p>
            </div>
        <?php } ?>
    </div>
    </body>
</hmtl>