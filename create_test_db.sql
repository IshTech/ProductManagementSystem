CREATE DATABASE IF NOT EXISTS test_prodms
DEFAULT CHARACTER SET = utf8mb4
DEFAULT COLLATE = utf8mb4_unicode_ci
;

CREATE USER IF NOT EXISTS 'test_prodms'
IDENTIFIED BY 'test_prodms'
;

GRANT ALL ON test_prodms.* TO 'test_prodms'@'%'
;
