DROP TABLE appuserowner.application;
DROP TABLE appuserowner.registration_type;
DROP TABLE appuserowner.role;
DROP TABLE appuserowner.user;
DROP TABLE appuserowner.user_roles;
DROP TABLE appuserowner.session;

CREATE TABLE appuserowner.application (
	app_key				INT UNSIGNED NOT NULL AUTO_INCREMENT
	,app_name			VARCHAR(31)	NOT NULL UNIQUE
	,app_desc			VARCHAR(120)
    ,autoreg_role_key 	INT UNSIGNED
    ,PRIMARY KEY (app_key)
);

CREATE TABLE appuserowner.role (
	role_key				INT UNSIGNED	NOT NULL AUTO_INCREMENT
    ,app_key				INT UNSIGNED	NOT NULL
	,role_name				VARCHAR(31)		NOT NULL UNIQUE
	,role_desc				VARCHAR(120)
	,deleted_flag			CHAR(1) 		NOT NULL DEFAULT 'N'
	,PRIMARY KEY (role_key)
);

CREATE TABLE appuserowner.registration_type (
	reg_type_key			INT UNSIGNED	NOT NULL AUTO_INCREMENT 
	,reg_type_name			VARCHAR(31)		NOT NULL UNIQUE
	,reg_type_desc			VARCHAR(120)
    ,app_key				INT UNSIGNED	NOT NULL
    ,default_role_key		INT UNSIGNED	NOT NULL
	,deleted_flag			CHAR(1) 		NOT NULL DEFAULT 'N'
	,PRIMARY KEY (reg_type_key)
);

CREATE TABLE appuserowner.user (
	user_key			INT UNSIGNED		NOT NULL AUTO_INCREMENT
	,username			VARCHAR(63)			NOT NULL UNIQUE
	,email				VARCHAR(63)			NOT NULL UNIQUE
	,password_hash		VARCHAR(63)			NOT NULL
	,registration_type_key 	INT UNSIGNED	NOT NULL 
	,registration_datetime	datetime 		NOT NULL DEFAULT  CURTIME()
	,deleted_flag		CHAR(1) 			NOT NULL DEFAULT 'N'
	,PRIMARY KEY (user_key)
	,INDEX idx_user_user_pass (username,password_hash)
);

CREATE TABLE appuserowner.user_roles (
	user_key 			INT UNSIGNED NOT NULL
	,role_key			INT UNSIGNED NOT NULL
	,valid_from 		DATETIME	NOT NULL DEFAULT CURTIME()
	,valid_to			DATETIME	NOT NULL DEFAULT '9999-12-31 23:59:59'
	,deleted_flag		CHAR(1)		NOT NULL DEFAULT 'N'
);

CREATE TABLE appuserowner.session (
	session_key 		INT UNSIGNED	NOT NULL AUTO_INCREMENT 
	,user_key 			INT UNSIGNED	NOT NULL
	,app_key			INT UNSIGNED	NOT NULL
	,session_id			varchar(63)		NOT NULL
	,valid_from 		datetime 		NOT NULL DEFAULT  CURTIME()
	,valid_to			datetime 		NOT NULL DEFAULT  DATE_ADD(CURTIME(), INTERVAL 1 DAY)
	,deleted_flag		CHAR(1)			NOT NULL DEFAULT  'N'
	,PRIMARY KEY (session_key)
);

ALTER TABLE appuserowner.application ADD CONSTRAINT fk_app_autoreg_role FOREIGN KEY (autoreg_role_key) REFERENCES appuserowner.role(role_key) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE appuserowner.registration_type ADD CONSTRAINT fk_reg_type_role FOREIGN KEY (default_role_key) REFERENCES appuserowner.role(role_key) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE appuserowner.user ADD CONSTRAINT fk_user_reg_type FOREIGN KEY (registration_type_key) REFERENCES appuserowner.registration_type(reg_type_key) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE appuserowner.session ADD CONSTRAINT fk_sess_user FOREIGN KEY (user_key) REFERENCES appuserowner.user(user_key) ON DELETE CASCADE ON UPDATE CASCADE;