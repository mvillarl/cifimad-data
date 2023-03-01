ALTER table cif_volunteer_inscriptions
ADD    `activitiesRequired` text,
ADD    `activitiesDesired` text;

ALTER table cif_cosplay_inscriptions
    MODIFY hasSoundtrack CHAR(1) DEFAULT NULL,
    ADD soundtrack varchar(150) DEFAULT NULL;