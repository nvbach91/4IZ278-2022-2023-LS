DELIMITER $$

CREATE OR REPLACE PROCEDURE phpetlowner.get_user_devices
	(	 IN p_app 				VARCHAR(63)
		,IN p_username			VARCHAR(63)
		,IN p_token				VARCHAR(63)
	)
this_proc : BEGIN
	IF phpetlowner.check_session(p_app,p_username,p_token)
	THEN 
		SELECT 
			d.serial_number
			,d.device_key
			,(	SELECT CASE WHEN m.datetime_val > CURTIME()
							THEN TRUE
							ELSE FALSE 
              			END AS device_online
				FROM  		deviceowner.measure_type mt
					JOIN	deviceowner.measure m
						ON 	mt.measure_type_name = 'device_status'
						AND m.device_key = d.device_key
						AND mt.measure_type_key = m.measure_type_key
						AND m.deleted_flag = 'N'
				ORDER BY m.measure_datetime DESC
				LIMIT 1
			) AS device_online
			,(	SELECT bool_val as door_open
				FROM  		deviceowner.measure_type mt
					JOIN	deviceowner.measure m
						ON 	mt.measure_type_name = 'door_state'
						AND m.device_key = d.device_key
						AND mt.measure_type_key = m.measure_type_key
						AND m.deleted_flag = 'N'
				ORDER BY m.measure_datetime DESC
				LIMIT 1
			) AS last_state
		FROM  		deviceowner.setting_type st
			JOIN	deviceowner.device_settings ds
				ON 	st.setting_type_name = 'device_owner'
				AND st.setting_type_key = ds.setting_type_key
				AND ds.varchar_val = p_username
				AND ds.CURRENT_flag = 'Y'
				AND ds.deleted_flag = 'N'
			JOIN	appuserowner.user u
				ON 	u.username = p_username
				AND ds.varchar_val = u.username
			JOIN 	deviceowner.device d
				ON 	ds.device_key = d.device_key
		;
	ELSE
		SELECT FALSE as success, 'Session expired' as message FROM DUAL;
	END IF;
END this_proc$$
DELIMITER ;