DROP DATABASE IF EXISTS car_mgmt_sys;
CREATE DATABASE car_mgmt_sys 
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
GRANT ALL PRIVILEGES on car_mgmt_sys.* TO checo_perez@localhost IDENTIFIED BY 'Ch3c0_p3r3z';