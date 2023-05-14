DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.INSERT_MEASURE 
	(	 IN p_dev_serial 		CHAR(31)
		,IN p_dev_key		 	VARCHAR(63)
		,IN p_measure_type 		VARCHAR(63)
		,IN p_measure_datetime	DATETIME
		,IN p_sent_datetime 	DATETIME
		,IN p_text_value 		VARCHAR(400)
		,IN p_num_value 		INT
		,IN p_float_value 		FLOAT
		,IN p_bool_value		BOOLEAN
		,IN p_datetime_value	DATETIME
	)
BEGIN
	IF 		p_measure_type = 'device_status' 
		AND EXISTS(	SELECT 0 FROM		deviceowner.measure m
								JOIN	deviceowner.device d
									ON	d.serial_number 		= p_dev_serial
									AND d.device_secret_key 	= p_dev_key
									AND m.device_key 			= d.device_key
									AND DATE_ADD(CURTIME(),INTERVAL -15 SECOND) < m.datetime_val
									AND m.deleted_flag = 'N'
								JOIN	deviceowner.measure_type mt
									ON	mt.measure_type_name	= 'device_status' 
									AND	m.measure_type_key 		= mt.measure_type_key
					)
	THEN
		UPDATE 	deviceowner.measure m
		SET 	m.datetime_val 		= p_datetime_value
				,m.num_val 			= p_num_value
		WHERE	m.device_key 		=(	SELECT d.device_key 
										from deviceowner.device d
										where	d.serial_number = p_dev_serial 
											and d.device_secret_key = p_dev_key
									 )
			AND	m.measure_type_key	=(	SELECT mt.measure_type_key 
										from deviceowner.measure_type mt
										where mt.measure_type_name = p_measure_type
									 )
			AND DATE_ADD(CURTIME(),INTERVAL -15 SECOND) < m.datetime_val
			AND m.deleted_flag = 'N';
	ELSE
		INSERT INTO deviceowner.measure(device_key,measure_type_key,measure_datetime,text_val,num_val,float_val,bool_val,datetime_val)
		values
		(
			 (	SELECT d.device_key 
				from deviceowner.device d
				where	d.serial_number = p_dev_serial 
					and d.device_secret_key = p_dev_key
			 ),(SELECT mt.measure_type_key 
				from deviceowner.measure_type mt
				where mt.measure_type_name = p_measure_type
			 )
	         ,p_measure_datetime
	         ,p_text_value
	         ,p_num_value
	         ,p_float_value
	         ,p_bool_value
	         ,p_datetime_value
		);
	END IF;
	commit;
END$$
DELIMITER ;