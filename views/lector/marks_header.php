<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="UTF-8">
        <title>E-Journal FEІT</title>
        <link rel="stylesheet" href="/template/css/style.css">
        <link rel="stylesheet" href="/template/css/mystyle.css">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="/template/js/bootstrap.js"></script>
        <script>
            function showEdit(editableObj) {
                $(editableObj).css("background","#c1e2b3");
            }

            function saveToDatabase(editableObj,column,id) {
                $(editableObj).css("background","#FFF url(/template/images/load.gif) no-repeat right");
                $.ajax({
                    url: "/lector/ajax/editmarks",
                    type: "POST",
                    data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                    success: function(data){
                        $(editableObj).css("background","");
                    }
                });
            }
            function lightcol($col){
                var nclass = $col;
                var elements = document.getElementsByClassName(nclass);
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.background = '#f5f5f5';
                }
            }
            function unlightcol($col){
                var nclass = $col;
                var elements = document.getElementsByClassName(nclass);
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.background = '';
                }
            }
            function light(cell){
                $(cell).css("background","#ddd");
            }
        </script>
        <style>
        </style>
    </head>
    <body style="overflow-y: scroll">
    <div class="container">
