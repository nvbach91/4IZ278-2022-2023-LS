
CREATE OR REPLACE VIEW phpetlowner.device_owner AS
SELECT d.device_key, d.serial_number, u.user_key, u.username
FROM  		deviceowner.setting_type st
	JOIN	deviceowner.device_settings ds
		ON 	st.setting_type_name = 'device_owner'
		AND st.setting_type_key = ds.setting_type_key
		AND ds.CURRENT_flag = 'Y'
		AND ds.deleted_flag = 'N'
	JOIN 	deviceowner.device d
		ON 	ds.device_key = d.device_key
	JOIN	appuserowner.user u
		ON 	ds.varchar_val = u.username
;
		
		
CREATE OR REPLACE VIEW phpetlowner.device_current_status AS
SELECT user_key, device_key, device_online, device_status
FROM  		deviceowner.measure_type mt
	JOIN	deviceowner.measure m
		ON 	mt.measure_type_name = 'device_status'
		AND mt.measure_type_key = m.measure_type_key
		AND m.current_flag = 'Y'
		AND m.deleted_flag = 'N'
	JOIN	
		



DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.check_session
	(	 IN p_app 				VARCHAR(63)
		,IN p_username			VARCHAR(63)
		,IN p_session_id		VARCHAR(63)
		,IN p_session_key		VARCHAR(63)
	)
BEGIN
	SELECT s.session_id
	FROM 		appuserowner.user u
		JOIN	appuserowner.session s
			ON	u.username = p_username
			AND	u.user_key = s.user_key
			AND CURTIME()	BETWEEN	s.valid_from
								AND s.valid_to
			AND s.deleted_flag = 'N'
		JOIN	appuserowner.application a
			ON 	a.app_name = p_app
			AND s.app_key = a.app_key;	
END$$

CREATE OR REPLACE PROCEDURE phpetlowner.get_user_devices
	(	 IN p_app 				VARCHAR(63)
		,IN p_username			VARCHAR(63)
		,IN p_session_id		VARCHAR(63)
		,IN p_session_key		VARCHAR(63)
	)
DECLARE 
	v_device_list;
this_proc : BEGIN
	IF EXISTS ( EXEC phpetlowner.check_session(p_app,p_username,p_session_id,p_session_key) )
	THEN 
		
		SELECT d.device_key, d.serial_number, u.user_key, u.username
			FROM  		deviceowner.setting_type st
				JOIN	deviceowner.device_settings ds
					ON 	st.setting_type_name = 'device_owner'
					AND st.setting_type_key = ds.setting_type_key
					AND ds.CURRENT_flag = 'Y'
					AND ds.deleted_flag = 'N'
				JOIN	appuserowner.user u
					ON 	u.username = p_username
					AND ds.varchar_val = u.username
				JOIN 	deviceowner.device d
					ON 	ds.device_key = d.device_key
				
		
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

