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