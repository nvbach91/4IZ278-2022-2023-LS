create schema DEVICE_OWNER;
create schema USER_OWNER;
create schema PHP_ETL_OWNER;

create user php_user@localhost IDENTIFIED BY 'password';

grant select on DEVICE_OWNER.* to php_user@localhost;