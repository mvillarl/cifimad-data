function _convertDate (date) {
    var reDateSQL = new RegExp ("^[0-9]{4}-[0-9]{2}-[0-9]{2}$");
    var reDateDatepicker = new RegExp ("^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$");
    var ret = date;
    if (reDateDatepicker.test (date)) {
        date = _datepicker2sql(date);
    }
    if (reDateSQL.test (date)) {
        date = _sql2date(date);
    }
    return date;
}

function _sql2date (val) {
    //alert (val); -> convertir a obj
    var parts = val.split ('-');
    var ret = new Date (parts[0], parts[1] - 1, parts[2]);
    return ret;
    //return val;
}

function _datepicker2sql (val) {
    var parts = val.split ('/');
    var ret = parts.reverse().join('-');
    return ret;
}

$(document).ready(function() {
    $('.cfdp').each(function(){
        var changev = false;
        if ($(this).attr ('cf_lessthan')) {
            var intval = $('#' + $(this).attr ('cf_lessthan') ).val();
            if ( (intval == '--') || (intval == undefined) ) intval = '';
            if (intval != '') {
                var maxdate = _convertDate (intval);
                $(this).datepicker("option", "maxDate", maxdate);
            }
            changev = true;
        }
        if ($(this).attr ('cf_greaterthan')) {
            var intval = $('#' + $(this).attr ('cf_greaterthan') ).val();
            if ( (intval == '--') || (intval == undefined) ) intval = '';
            if (intval != '') {
                var mindate = _convertDate (intval);
                $(this).datepicker("option", "minDate", mindate);
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
            var maxdate = _convertDate (intval);
            fld.datepicker("option", "maxDate", maxdate);
        }
        if (changeother) _changeDate ($('#' + fld.attr ('cf_lessthan') ), false);
    }
    if (fld.attr ('cf_greaterthan')) {
        var intval = $('#' + fld.attr ('cf_greaterthan') ).val();
        if ( (intval == '--') || (intval == undefined) ) intval = '';
        if (intval != '') {
            //alert ( fld.attr ('cf_greaterthan') + ' minDate: ' + _sql2date (intval) );
            var mindate = _convertDate (intval);
            fld.datepicker("option", "minDate", mindate);
        }
        if (changeother) _changeDate ($('#' + fld.attr ('cf_greaterthan') ), false);
    }
}
