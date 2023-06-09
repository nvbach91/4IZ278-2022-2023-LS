DELIMITER $$

CREATE OR REPLACE PROCEDURE phpetlowner.get_device_history
	(	 IN p_app 				VARCHAR(63)
		,IN p_username			VARCHAR(63)
		,IN p_token				VARCHAR(63)
		,IN p_serial			VARCHAR(63)
		,IN p_limit				INTEGER
		,IN p_offset			INTEGER
	)
this_proc : BEGIN
	IF phpetlowner.check_session(p_app,p_username,p_token)
	THEN 
-- 		SELECT 
-- 			d.serial_number
-- 			,d.device_key
-- 			,(	SELECT CASE WHEN m.datetime_val > CURTIME()
-- 							THEN TRUE
-- 							ELSE FALSE 
--               			END AS device_online
-- 				FROM  		deviceowner.measure_type mt
-- 					JOIN	deviceowner.measure m
-- 						ON 	mt.measure_type_name = 'device_status'
-- 						AND m.device_key = d.device_key
-- 						AND mt.measure_type_key = m.measure_type_key
-- 						AND m.deleted_flag = 'N'
-- 				ORDER BY m.measure_datetime DESC
-- 				LIMIT 1
-- 			) AS device_online
-- 			,(	SELECT bool_val as door_open
-- 				FROM  		deviceowner.measure_type mt
-- 					JOIN	deviceowner.measure m
-- 						ON 	mt.measure_type_name = 'door_state'
-- 						AND m.device_key = d.device_key
-- 						AND mt.measure_type_key = m.measure_type_key
-- 						AND m.deleted_flag = 'N'
-- 				ORDER BY m.measure_datetime DESC
-- 				LIMIT 1
-- 			) AS last_state
-- 		FROM  		deviceowner.setting_type st
-- 			JOIN	deviceowner.device_settings ds
-- 				ON 	st.setting_type_name = 'device_owner'
-- 				AND st.setting_type_key = ds.setting_type_key
-- 				AND ds.varchar_val = p_username
-- 				AND ds.CURRENT_flag = 'Y'
-- 				AND ds.deleted_flag = 'N'
-- 			JOIN	appuserowner.user u
-- 				ON 	u.username = p_username
-- 				AND ds.varchar_val = u.username
-- 			JOIN 	deviceowner.device d
-- 				ON	d.serial_number = p_serial
-- 				AND	ds.device_key = d.device_key
		SELECT
			m.time
			,m.event
		FROM 		deviceowner.device 			d
			JOIN	deviceowner.setting_type 	st
				ON	d.serial_number = p_serial
				AND	st.setting_type_name = 'device_owner'
			JOIN	deviceowner.device_settings ds
				ON	d.device_key = ds.device_key 
				AND	st.setting_type_key = ds.setting_type_key
				AND ds.CURRENT_flag = 'Y'
				AND ds.deleted_flag = 'N'
				AND ds.varchar_val = p_username
			CROSS JOIN	(
							SELECT 
								'Went offline'		as event
								,m1.datetime_val	as time
							FROM		deviceowner.measure_type	mt
								JOIN	deviceowner.device 			d
									ON	mt.measure_type_name 	= 'device_status'
									AND d.serial_number 		= p_serial
								JOIN	deviceowner.measure			m1
									ON	m1.device_key 			= d.device_key
									AND mt.measure_type_key 	= m1.measure_type_key
									AND m1.datetime_val 		< CURTIME()
									AND m1.deleted_flag 		= 'N'
							UNION ALL
							SELECT 
								'Went online'			as event
								,m2.measure_datetime	as time
							FROM		deviceowner.measure_type	mt
								JOIN	deviceowner.device 			d
									ON	mt.measure_type_name 	= 'device_status'
									AND d.serial_number 		= p_serial
								JOIN	deviceowner.measure			m2
									ON	m2.device_key 			= d.device_key
									AND mt.measure_type_key 	= m2.measure_type_key
									AND m2.deleted_flag 		= 'N'
							UNION ALL
							SELECT 
								CASE WHEN bool_val=1
									 THEN 'Open'
									 ELSE 'Closed'
								END						as event
								,m3.measure_datetime	as time
							FROM		deviceowner.measure_type	mt
								JOIN	deviceowner.device 			d
									ON	mt.measure_type_name 	= 'door_state'
									AND d.serial_number 		= p_serial
								JOIN	deviceowner.measure			m3
									ON	m3.device_key 			= d.device_key
									AND mt.measure_type_key 	= m3.measure_type_key
									AND m3.deleted_flag 		= 'N'
						) m
		ORDER BY m.time DESC
		LIMIT p_limit OFFSET p_offset
		;
	ELSE
		SELECT FALSE as success, 'Session expired' as message FROM DUAL;
	END IF;
END this_proc$$
DELIMITER ;

CALL phpetlowner.get_device_history('Doorkeeper','test','1168e9b64d9781edbfe11656687afc12','test5',20,0);

