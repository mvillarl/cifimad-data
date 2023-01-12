ALTER TABLE  cif_volunteer_inscriptions
ADD `phone` varchar(100)  NULL DEFAULT NULL AFTER email,
MODIFY email varchar(100)  NULL DEFAULT NULL ;