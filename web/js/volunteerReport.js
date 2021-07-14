jQuery(document).ready(function() {
    jQuery('.showrows').click (showRows);
});

function showRows() {
    var rowid = jQuery(this).data('row');
    var ind = jQuery('~ .showrowsind', this).text();
    var table = jQuery(this).parents('table');
    if (ind == 'v') {
        jQuery('.rowshow', table).hide();
        jQuery('.rowshow.'+rowid, table).show();
        jQuery('~ .showrowsind', this).text('^');
    } else {
        jQuery('.rowshow', table).show();
        jQuery('~ .showrowsind', this).text('v');
    }
    return false;
}