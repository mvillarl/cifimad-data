function _sql2date (val) {
    /*alert (val);
    parts = val.split ('-');
    var ret = new Date (val[0], val[1] - 1, val[2]);
    return ret;*/
    return val;
}

$(document).ready(function() {
    $('.cfdp').each(function(){
        var changev = false;
        if ($(this).attr ('cf_lessthan')) {
            var intval = $('#' + $(this).attr ('cf_lessthan') ).val();
            if ( (intval == '--') || (intval == undefined) ) intval = '';
            if (intval != '') {
                $(this).datepicker("option", "maxDate", _sql2date (intval) );
            }
            changev = true;
        }
        if ($(this).attr ('cf_greaterthan')) {
            var intval = $('#' + $(this).attr ('cf_greaterthan') ).val();
            if ( (intval == '--') || (intval == undefined) ) intval = '';
            if (intval != '') {
                $(this).datepicker("option", "minDate", _sql2date (intval) );
            }
            changev = true;
        }
        if (changev) $(this).change (changeDate);
        //$(this).datepicker('option', 'dateFormat', 'yy-mm-dd');
    });
});

function changeDate (ev) {
    _changeDate ($(this), true);
}

function _changeDate (fld, changeother) {
    if (fld.attr ('cf_lessthan')) {
        var intval = $('#' + fld.attr ('cf_lessthan') ).val();
        if ( (intval == '--') || (intval == undefined) ) intval = '';
        if (intval != '') {
            //alert ( fld.attr ('cf_lessthan') + ' maxDate: ' + _sql2date (intval) );
            fld.datepicker("option", "maxDate", _sql2date (intval) );
        }
        if (changeother) _changeDate ($('#' + fld.attr ('cf_lessthan') ), false);
    }
    if (fld.attr ('cf_greaterthan')) {
        var intval = $('#' + fld.attr ('cf_greaterthan') ).val();
        if ( (intval == '--') || (intval == undefined) ) intval = '';
        if (intval != '') {
            //alert ( fld.attr ('cf_greaterthan') + ' minDate: ' + _sql2date (intval) );
            fld.datepicker("option", "minDate", _sql2date (intval) );
        }
        if (changeother) _changeDate ($('#' + fld.attr ('cf_greaterthan') ), false);
    }
}
