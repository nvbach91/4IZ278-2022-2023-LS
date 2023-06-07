DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.ADD_DEVICE 
	(	 IN p_dev_serial 		CHAR(31)
		,IN p_dev_key			VARCHAR(63)
		,IN p_dev_model 		VARCHAR(63)
	)
BEGIN
	   INSERT INTO deviceowner.device (serial_number,device_secret_key,device_model_key)
        VALUES (    p_dev_serial
					,p_dev_key
					,(SELECT device_model_key FROM deviceowner.device_model WHERE model_name= p_dev_model )
		);				
        commit;
END$$
DELIMITER ;

