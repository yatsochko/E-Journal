<?php include ROOT . '/views/feedback/feedback_header.php'; ?>

<div class="well bs-component shadow" style="float: right; width: 50%">
    <form class="form-horizontal" action="/feedback" method="post">
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
            <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Текст повідомленя</label>
                <div class="col-lg-10">
                    <textarea name="message" class="form-control" rows="3" id="textArea"></textarea>
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

<?php include ROOT . '/views/layouts/footer.php'; ?>