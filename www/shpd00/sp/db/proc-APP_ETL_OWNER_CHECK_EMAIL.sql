DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.check_email
	(	 IN p_email		 			VARCHAR(63)		)
BEGIN
	SELECT
         EXISTS(SELECT email FROM appuserowner.user where email = p_email) AS email_exists
	FROM DUAL;
END$$
DELIMITER ;

call phpetlowner.check_email ('test_email');