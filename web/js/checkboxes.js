$(document).ready (function(){
    $('#attendee-tickettype').change (updateBadgesCB);
    $('#attendee-idsource').change (updateBadgesCB);
    $('#attendee-isspecial').change (updateBadgesCB);
    $('#attendee-idattendeeparent').change (updateBadgesCB);

    $('#attendee-mealfridaydinner').change (updateBadgesTicketsCB);
    $('#attendee-mealsaturdaylunch').change (updateBadgesTicketsCB);
    $('#attendee-mealsaturdaydinner').change (updateBadgesTicketsCB);
    $('#attendee-mealsundaylunch').change (updateBadgesTicketsCB);
    $('#attendee-mealsundaydinner').change (updateBadgesTicketsCB);

    $('#attendee-guest1photoshoot').change (updateBadgesTicketsCB);
    $('#attendee-guest1photoshootspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest1autograph').change (updateBadgesTicketsCB);
    $('#attendee-guest1autographspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest1vintage').change (updateBadgesTicketsCB);
    $('#attendee-guest2photoshoot').change (updateBadgesTicketsCB);
    $('#attendee-guest2photoshootspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest2autograph').change (updateBadgesTicketsCB);
    $('#attendee-guest2autographspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest2vintage').change (updateBadgesTicketsCB);
    $('#attendee-guest3photoshoot').change (updateBadgesTicketsCB);
    $('#attendee-guest3photoshootspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest3autograph').change (updateBadgesTicketsCB);
    $('#attendee-guest3autographspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest3vintage').change (updateBadgesTicketsCB);
    $('#attendee-guest4photoshoot').change (updateBadgesTicketsCB);
    $('#attendee-guest4photoshootspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest4autograph').change (updateBadgesTicketsCB);
    $('#attendee-guest4autographspecial').change (updateBadgesTicketsCB);
    $('#attendee-guest4vintage').change (updateBadgesTicketsCB);

    $('#attendee-extraproduct1').change (updateBadgesTicketsCB);
    $('#attendee-extraproduct2').change (updateBadgesTicketsCB);
    $('#attendee-extraproduct3').change (updateBadgesTicketsCB);
    $('#attendee-extraproduct4').change (updateBadgesTicketsCB);

    $('#attendee-roomtype').change (updateHotelCB);
    $('#attendee-datestartlodging').change (updateHotelCB);
    $('#attendee-dateendlodging').change (updateHotelCB);
    $('#attendee-idattendeeroommate1').change (updateHotelCB);
    $('#attendee-idattendeeroommate2').change (updateHotelCB);
    $('#attendee-idattendeeroommate3').change (updateHotelCB);
    $('#attendee-remarkshotel').change (updateHotelCB);

});

function updateHotelCB() {
    $('#updateHotelFlag').get(0).checked = true;
}
function updateBadgesCB() {
    $('#updateBadgesFlag').get(0).checked = true;
}
function updateBadgesTicketsCB() {
    $('#updateBadgesTicketsFlag').get(0).checked = true;
}