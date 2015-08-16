-- Nickel Application (S Rayner, civrays)
--
-- MySQL database schema.
--

DROP TABLE IF EXISTS `job`;
DROP TABLE IF EXISTS `location`;
DROP TABLE IF EXISTS `customer`;
DROP TABLE IF EXISTS `staff`;

-- Table structure for table `staff`
CREATE TABLE `staff` (
  `staff_id`   int(11)     NOT NULL AUTO_INCREMENT,
  `first_name` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `last_name`  varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date        NOT NULL,
  `hire_date`  date        NOT NULL,
  `job_title`  varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active`     tinyint(1)  NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for 'customer;
CREATE TABLE `customer` (
  `customer_id`   int(11)      NOT NULL AUTO_INCREMENT,
  `company_name`  varchar(45)  COLLATE utf8_unicode_ci NOT NULL,
  `phone_no`      varchar(12)  COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_no`        varchar(12)  COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for table `location`
CREATE TABLE `location` (
  `location_id`       int(11)     NOT NULL AUTO_INCREMENT,
  `organisation_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address_line1`     varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2`     varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_town`         varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county`            varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code`         varchar(8)  COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id`       int(11)     NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `fk_location_customer_idx` (`customer_id`),
  CONSTRAINT `fk_location_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for table `job`
CREATE TABLE `job` (
  `job_id`          int(11) NOT NULL AUTO_INCREMENT,
  `location_id`     int(11) NOT NULL,
  `job_description` text    COLLATE utf8_unicode_ci NOT NULL,
  `notes`           text    COLLATE utf8_unicode_ci NOT NULL,
  `job_date`        date    NOT NULL,
  `staff_id`        int(11) DEFAULT NULL,
  `job_type`        varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  KEY `fk_job_address_idx` (`location_id`),
  KEY `fk_job_staff_idx` (`staff_id`),
  CONSTRAINT `fk_job_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;