jQuery(document).ready (function(){
    jQuery('#attendee-tickettype').change (updateBadgesCB);
    jQuery('#attendee-idsource').change (updateBadgesCB);
    jQuery('#attendee-isspecial').change (updateBadgesCB);
    jQuery('#attendee-idattendeeparent').change (updateBadgesCB);

    jQuery('#attendee-mealfridaydinner').change (updateBadgesTicketsCB);
    jQuery('#attendee-mealsaturdaylunch').change (updateBadgesTicketsCB);
    jQuery('#attendee-mealsaturdaydinner').change (updateBadgesTicketsCB);
    jQuery('#attendee-mealsundaylunch').change (updateBadgesTicketsCB);
    jQuery('#attendee-mealsundaydinner').change (updateBadgesTicketsCB);

    jQuery('#attendee-guest1photoshoot').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest1photoshootspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest1autograph').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest1autographspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest1vintage').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest2photoshoot').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest2photoshootspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest2autograph').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest2autographspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest2vintage').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest3photoshoot').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest3photoshootspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest3autograph').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest3autographspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest3vintage').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest4photoshoot').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest4photoshootspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest4autograph').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest4autographspecial').change (updateBadgesTicketsCB);
    jQuery('#attendee-guest4vintage').change (updateBadgesTicketsCB);

    jQuery('#attendee-extraproduct1').change (updateBadgesTicketsCB);
    jQuery('#attendee-extraproduct2').change (updateBadgesTicketsCB);
    jQuery('#attendee-extraproduct3').change (updateBadgesTicketsCB);
    jQuery('#attendee-extraproduct4').change (updateBadgesTicketsCB);

    jQuery('#attendee-roomtype').change (updateHotelCB);
    jQuery('#attendee-datestartlodging').change (updateHotelCB);
    jQuery('#attendee-dateendlodging').change (updateHotelCB);
    jQuery('#attendee-idattendeeroommate1').change (updateHotelCB);
    jQuery('#attendee-idattendeeroommate2').change (updateHotelCB);
    jQuery('#attendee-idattendeeroommate3').change (updateHotelCB);
    jQuery('#attendee-remarkshotel').change (updateHotelCB);

});

function updateHotelCB() {
    if (jQuery('#updateHotelFlag').length > 0) {
        jQuery('#updateHotelFlag').get(0).checked = true;
    }
}
function updateBadgesCB() {
    if (jQuery('#updateBadgesFlag').length > 0) {
        jQuery('#updateBadgesFlag').get(0).checked = true;
    }
}
function updateBadgesTicketsCB() {
    if (jQuery('#updateBadgesTicketsFlag').length > 0) {
        jQuery('#updateBadgesTicketsFlag').get(0).checked = true;
    }
}