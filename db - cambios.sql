ALTER TABLE  cif_events
ADD hasVIPAttendees BIT DEFAULT false;

ALTER TABLE  cif_members
ADD isFromFanvencion BIT DEFAULT false;

ALTER TABLE  cif_attendees
ADD isVIP BIT DEFAULT false;

