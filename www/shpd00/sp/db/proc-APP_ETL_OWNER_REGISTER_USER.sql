DELIMITER $$
CREATE OR REPLACE PROCEDURE phpetlowner.REGISTER_USER 
	(	 IN p_username 				VARCHAR(63)
		,IN p_email		 			VARCHAR(63)
		,IN p_password_hash			VARCHAR(63)
		,IN p_registration_type 	varchar(31)
	)
BEGIN
	INSERT INTO appuserowner.user(username,email,password_hash,registration_type_key)
	values
	(
		 p_username
         ,p_email
         ,p_password_hash	
         ,(	select rt.reg_type_key 
			from appuserowner.registration_type rt 
            where 	rt.deleted_flag <> 'Y' 
				and rt.reg_type_name = p_registration_type
		  )
	);
         commit;
END$$
DELIMITER ;

CALL phpetlowner.REGISTER_USER('test_username','test_email','password_hash','lab10');

