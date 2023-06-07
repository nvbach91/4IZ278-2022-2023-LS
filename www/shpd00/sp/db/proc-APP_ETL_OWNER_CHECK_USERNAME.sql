DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.check_username
	(	 IN p_username 				VARCHAR(63)		)
BEGIN
	SELECT
		 EXISTS(SELECT username FROM appuserowner.user where username = p_username) as username_exists
	FROM DUAL;
END$$
DELIMITER ;

call phpetlowner.check_username_email ('testusername');