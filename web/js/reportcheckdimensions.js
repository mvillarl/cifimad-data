var maxwidth = 395;
var maxwidthb = 325;
var maxwidthvertical = 260;
var maxheight = 60;

$(document).ready(function(){
    // Versión clásica
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

    // Versión con acreditación completa - alteramos tamaño
    $('.badgelabelinb,.badgelabelverticalinb').each(function() {
        var width = this.offsetWidth;
        var height = this.offsetHeight;
        var maxw = maxwidthb;
        if ($(this).hasClass('badgelabelverticalinb')) maxw = maxwidthvertical;

        if ( (width > maxw) || (height > maxheight) ) {
            var fontsize = $(this).css ('font-size');
            var fontsizepart = '';
            if (fontsize.indexOf ('pt') != -1) {
                fontsizepart = 'pt';
                fontsize = fontsize.replace('pt', '');
            }
            if (fontsize.indexOf ('px') != -1) {
                fontsizepart = 'px';
                fontsize = fontsize.replace('px', '');
            }
            do {
                fontsize--;
                $(this).css ('font-size', fontsize + fontsizepart);
                width = this.offsetWidth;
                height = this.offsetHeight;
            } while ( (fontsize > 8) && ( (width > maxw) || (height > maxheight) ) );
        }
    });
});