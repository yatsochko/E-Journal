<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>E-Journal FEІT</title>
        <link rel="stylesheet" href="/template/css/style.css">
        <link rel="stylesheet" href="/template/css/mystyle.css">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="/template/js/bootstrap.js"></script>
        <script>
            function del_letter(id){
                $.ajax({
                    url: "/admin/ajax/deletemail",
                    type: "POST",
                    data:'id='+id,
                    success: function(data){

                    }
                });
            }
        </script>
        <style>
            .mail_hover{
                background-color: #F5F5F5;
            }
        </style>
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
                        <a class="navbar-brand" href="/">E-Journal FEІT</a>
                    </div>
                    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1px;">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href=""><?=$_SESSION['logged_user']?><span class="sr-only">(current)</span></a></li>
                            <li><a href="/admin">Управління</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/logout">Вихід</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="list-group">
                <?php foreach($MailList as $letters){ ?>
                    <a href="/admin/mail_one/<?=$letters['id']?>" style="font-weight: 500" class="list-group-item <?php
                    if(!$letters['mail_read']){ echo "mail_hover"; }
                    ?>"><span style="margin-right: 15px; font-weight: 200"><?=$letters['data_time']?></span><?php if($letters['for_signup']){ echo "Заява на реєстрацію від "; }else { echo "Відгук на сайті від "; } ?>
                        <?=$letters['new_fio']?><button type="button" style="margin-left: 10px" class="close" data-dismiss="alert" onclick="del_letter('<?php echo $letters['id']; ?>')">&times;</button>
                    </a>
                <?php } ?>
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
                <p>У вас немає прав для перегляду цієї сторіники <a href="/login" class="alert-link">Авторизуватися</a></p>
            </div>
        <?php } ?>
    </div>
    </div>
    </body>
</hmtl>