var maxwidth = 395;
var maxheight = 60;

$(document).ready(function(){
    $('.badgelabelin').each(function() {
        var width = this.offsetWidth;
        var height = this.offsetHeight;
        if ( (width > maxwidth) || (height > maxheight) ) {
            var bef = $('#warnings').html();
            if (bef != '') bef += '<br>';
            $('#warnings').html(bef += 'Etiqueta demasiado grande para ' + $(this).text() + ' - ' + width + 'x' + height);
        }
    });
});