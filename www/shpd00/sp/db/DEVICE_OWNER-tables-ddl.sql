DROP TABLE `deviceowner`.`device`;
DROP TABLE `deviceowner`.`device_model`;
DROP TABLE `deviceowner`.`device_type`;
DROP TABLE `deviceowner`.`measure`;
DROP TABLE `deviceowner`.`measure_type`;

CREATE TABLE `deviceowner`.`device` (
	device_key 			int unsigned 	NOT NULL AUTO_INCREMENT
	,device_model_key	int unsigned 	NOT NULL
	,serial_number		char(31)		NOT NULL UNIQUE
	,device_secret_key	char(63)
    ,PRIMARY KEY(device_key)
);

CREATE TABLE `deviceowner`.`device_type` (
	device_type_key		int unsigned	NOT NULL AUTO_INCREMENT
    ,device_type_name	varchar(63)		NOT NULL UNIQUE
	,type_desc			varchar(120)
    ,PRIMARY KEY(device_type_key)
);

CREATE TABLE `deviceowner`.`device_model` (
	device_model_key 	int unsigned	NOT NULL AUTO_INCREMENT
	,device_type_key	int unsigned	NOT NULL
	,model_name 		varchar(31)		NOT NULL UNIQUE
	,model_desc			varchar(120)
    ,PRIMARY KEY(device_model_key)
);

CREATE TABLE `deviceowner`.`measure` (
	measure_key 		INT UNSIGNED NOT NULL AUTO_INCREMENT
	,device_key 		INT UNSIGNED NOT NULL
	,measure_type_key	INT UNSIGNED NOT NULL
	,measure_datetime	DATETIME NOT NULL DEFAULT CURTIME()
	,text_val			text(4000)
	,num_val			int
	,float_val			float(24)
	,bool_val			boolean
	,datetime_val		datetime
	,deleted_flag		char(1)	NOT NULL DEFAULT 'N'
	,PRIMARY KEY(measure_key)
);

CREATE TABLE `deviceowner`.`measure_type` (
	measure_type_key	INT UNSIGNED NOT NULL AUTO_INCREMENT
	,measure_type_name	varchar(63)	NOT NULL UNIQUE
	,measure_type_desc	varchar(120)
    ,PRIMARY KEY(measure_type_key)
);

CREATE TABLE `deviceowner`.`device_settings` (
	device_setting_key 	INT UNSIGNED NOT NULL AUTO_INCREMENT
	,device_key 		INT UNSIGNED NOT NULL
	,setting_type_key	INT UNSIGNED NOT NULL
	,valid_from			DATETIME NOT NULL DEFAULT CURTIME()
	,current_flag		char(1)	NOT NULL DEFAULT 'N'
	,deleted_flag		char(1)	NOT NULL DEFAULT 'N'
	,varchar_val		varchar(255)
	,num_val			int
	,float_val			float(24)
	,bool_val			boolean
	,datetime_val		datetime
	,PRIMARY KEY(device_setting_key)
);

CREATE TABLE `deviceowner`.`setting_type` (
	setting_type_key	INT UNSIGNED NOT NULL AUTO_INCREMENT
	,setting_type_name	varchar(63)	NOT NULL UNIQUE
	,setting_type_desc	varchar(120)
    ,PRIMARY KEY(setting_type_key)
);

ALTER TABLE deviceowner.device_model ADD CONSTRAINT fk_dev_model_dev_type FOREIGN KEY (device_type_key) REFERENCES deviceowner.device_type(device_type_key) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE deviceowner.measure ADD CONSTRAINT fk_measure_measure_type FOREIGN KEY (measure_type_key) REFERENCES deviceowner.measure_type(measure_type_key) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE deviceowner.device_settings ADD CONSTRAINT fk_device_settings_setting_type FOREIGN KEY (setting_type_key) REFERENCES deviceowner.setting_type(setting_type_key) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE deviceowner.device_settings ADD CONSTRAINT fk_device_settings_device FOREIGN KEY (device_key) REFERENCES deviceowner.device(device_key) ON DELETE CASCADE ON UPDATE CASCADE;
