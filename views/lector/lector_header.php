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
            function saveToDatabase(editableObj,column,id,groupID,subjectID) {
                $(editableObj).css("background","#FFF url(/template/images/load.gif) no-repeat right");
                $.ajax({
                    url: "/lector/ajax/numlabrgr",
                    type: "POST",
                    data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&groupID='+groupID+'&subjectID='+subjectID,
                    success: function(data){
                        $(editableObj).css("background","");
                    }
                });
            }
        </script>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">
