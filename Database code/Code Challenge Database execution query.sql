/* Creating Schema */
CREATE SCHEMA `rexx_code_challenge` ;

/* Creating Table for Employees */
CREATE TABLE `rexx_code_challenge`.`employee` (
  `employee_id` INT NULL AUTO_INCREMENT,
  `employee_name` VARCHAR(100) NOT NULL,
  `employee_mail` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE INDEX (`employee_mail`)
  );

/* Creating Table for Events */
CREATE TABLE `rexx_code_challenge`.`events` (
  `event_id` INT(11) NOT NULL,
  `event_name` VARCHAR(45) NOT NULL,
  `event_date` DATETIME NOT NULL,
  PRIMARY KEY (`event_id`)
  );
  
  /* Creating Table for Prticipation to track the prticipation history as well as version which participation has stored */
  CREATE TABLE `rexx_code_challenge`.`participation` (
  `participation_id` INT(11) NOT NULL,
  `employee_id` INT(11) NOT NULL,
  `event_id` INT(11) NOT NULL,
  `participation_fee` FLOAT NOT NULL,
  `version` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`participation_id`),
  CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`)
        REFERENCES `rexx_code_challenge`.`employee` (`employee_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `event_id` FOREIGN KEY (`event_id`)
        REFERENCES `rexx_code_challenge`.`events` (`event_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);