jQuery(document).ready (function () {
    jQuery('.required').blur (cfValidate);
    jQuery('#sendForm').click (sendForm);
});

var validating = false;

function sendForm() {
    validating = true;
    if (cfValidate()) this.form.submit();
    else return false;
}

function cfValidate() {
    var anyerror = false;
    if (validating) {
        jQuery('#errors').text('');
        var form = jQuery('#form-cosplay').get(0);
        jQuery('.required').each(function () {
            var value = fieldValue(this);
            if (value == '') {
                jQuery('#errors').text('Los campos en rojo son obligatorios');
                jQuery(this).parent().addClass('fieldError');
                anyerror = true;
            } else {
                jQuery(this).parent().removeClass('fieldError');
            }
        });
    }
    return !anyerror;
}

function fieldValue (fld) {
    var ret = jQuery(fld).val();
    if ( (fld.type == 'checkbox') && !fld.checked) {
        ret = '';
    }
    return ret;
}