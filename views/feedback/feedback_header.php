<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>E-Journal FEІT</title>
        <link rel="stylesheet" href="/template/css/style.css">
        <link rel="stylesheet" href="/template/css/mystyle.css">
        <script src="https://code.jquery.com/jquery.js"></script>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">
        <nav class="navbar <?php if(!$_SESSION['admin']){ echo "navbar-inverse"; }else{ echo "navbar-default";}?>  navbar-fixed shadow-nav" role="navigation">
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
                        <?php if(isset($_SESSION['logged_user'])){ ?>
                            <li class="active"><a href="#"><?=$_SESSION['logged_user']?><span class="sr-only">(current)</span></a></li>
                            <?php if(!$_SESSION['admin']){ ?>
                                <li><a href="/lector">Оцінки</a></li>
                            <?php }else{ ?>
                                <li><a href="/admin">Управління</a></li>
                            <?php }} ?>
                    </ul>
                    <form class="navbar-form navbar-left" role="search"">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" spellcheck="false">
                    </div>
                    <button type="submit" class="btn btn-default" style="height: 31px; font-size: 13px">Пошук</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($_SESSION['logged_user'])){ ?>
                            <li><a href="/logout">Вихід</a></li>
                        <?php }else{ ?>
                            <li><a href="/login">Вхід</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>