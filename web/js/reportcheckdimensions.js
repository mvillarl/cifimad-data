var maxwidth = 395;
var maxwidthvertical = 260;
var maxheight = 60;

$(document).ready(function(){
    $('.badgelabelin,.badgelabelverticalin').each(function() {
        var width = this.offsetWidth;
        var height = this.offsetHeight;
        var maxw = maxwidth;
        if ($(this).hasClass('badgelabelverticalin')) maxw = maxwidthvertical;
        if ( (width > maxw) || (height > maxheight) ) {
            var bef = $('#warnings').html();
            if (bef != '') bef += '<br>';
            $('#warnings').html(bef += 'Etiqueta demasiado grande para ' + $(this).text() + ' - ' + width + 'x' + height);
        }
    });
});