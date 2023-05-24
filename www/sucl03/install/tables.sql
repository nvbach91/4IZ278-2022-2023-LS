-- LXSX CROSS MILE MYSQL LAYOUT

-- TABLES

CREATE TABLE `clubs_cas` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `short` varchar(8) NOT NULL,
 `name` varchar(64) NOT NULL,
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `short` (`short`),
 UNIQUE KEY `name` (`name`),
 CONSTRAINT `CHK_short` CHECK (octet_length(`short`) >= 4),
 CONSTRAINT `CHK_name` CHECK (octet_length(`name`) >= 4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `genders` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(64) NOT NULL,
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `users` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `email` varchar(64) NOT NULL,
 `password` varchar(32) NOT NULL,
 `last_name` varchar(32) NOT NULL,
 `first_name` varchar(32) NOT NULL,
 `gender` bigint(20) unsigned NOT NULL,
 `birthday` date NOT NULL,
 `year` int(10) unsigned GENERATED ALWAYS AS (year(`birthday`)) STORED,
 `club` varchar(64) NOT NULL,
 `acl` bigint(20) unsigned NOT NULL DEFAULT 0,
 `status` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '0 new, 1 confirmed, 2 ready, 3 suspended',
 `created` timestamp NOT NULL DEFAULT current_timestamp(),
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 KEY `gender` (`gender`),
 CONSTRAINT `users_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `genders` (`id`) ON UPDATE CASCADE,
 CONSTRAINT `CHK_email` CHECK (`email` regexp '^[^@]+@[^@]+\\.[^@]{2,}$'),
 CONSTRAINT `CHK_birthday` CHECK (`birthday` > '1900-01-01' and `birthday` <= '2100-01-01'),
 CONSTRAINT `CHK_status` CHECK (`status` >= 0 and `status` <= 3),
 CONSTRAINT `CHK_password` CHECK (octet_length(`password`) >= 6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `users_confirmation_hashes` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `user` bigint(20) unsigned NOT NULL,
 `hash` varchar(128) NOT NULL,
 `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `user` (`user`),
 CONSTRAINT `users_confirmation_hashes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `CHK_hash` CHECK (octet_length(`hash`) >= 6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `users_logins` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `user` bigint(20) unsigned NOT NULL,
 `login_type` varchar(32) NOT NULL DEFAULT 'www',
 `hostname` varchar(128) DEFAULT NULL,
 `ip_addr` varchar(64) NOT NULL,
 `port` int(10) unsigned NOT NULL,
 `country_name` varchar(32) DEFAULT NULL,
 `city_name` varchar(32) DEFAULT NULL,
 `created` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `users_logins_ibfk_1` (`user`),
 CONSTRAINT `users_logins_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `users_logins_failed` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(128) NOT NULL,
 `password` varchar(128) NOT NULL,
 `login_type` varchar(32) NOT NULL DEFAULT 'www',
 `hostname` varchar(128) DEFAULT NULL,
 `ip_addr` varchar(64) NOT NULL,
 `port` int(10) unsigned NOT NULL,
 `country_name` varchar(32) DEFAULT NULL,
 `city_name` varchar(32) DEFAULT NULL,
 `created` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `users_oauth2` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `user` bigint(20) unsigned NOT NULL,
 `service` enum('GOOGLE','SKMILE','GITHUB') NOT NULL,
 `serial` varchar(256) NOT NULL,
 `token` text NOT NULL DEFAULT '',
 `cretaed` timestamp NOT NULL DEFAULT current_timestamp(),
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `service` (`service`,`serial`),
 KEY `user` (`user`,`service`) USING BTREE,
 CONSTRAINT `users_oauth2_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `races` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(128) NOT NULL,
 `race_date` date NOT NULL,
 `registration_open` datetime NOT NULL,
 `registration_close` datetime NOT NULL,
 `unregistration_close` datetime DEFAULT NULL COMMENT 'NULL -> unregistration not allowed',
 `status` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '0 disabled, 1 enabled',
 `created` timestamp NOT NULL DEFAULT current_timestamp(),
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 CONSTRAINT `CHK_name` CHECK (octet_length(`name`) >= 3),
 CONSTRAINT `CHK_race_date` CHECK (`race_date` > '2023-01-01' and `race_date` <= '2100-01-01'),
 CONSTRAINT `CHK_registration_open` CHECK (`registration_open` > '2023-01-01' and `registration_open` <= `race_date`),
 CONSTRAINT `CHK_registration_close` CHECK (`registration_close` > `registration_open` and `registration_close` <= `race_date`),
 CONSTRAINT `CHK_unregistration_close` CHECK (`unregistration_close` is null or `unregistration_close` > `registration_open` and `unregistration_close` <= `race_date`),
 CONSTRAINT `CHK_status` CHECK (`status` >= 0 and `status` <= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `disciplines` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `race` bigint(20) unsigned NOT NULL,
 `name` varchar(64) NOT NULL,
 `description` varchar(64) NOT NULL,
 `fee` int(10) unsigned NOT NULL DEFAULT 0,
 `year_from` int(10) unsigned NOT NULL,
 `year_to` int(10) unsigned NOT NULL,
 `gender` bigint(20) unsigned DEFAULT NULL COMMENT '2 male, 1 female, NULL both',
 `max_count` int(10) unsigned DEFAULT NULL COMMENT 'NULL -> no limit',
 `start` datetime NOT NULL,
 `status` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '0 disabled, 1 enabled',
 `created` timestamp NOT NULL DEFAULT current_timestamp(),
 `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `race` (`race`),
 KEY `gender` (`gender`),
 CONSTRAINT `disciplines_ibfk_1` FOREIGN KEY (`race`) REFERENCES `races` (`id`) ON UPDATE CASCADE,
 CONSTRAINT `disciplines_ibfk_2` FOREIGN KEY (`gender`) REFERENCES `genders` (`id`) ON UPDATE CASCADE,
 CONSTRAINT `CHK_name` CHECK (octet_length(`name`) >= 3),
 CONSTRAINT `CHK_description` CHECK (octet_length(`description`) >= 2),
 CONSTRAINT `CHK_year_from` CHECK (`year_from` > 1900 and `year_from` <= 2099),
 CONSTRAINT `CHK_status` CHECK (`status` >= 0 and `status` <= 1),
 CONSTRAINT `CHK_year_to` CHECK (`year_to` > 1900 and `year_to` <= `year_from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

CREATE TABLE `registrations` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `discipline` bigint(20) unsigned NOT NULL,
 `user` bigint(20) unsigned NOT NULL,
 `note` varchar(128) DEFAULT NULL,
 `status` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '0 inactive, 1 ready, 2 paid, 3 suspended',
 `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `discipline` (`discipline`,`user`) USING BTREE,
 KEY `user` (`user`),
 CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`discipline`) REFERENCES `disciplines` (`id`) ON UPDATE CASCADE,
 CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `CHK_status` CHECK (`status` >= 0 and `status` <= 3),
 CONSTRAINT `CHK_note` CHECK (`note` is null or octet_length(`note`) >= 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4


-- PROCEDURES

DELIMITER $$
CREATE DEFINER=`lxsx`@`localhost` PROCEDURE `check_discipline_registration`(IN `id_new` BIGINT UNSIGNED, IN `year_from_new` VARCHAR(32), IN `year_to_new` VARCHAR(32))
    READS SQL DATA
    DETERMINISTIC
BEGIN
	IF NOT (SELECT FALSE
		FROM registrations t1
		JOIN users t2 ON t2.id = t1.user
		WHERE t1.discipline = id_new AND (year_from_new < t2.year OR year_to_new > t2.year)
		LIMIT 1) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Discipline years range doesnt meet registered user';
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`lxsx`@`localhost` PROCEDURE `check_user_discipline`(IN `user_id` BIGINT UNSIGNED, IN `discipline_id` BIGINT UNSIGNED)
    READS SQL DATA
    DETERMINISTIC
BEGIN
    IF NOT (SELECT IF(t1.year <= t2.year_from AND t1.year >= t2.year_to, TRUE, FALSE)
    FROM users t1, disciplines t2
    WHERE t1.id = user_id AND t2.id = discipline_id
    LIMIT 1) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User year not in discipline range';
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`lxsx`@`localhost` PROCEDURE `check_user_registration`(IN `id_new` BIGINT UNSIGNED, IN `year_new` INT UNSIGNED)
    READS SQL DATA
    DETERMINISTIC
BEGIN
	IF NOT (SELECT FALSE
		FROM registrations t1
		JOIN disciplines t2 ON t2.id = t1.discipline
		WHERE t1.user = id_new AND (t2.year_from < year_new OR t2.year_to > year_new)
		LIMIT 1) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User year not in registered discipline range';
	END IF;
END$$
DELIMITER ;

-- TRIGGERS

CREATE TRIGGER `disciplines_after_insert` AFTER INSERT ON `disciplines`
 FOR EACH ROW UPDATE races SET modified = NOW() WHERE id = NEW.race

CREATE TRIGGER `disciplines_after_update` AFTER UPDATE ON `disciplines`
 FOR EACH ROW UPDATE races SET modified = NOW() WHERE id = NEW.race

CREATE TRIGGER `disciplines_before_update` BEFORE UPDATE ON `disciplines`
 FOR EACH ROW BEGIN
	CALL check_discipline_registration(NEW.id, NEW.year_from, NEW.year_to);
END

CREATE TRIGGER `registrations_before_insert` BEFORE INSERT ON `registrations`
 FOR EACH ROW CALL check_user_discipline(NEW.user, NEW.discipline)

CREATE TRIGGER `registrations_before_update` BEFORE UPDATE ON `registrations`
 FOR EACH ROW CALL check_user_discipline(NEW.user, NEW.discipline)

CREATE TRIGGER `users_before_update` BEFORE UPDATE ON `users`
 FOR EACH ROW BEGIN
	CALL check_user_registration(NEW.id, NEW.year);
END

-- EVENTS

CREATE DEFINER=`lxsx`@`localhost` EVENT `delete_old_hashes` ON SCHEDULE EVERY 1 HOUR STARTS '2023-04-01 04:03:03' ON COMPLETION PRESERVE ENABLE DO BEGIN
	DELETE FROM users_confirmation_hashes WHERE created < DATE_SUB(NOW(), INTERVAL 3 HOUR);
END

CREATE DEFINER=`lxsx`@`localhost` EVENT `delete_old_logins` ON SCHEDULE EVERY 1 DAY STARTS '2023-04-01 04:04:04' ON COMPLETION PRESERVE ENABLE DO BEGIN
	DELETE FROM users_logins WHERE created < DATE_SUB(NOW(), INTERVAL 35 DAY);
	DELETE FROM users_logins_failed WHERE created < DATE_SUB(NOW(), INTERVAL 95 DAY);
END