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

commit;