create table cif_events (
	id INT(11) NOT NULL AUTO_INCREMENT,
	year INT(4) NOT NULL,
	name VARCHAR(60) NOT NULL,
	dateStart DATE NOT NULL,
	dateEnd DATE NOT NULL,
	dateSentInfoHotel TIMESTAMP NULL,
	dateBadgesPrinted TIMESTAMP NULL,
	dateEndCosplaySignup date NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table cif_guests (
	id INT(11) NOT NULL AUTO_INCREMENT,
	idEvent INT(11) NOT NULL,
	name VARCHAR(60) NOT NULL,
	surname VARCHAR(60) NOT NULL,
	characterName VARCHAR(100) NOT NULL,
	pseudonym VARCHAR(100) NULL,
	`order` INT(4) NOT NULL,
	dateArrival DATE NOT NULL,
	dateDeparture DATE NOT NULL,
	hasAutograph BIT DEFAULT false,
	hasPhotoshoot BIT DEFAULT false,
	hasPhotoshootSpecial BIT DEFAULT false,
	hasAutographSpecial BIT DEFAULT false,
	hasSelfie BIT DEFAULT false,
	hasAutographSelfieCombo BIT DEFAULT false,
	hasVintage BIT DEFAULT false,
	nif_passport VARCHAR(25) NULL,
	remarks TEXT NULL,
	remarksMeals TEXT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT event FOREIGN KEY (idEvent) REFERENCES cif_events (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table cif_members (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	surname VARCHAR(100) NOT NULL,
	badgeName VARCHAR(100) NOT NULL,
	badgeSurname VARCHAR(100) NOT NULL,
	email VARCHAR(100) NULL,
	nif VARCHAR(25) NULL,
	phone VARCHAR(25) NULL,
	remarks TEXT NULL,
	status BIT DEFAULT true,
	createdAt TIMESTAMP DEFAULT NOW(),
	updatedAt TIMESTAMP DEFAULT NOW(),
	consent BIT DEFAULT false,
	keyCheck VARCHAR(50) NULL,
	small BIT DEFAULT false,
	PRIMARY KEY (`id`),
	CONSTRAINT email UNIQUE KEY (email),
	CONSTRAINT nif UNIQUE KEY (nif),
	CONSTRAINT keyCheck UNIQUE KEY (keyCheck)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table cif_sources (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(60) NOT NULL,
	imageFile VARCHAR(255) NULL,
	separateList BIT default false,
	blankBadges INT default 0,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table cif_products (
	id INT(11) NOT NULL AUTO_INCREMENT,
	idEvent INT(11) NOT NULL,
	name VARCHAR(60) NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT prodEvent FOREIGN KEY (idEvent) REFERENCES cif_events (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table cif_attendees (
	id INT(11) NOT NULL AUTO_INCREMENT,
	idEvent INT(11) NOT NULL,
	idMember INT(11) NOT NULL,
	status CHAR(1) NOT NULL DEFAULT '0',
	ticketType CHAR(1) NOT NULL,
	mealFridayDinner BIT DEFAULT false,
	mealSaturdayLunch BIT DEFAULT false,
	mealSaturdayDinner BIT DEFAULT false,
	mealSundayLunch BIT DEFAULT false,
	mealSundayDinner BIT DEFAULT false,
	guest1Photoshoot SMALLINT(2) DEFAULT 0,
	guest1PhotoshootSpecial SMALLINT(2) DEFAULT 0,
	guest1Autograph SMALLINT(2) DEFAULT 0,
	guest1AutographSpecial SMALLINT(2) DEFAULT 0,
	guest1Selfie SMALLINT(2) DEFAULT 0,
	guest1ComboAutographSelfie SMALLINT(2) DEFAULT 0,
	guest1Vintage SMALLINT(2) DEFAULT 0,
	guest2Photoshoot SMALLINT(2) DEFAULT 0,
	guest2PhotoshootSpecial SMALLINT(2) DEFAULT 0,
	guest2Autograph SMALLINT(2) DEFAULT 0,
	guest2AutographSpecial SMALLINT(2) DEFAULT 0,
	guest2Selfie SMALLINT(2) DEFAULT 0,
	guest2ComboAutographSelfie SMALLINT(2) DEFAULT 0,
	guest2Vintage SMALLINT(2) DEFAULT 0,
	guest3Photoshoot SMALLINT(2) DEFAULT 0,
	guest3PhotoshootSpecial SMALLINT(2) DEFAULT 0,
	guest3Autograph SMALLINT(2) DEFAULT 0,
	guest3AutographSpecial SMALLINT(2) DEFAULT 0,
	guest3Selfie SMALLINT(2) DEFAULT 0,
	guest3ComboAutographSelfie SMALLINT(2) DEFAULT 0,
	guest3Vintage SMALLINT(2) DEFAULT 0,
	guest4Photoshoot SMALLINT(2) DEFAULT 0,
	guest4PhotoshootSpecial SMALLINT(2) DEFAULT 0,
	guest4Autograph SMALLINT(2) DEFAULT 0,
	guest4AutographSpecial SMALLINT(2) DEFAULT 0,
	guest4Selfie SMALLINT(2) DEFAULT 0,
	guest4ComboAutographSelfie SMALLINT(2) DEFAULT 0,
	guest4Vintage SMALLINT(2) DEFAULT 0,
	extraProduct1 SMALLINT(2) DEFAULT 0,
	extraProduct2 SMALLINT(2) DEFAULT 0,
	extraProduct3 SMALLINT(2) DEFAULT 0,
	extraProduct4 SMALLINT(2) DEFAULT 0,
	idSource INT(11) NOT NULL,
	isSpecial BIT DEFAULT FALSE,
	roomType CHAR(1) NULL,
	dateStartLodging DATE NULL,
	dateEndLodging DATE NULL,
	idAttendeeRoommate1 INT(11) NULL,
	idAttendeeRoommate2 INT(11) NULL,
	idAttendeeRoommate3 INT(11) NULL,
	idAttendeeParent INT(11) NULL,
	remarks TEXT NULL,
	remarksRegistration TEXT NULL,
	remarksMeals TEXT NULL,
	remarksMealSaturday TEXT NULL,
	remarksHotel TEXT NULL,
	orders VARCHAR(255) NULL,
	createdAt TIMESTAMP DEFAULT NOW(),
	updatedAt TIMESTAMP DEFAULT NOW(),
	updatedAtHotel TIMESTAMP,
	updatedAtBadges TIMESTAMP,
	updatedAtBadgesTickets TIMESTAMP,
	PRIMARY KEY (`id`),
	CONSTRAINT attEvent FOREIGN KEY (idEvent) REFERENCES cif_events (id),
	CONSTRAINT attMember FOREIGN KEY (idMember) REFERENCES cif_members (id),
	CONSTRAINT attendeeRoommate1 FOREIGN KEY (idAttendeeRoommate1) REFERENCES cif_attendees (id),
	CONSTRAINT attendeeRoommate2 FOREIGN KEY (idAttendeeRoommate2) REFERENCES cif_attendees (id),
	CONSTRAINT attendeeRoommate3 FOREIGN KEY (idAttendeeRoommate3) REFERENCES cif_attendees (id),
	CONSTRAINT attendeeParent FOREIGN KEY (idAttendeeParent) REFERENCES cif_attendees (id),
	CONSTRAINT attSource FOREIGN KEY (idSource) REFERENCES cif_sources (id),
	CONSTRAINT uniqueAttendee UNIQUE KEY (idEvent, idMember)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table cif_companions (
	id INT(11) NOT NULL AUTO_INCREMENT,
	idGuest INT(11) NOT NULL,
	name VARCHAR(60) NOT NULL,
	surname VARCHAR(60) NOT NULL,
	badgeName  VARCHAR(60) NOT NULL,
	badgeSurname VARCHAR(60) NOT NULL,
	nif_passport VARCHAR(25) NULL,
	remarks TEXT NULL,
	remarksMeals TEXT NULL,
	separateRoom BIT DEFAULT false,
	excludeLodging BIT DEFAULT false,
	excludeFridayDinner BIT DEFAULT false,
	PRIMARY KEY (`id`),
	CONSTRAINT compGuest FOREIGN KEY (idGuest) REFERENCES cif_guests (id)
) ENGINE=InnoDB ;

create table cif_press (
	id INT(11) NOT NULL AUTO_INCREMENT,
	idSource INT(11) NULL,	
	name VARCHAR(100) NULL,
	email VARCHAR(100) NULL,
	consent BIT DEFAULT false,
	keyCheck VARCHAR(50) NULL,
	PRIMARY KEY id (`id`),
	CONSTRAINT emailPr UNIQUE KEY (email),
	CONSTRAINT keyCheckPr UNIQUE KEY (keyCheck),
	CONSTRAINT prSource FOREIGN KEY (idSource) REFERENCES cif_sources (id)
) ENGINE=InnoDB ;

CREATE TABLE cif_cosplay_inscriptions (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idEvent` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `surname` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    category varchar(2) NOT NULL,
    characterName varchar(100) NOT NULL,
    `remarks` text,
    `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	hasPerformance BIT default false,
	hasSoundtrack BIT default false,
   
    PRIMARY KEY (`id`),
    KEY `event` (`idEvent`),
    CONSTRAINT `eventCI` FOREIGN KEY (`idEvent`) REFERENCES `cif_events` (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cif_volunteer_inscriptions (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idEvent` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
	`nameFacebook` varchar(100) NULL,
	`functionOther` varchar(100) NULL,
	`shiftOther` varchar(100) NULL,
	`otherVolunteer` varchar(500) NULL,
	`computersLevel` char(1) NULL,
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
