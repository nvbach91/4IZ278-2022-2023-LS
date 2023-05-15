DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.grant_app_role
	(	 IN p_username 				VARCHAR(63)
		,IN p_role					VARCHAR(63)
	)
BEGIN
	INSERT INTO appuserowner.user_roles(user_key, role_key)
    VALUES(	(select user_key from appuserowner.user	u where u.username = p_username)
            ,(select r.role_key from appuserowner.role	r where r.role_name = p_role)
          );
	commit;
END$$

CREATE OR REPLACE PROCEDURE phpetlowner.log_in_user
	(	 IN p_app					VARCHAR(63)
		,IN p_username 				VARCHAR(63)
		,IN p_password_hash			VARCHAR(63)
        ,IN p_session_id			VARCHAR(63)
	)
this_proc : BEGIN
	IF NOT EXISTS ( 	select 0 
						from appuserowner.user	u
						where u.username = p_username and u.password_hash = p_password_hash 
				   )
	THEN 
		SELECT FALSE as success, "Wrong username or password" as message FROM DUAL;
        LEAVE this_proc;
    ELSEIF NOT EXISTS (	select 0 
							from appuserowner.user	u
							join appuserowner.user_roles ur
								on u.username = p_username
								and u.user_key = ur.user_key
                                and CURTIME() BETWEEN ur.valid_from and ur.valid_to
                                and ur.deleted_flag = 'N'
							join appuserowner.role r
								on ur.role_key = r.role_key
							join appuserowner.application a
								on r.app_key = a.app_key
								and a.app_name = p_app
						)
	THEN
		IF NOT EXISTS (		select 0 
							from appuserowner.application	a
							where a.app_name = p_app
                            and a.autoreg_role_key IS NOT NULL
						)
		THEN
			SELECT FALSE as success, "User has not access to the app" as message FROM DUAL;
            LEAVE this_proc;
        ELSE
			CALL phpetlowner.grant_app_role(	p_username
												,(select r.role_name
												from appuserowner.application a
												join appuserowner.role r
												on a.app_name = p_app
												and a.autoreg_role_key = r.role_key)
											);
			
        END IF;
    END IF;
		INSERT INTO appuserowner.session(user_key,app_key,session_id)
        VALUES(
			(SELECT user_key FROM appuserowner.user WHERE username = p_username AND deleted_flag = 'N')
            ,(SELECT app_key FROM appuserowner.application WHERE app_name = p_app)
            ,p_session_id
        );
        commit;
		SELECT TRUE as success, 'Log in successful' as message FROM DUAL;
END this_proc$$
DELIMITER ;

CALL phpetlowner.log_in_user('doorkeeper','test_username','password_hash','session_id');

