CREATE TABLE cif_volunteer_inscriptions (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idEvent` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
	`nameFacebook` varchar(100) NOT NULL,
    PRIMARY KEY id (`id`),
    KEY `eventVI` (`idEvent`),
    CONSTRAINT `eventVI` FOREIGN KEY (`idEvent`) REFERENCES `cif_events` (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE cif_volunteer_inscriptions_functions (
	`idVolunteer` int(11) NOT NULL,
	`volunteerFunction` char(2) NOT NULL,
	PRIMARY KEY (`idVolunteer`, `volunteerFunction`),
    KEY `volunteerVIF` (`idVolunteer`),
    CONSTRAINT `volunteerVIF` FOREIGN KEY (`idVolunteer`) REFERENCES `cif_volunteer_inscriptions` (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cif_volunteer_inscriptions_shifts (
	`idVolunteer` int(11) NOT NULL,
	`volunteerShift` char(2) NOT NULL,
	PRIMARY KEY (`idVolunteer`, `volunteerShift`),
    KEY `volunteerVIS` (`idVolunteer`),
    CONSTRAINT `volunteerVIS` FOREIGN KEY (`idVolunteer`) REFERENCES `cif_volunteer_inscriptions` (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
