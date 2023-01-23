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

    $('#generateImgs').click (generateImages);
    $('#generateImgs').removeAttr ('disabled');
});

function generateImages() {
    $('#generateImgs').attr('disabled', 'true');

    var data = {step: '0'};
    var crsfName = $('#csrfField').attr ('name');
    var crsfValue = $('#csrfField').val();
    data[crsfName] = crsfValue;
    $.post({
        'url': '/attendee/generateimgs',
        data: data,
        dataType: 'text',
        success: function (txt) {
            if (txt == 'OK') {
                step1();
            } else {
                alert(txt);
            }
        },
        error: function () {
            alert('ERROR');
        }
    });
}


function step1(index) {
    if (index == undefined) index = 0;
    var count = index;
    var max = 40 + index;
    var total = $('.generateJpg').size();
    //max = total;
    var promises = [];
    var data = {};
    $('.generateJpg').each (function() {
        if (count < max) {
            $('#progress').text ('Preprocesando ' + (count + 1) + ' de ' + total + ' imágenes...');
            var prom = html2canvas(this);
            promises[count - index] = prom;
            count++;
            prom.then(canvas => {
                var countinside = Object.keys (data).length / 2;

                $('#progress').text ('Procesando ' + (index + countinside) + ' de ' + total + ' imágenes...');
                var name = $(this).data('name');
                var img = canvas.toDataURL('image/jpeg',1 );
                data['name' + countinside] = name;
                data['img' + countinside] = img;
            });
        }
    });
    Promise.all (promises).then (function() {
        data['step'] = '1';
        var crsfName = $('#csrfField').attr ('name');
        var crsfValue = $('#csrfField').val();
        data[crsfName] = crsfValue;
        $.post({
            'url': '/attendee/generateimgs',
            data: data,
            dataType: 'text',
            success: function (txt) {
                if (txt == 'OK') {
                    if (count < total) {
                        step1 (count);
                    } else {
                        step2();
                    }
                } else {
                    alert(txt);
                }
            },
            error: function () {
                alert('ERROR');
            }
        });
    });
}

function step2() {
    var frmGenerateJpg = document.getElementById('frmGenerateJpg');
    $('#progress').text ('Proceso completado, guardando');
    frmGenerateJpg.submit();
    $('#generateImgs').removeAttr ('disabled');
}