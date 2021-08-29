ALTER TABLE cif_attendees
ADD cifiKidsDay CHAR(1) NULL,
ADD parkingReservation VARCHAR(100) NULL;

ALTER TABLE cif_members
ADD vaccine CHAR(1) NULL;