ALTER TABLE cif_attendees
ADD phoneAtDesk VARCHAR(50) NULL;

CREATE TABLE cif_attendee_sales (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idEvent` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `phone` varchar(50) NOT NULL,
    ticketType CHAR(1) NOT NULL,
    authorizedBy varchar(50) NOT NULL,
    authorizedReason varchar(2000) NOT NULL,
    PRIMARY KEY id (`id`),
    KEY `eventAS` (`idEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
