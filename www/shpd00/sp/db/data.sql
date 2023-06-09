INSERT INTO appuserowner.role (role_name)
VALUES ('doorkeeper_user');

INSERT INTO appuserowner.application (app_name,app_desc,autoreg_role_key)
VALUES 
(	'Doorkeeper'
	,'Semestralka'
	,(SELECT role_key FROM appuserowner.role WHERE role_name='doorkeeper_user')
);

INSERT INTO appuserowner.registration_type (reg_type_name,app_key,default_role_key)
VALUES 
(	'doorkeeper_reg_page'
	,(SELECT app_key FROM appuserowner.application WHERE app_name='Doorkeeper')
	,(SELECT role_key FROM appuserowner.role WHERE role_name='doorkeeper_user')
);


INSERT INTO deviceowner.device_type (device_type_name)
VALUES ('autonomous_door_sensor');

INSERT INTO deviceowner.device_model (device_type_key,model_name,model_desc)
VALUES 
(	(SELECT device_type_key FROM deviceowner.device_type WHERE device_type_name='autonomous_door_sensor')
	,'door_sensor_test_0_01_a'
	,'semestralka webove technologie'
);

INSERT INTO deviceowner.measure_type (measure_type_name,measure_type_desc)
VALUES ('device_status', 'general status report - im online message, timestamp - next expected report');

INSERT INTO deviceowner.measure_type (measure_type_name,measure_type_desc)
VALUES ('door_state', 'opened/closed');

INSERT INTO deviceowner.setting_type (setting_type_name,setting_type_desc)
VALUES ('device_owner', 'username of device owner');

truncate deviceowner.device_settings;

INSERT INTO deviceowner.device_settings (setting_type_key,device_key,varchar_val,current_flag)
VALUES 
(	(SELECT setting_type_key FROM deviceowner.setting_type WHERE setting_type_name ='device_owner')
	,(SELECT device_key FROM deviceowner.device WHERE serial_number='test5')
	,'test'
	,'Y'
);

INSERT INTO appuserowner.session(user_key,app_key,session_id,valid_to)
values(1,2,'test',DATE_ADD(CURTIME(),INTERVAL 3600 SECOND));

commit;
