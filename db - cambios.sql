ALTER TABLE  cif_events
ADD imgLogo VARCHAR(100) DEFAULT NULL;

ALTER TABLE cif_sources
ADD isVolunteer BIT default false;

ALTER TABLE cif_events
ADD verticalBadges BIT default false,
ADD acadiBadges INT default 15;

CREATE TABLE cif_polls (
    id INT(11) NOT NULL AUTO_INCREMENT,
    pkey VARCHAR(25),
    title VARCHAR(100),
    PRIMARY KEY (`id`),
    UNIQUE KEY pkey (`pkey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cif_polls_answers (
    id INT(11) NOT NULL AUTO_INCREMENT,
    idPoll INT(11) NOT NULL,
    answerText VARCHAR(255),
    PRIMARY KEY (`id`),
    CONSTRAINT poll FOREIGN KEY (idPoll) REFERENCES cif_polls (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cif_polls_answers_votes (
     id INT(11) NOT NULL AUTO_INCREMENT,
     idPollAnswer INT(11) NOT NULL,
     cookieValue VARCHAR(100),
     ipAddresses VARCHAR(100),
     PRIMARY KEY (`id`),
     CONSTRAINT pollAnswer FOREIGN KEY (idPollAnswer) REFERENCES cif_polls_answers (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;