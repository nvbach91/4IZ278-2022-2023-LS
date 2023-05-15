DROP TABLE `iot_base_owner`.`device`;
DROP TABLE `iot_base_owner`.`device_model`;
DROP TABLE `iot_base_owner`.`device_type`;
DROP TABLE `iot_base_owner`.`measure`;
DROP TABLE `iot_base_owner`.`measure_type`;


CREATE TABLE `iot_base_owner`.`device` (
	device_key 			int unsigned
	,device_model_key 	int unsigned
	,serial_number		varchar(63)
	,deleted_flag		char(1)
);

CREATE TABLE `iot_base_owner`.`device_type` (
	device_type_key		int unsigned
	,type_desc			varchar(120)
	,deleted_flag		char(1)
);

CREATE TABLE `iot_base_owner`.`device_model` (
	device_model_key 	int unsigned
	,device_type_key	int unsigned
	,model_name 		varchar(120)
	,model_desc			varchar(120)
	,deleted_flag		char(1)
);

CREATE TABLE `iot_base_owner`.`measure` (
	measure_key 		int unsigned
	,device_key 		int unsigned
	,measure_type_key	int unsigned
	,measure_datetime	datetime
	,text_val			text(4000)
	,num_val			int
	,float_val			float(24)
	,bool_val			boolean
	,datetime_val		datetime
	,deleted_flag		char(1)
);

CREATE TABLE `iot_base_owner`.`measure_type` (
	measure_type_key	int unsigned
	,measure_type_desc	varchar(120)
	,deleted_flag		char(1)
);

