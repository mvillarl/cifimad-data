ALTER TABLE  cif_events
ADD imgLogo VARCHAR(100) DEFAULT NULL;

ALTER TABLE cif_sources
ADD isVolunteer BIT default false;

ALTER TABLE cif_events
ADD verticalBadges BIT default false,
ADD acadiBadges INT default 15;