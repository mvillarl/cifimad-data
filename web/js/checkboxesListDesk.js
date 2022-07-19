$(document).ready(function(){
    $('.checkboxinline').change (sendChange);
});

function sendChange (ev) {
    var cb = this;
    var id = $(cb).data ('id');
    var done = cb.checked;
    //alert (id + ' ' + done);
    cb.disabled = true;
    $.ajax ({
        type: 'POST',
        dataType: 'text',
        url: '/attendee/ajaxsavemark/' + id + '/' + done,
        success (txt) {
            if (txt == 'OK') {
                cb.disabled = false;
            } else {
                alert (txt);
                cb.disabled = false;
                return false;
            }
        },
        error: function (req, err, obj) {
            alert('ERROR : ' + req.status + err);
            cb.disabled = false;
            return false;
        }
    });
}