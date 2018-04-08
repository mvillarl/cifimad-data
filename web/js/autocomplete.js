_ac_target = '';

function autocomplete(req, resp) {
    _ac_target = $('input[name=' + this.element[0].name + ']').attr ('cf_target');
    var ac_source = $('input[name=' + this.element[0].name + ']').attr ('cf_source');
    if (req.term == '') {
        $('#' + _ac_target).val ('');
    } else if (req.term.length >= 3) {
        $.ajax({
            url: ac_source + req.term,
            type: 'POST',
            dataType: 'JSON',
            success: function (result) {
                resp(result);
            },
            error: function (req, err, obj) {
                alert('ERROR : ' + req.status + err);
            }
        });
    }
}

function autocompleteSelect( event, ui ) {
    $('#' + _ac_target).val (ui.item.value);
    ui.item.value = ui.item.label;
}