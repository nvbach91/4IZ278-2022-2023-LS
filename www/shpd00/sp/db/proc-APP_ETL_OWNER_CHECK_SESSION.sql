DELIMITER $$
CREATE OR REPLACE FUNCTION phpetlowner.check_session
	(	 p_app 				VARCHAR(63)
		,p_username			VARCHAR(63)
		,p_session_token	VARCHAR(63)
	)
RETURNS boolean
BEGIN 
	IF EXISTS(
				SELECT 1
				FROM 		appuserowner.user u
					JOIN	appuserowner.session s
						ON	u.username = p_username
						AND s.session_token = p_session_token
						AND	u.user_key = s.user_key
						AND CURTIME()	BETWEEN	s.valid_from
											AND s.valid_to
						AND s.deleted_flag = 'N'
					JOIN	appuserowner.application a
						ON 	a.app_name = p_app
						AND s.app_key = a.app_key
			)
	THEN RETURN TRUE;
	ELSE RETURN FALSE;
	END IF;
END$$

CREATE OR REPLACE PROCEDURE phpetlowner.verify_session
	(	 p_app 				VARCHAR(63)
		,p_username			VARCHAR(63)
		,p_token			VARCHAR(63)
	)
BEGIN 
	SELECT phpetlowner.check_session(p_app,p_username,p_token) AS success FROM DUAL;
END$$

DELIMITER ;
