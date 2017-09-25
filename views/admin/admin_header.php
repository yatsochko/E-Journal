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
            function showEdit(editableObj) {
                $(editableObj).css("background","#FFF");
            }
            function saveToDatabase(editableObj,column,id,fio) {
                $(editableObj).css("background","#FFF url(/template/images/load.gif) no-repeat right");
                $.ajax({
                    url: "template/ajax/signup_lector.php?",
                    type: "POST",
                    data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&fio='+fio,
                    success: function(data){
                        $(editableObj).css("background","");
                    }
                });
            }
            function show(bool){
                if(bool=='true'){
                    var form = document.getElementById('addForm');
                    form.style.display='';
                }else{
                    var form = document.getElementById('addForm2');
                    form.style.display='';
                }
            }
            function show2(){
                var form = document.getElementById('addForm');
                form.style.display='';
            }
            function addLector(){
                var fio = $('input[name=new_fio]').val();
                $.getJSON("template/ajax/add_lector.php?fio="+fio,function(data){
                    $('#tab1').prepend("<tr id=\"remove"+data.data.id+"\">" +
                        "<td id=\"namecell\">"+data.data.fio+"</td>" +
                        "<td></td>" +
                        "<td id=\"emcell\" contenteditable=\"true\" onBlur=\"saveToDatabase(this,'email',\'"+data.data.id+"\',\'"+data.data.fio+"\'\)\" onClick=\"showEdit(this);\"></td>"+
                        "<td id=\"del_icon\"><img src=\"/template/images/delete.png\" onclick=\"delete_lector("+data.data.id+",\'"+data.data.fio+"\'\)\" style=\"height: 17px;\"></td>" +
                        "</tr>");
                    $('#input_val').val('').change();
                    var form = document.getElementById('addForm');
                    form.style.display='none';
                    var but1 = document.getElementById('but');
                    but1.style.display='';
                });
            }
            function delete_lector(id,fio){
                var isDelete = confirm("Ви дійсно хочете видалити " + fio + "?");
                if(isDelete){
                    $.ajax({
                        url: "/admin/ajax/deletelector",
                        type: "POST",
                        data:'id='+id,
                        success: function(data){
                            $("#remove"+id).remove();
                        }
                    });
                }
            }
            function addSubject(){
                var subject = $('input[name=new_subject]').val();
                $.getJSON("template/ajax/add_subject.php?subject="+subject,function(data){
                    $('#tab2').prepend("<tr id=\"removesub"+data.data.id+"\">" +
                        "<td id=\"namecell\">"+data.data.subject+"</td>" +
                        "<td id=\"del_icon\"><img src=\"/template/images/delsub.png\" onclick=\"delete_subject("+data.data.id+",\'"+data.data.subject+"\'\)\" style=\"height: 17px;\"></td>" +
                        "</tr>");
                    $('#input_val2').val('').change();
                    var form = document.getElementById('addForm2');
                    form.style.display='none';
                    var but1 = document.getElementById('but2');
                    but1.style.display='';
                });
            }
            function delete_subject(id,subject){
                var isDelete = confirm("Ви дійсно хочете видалити " + subject + "?");
                if(isDelete){
                    $.ajax({
                        url: "/admin/ajax/deletesubject",
                        type: "POST",
                        data:'id='+id,
                        success: function(data){
                            $("#removesub"+id).remove();
                        }
                    });
                }
            }
            function addStudent(){
                var group = $('#select :selected').val();
                var fio = $('input[name=new_stud_fio]').val();
                $.getJSON("template/ajax/add_student.php?fio="+fio+"&group="+group,function(data){
                    alert("Студент "+fio+ " був успішно доданий до БД");
                    var elem = $('#resetradio').wrap('<div/>').parent().html()
                    $("#course_group").html(elem);
                });
            }
            function delete_student(id,student){
                var isDelete = confirm("Ви дійсно хочете видалити " + student + "?");
                if(isDelete){
                    $.ajax({
                        url: "/admin/ajax/deletestudent",
                        type: "POST",
                        data:'id='+id,
                        success: function(data){
                            $("#removestud"+id).remove();
                        }
                    });
                }
            }
            function goto_groups(course){
                $.get("/admin/ajax/getgroups/"+course, function(data){
                    $("#course_group").html(data);
                });
            }
            function show_student(id){
                $.get("template/ajax/students_info.php?id="+id, function(data){
                    $(".result").html(data);
                });
            }
        </script>
        <style>
            .mail_num{
                margin-left: 5px;
                background-color: white;
                font-size: 11px;
                color: black;
                font-weight: bold;
                border-radius: 5px;
                padding-left: 5px;
                padding-right: 5px;
            }
            #del_icon{
                text-align: center;
            }
            #del_icon img{
                cursor: pointer;
            }
        </style>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">