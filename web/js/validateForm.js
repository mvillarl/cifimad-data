jQuery(document).ready (function () {
    jQuery('.required').blur (cfValidate);
    jQuery('.requiredone').blur (cfValidate);
    jQuery('.email').blur (cfValidate);
    jQuery('#sendForm').click (sendForm);
    jQuery('#d-form-volunteer-2').hide();
    jQuery('#volunteerNext').click (volunteerNext);
    jQuery('#volunteerPrev').click (volunteerPrev);
    jQuery('#hasSoundtrack').change (toggleSoundtrack);
    toggleSoundtrack();
});

var validating = false;

function sendForm() {
    validating = true;
    if (cfValidate()) this.form.submit();
    else return false;
}

function volunteerNext() {
    validating = true;
    if (cfValidate ('#d-form-volunteer-1 ')) {
        jQuery('#d-form-volunteer-1').hide();
        jQuery('#d-form-volunteer-2').show();
        jQuery('#d-form-volunteer-2').removeClass ('fieldError');
        jQuery('#d-form-volunteer-2 ul').removeClass ('fieldError');
    }
}

function volunteerPrev() {
    validating = true;
    if (cfValidate ('#d-form-volunteer-2 ')) {
        jQuery('#d-form-volunteer-1').show();
        jQuery('#d-form-volunteer-2').hide();
        jQuery('#d-form-volunteer-1').removeClass ('fieldError');
        jQuery('#d-form-volunteer-1 ul').removeClass ('fieldError');
    }
}

function isObject(val) {
    if (val === null) { return false;}
    return ( (typeof val === 'function') || (typeof val === 'object') );
}

function cfValidate(extrafilter) {
    if ( (extrafilter == undefined) || isObject (extrafilter) ) extrafilter = '';
    var anyerror = false;
    if (validating) {
        jQuery('#errors').text('');
        var form = jQuery('#form-cosplay').get(0);
        jQuery(extrafilter + '.required').each(function () {
            var value = fieldValue(this);
            var prnt = jQuery(this).parent().parent();
            //if (this.type == 'checkbox') prnt = jQuery(prnt).parent();
            if (value == '') {
                jQuery('#errors').text('Los campos en rojo son obligatorios');
                prnt.addClass('fieldError');
                //jQuery(this).parent().addClass('fieldError');
                anyerror = true;
            } else {
                prnt.removeClass('fieldError');
            }
        });
        var anyvalue = false;
        jQuery(extrafilter + '.requiredone').each(function () {
            var value = fieldValue(this);
            if (value != '') {
                anyvalue = true;
            }
        });
        if (jQuery(extrafilter + '.requiredone').size() > 0) {
            if (anyvalue) {
                jQuery(extrafilter + '.requiredone').parent().parent().removeClass('fieldError');
            } else {
                jQuery('#errors').text('Es necesario que nos indiques al menos uno de los dos campos: e-mail o teléfono');
                jQuery(extrafilter + '.requiredone').parent().parent().addClass('fieldError');
                anyerror = true;
            }
        }
        jQuery(extrafilter + '.email').each(function () {
            var value = fieldValue(this);
            if ( (value != '') && !isValidEmail (value) ) {
                jQuery('#error_'+this.name).text('Debe ser un e-mail válido');
                jQuery(this).parent().addClass('fieldError');
                anyerror = true;
            } else {
                jQuery(this).parent().removeClass('fieldError');
                jQuery('#error_'+this.name).text('');
            }
        });
        jQuery(extrafilter + '.requiresOther').each(function () {
            if (this.checked) {
                var other = jQuery('#'+jQuery(this).data ('other') ).get (0);
                var value = fieldValue(other);
                if (value == '') {
                    jQuery('#errors').text('Si marcas Otra, tienes que indicar cuál');
                    jQuery(this).parent().addClass('fieldError');
                    anyerror = true;
                } else {
                    jQuery(this).parent().removeClass('fieldError');
                }
            }
        });
    }
    return !anyerror;
}

function fieldValue (fld) {
    var ret = jQuery(fld).val();
    if (fld.type == 'checkbox') {
        var name = fld.name.replace ('[]', '');
        ret = jQuery('.' + name + ':checked').val();
        if (ret == undefined) ret = '';
    }
    return ret;
}

function isValidEmail (text) {
    var reEmail = new RegExp ("^([-!\#$%&'*+./0-9=?A-Z^_`a-zÑñ{|}~])+@([-!#\$%&'*+/0-9=?A-Z^_`a-z{|}~]+\.)+[a-zA-Z]{2,6}\$", "i");
    return reEmail.test (text) ;
}

function toggleSoundtrack() {
    var st = jQuery('#hasSoundtrack').val();
    if (st == 'S') {
        jQuery('#soundtrack').show();
    } else {
        jQuery('#soundtrack').hide();
    }
}
