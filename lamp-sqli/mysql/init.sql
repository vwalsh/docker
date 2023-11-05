-- 
-- Default DB created, as well as a table and finally some data inserted into this table
-- modify this as desired and then restart the docker container (docker compose down && docker compose up)
-- 

-- NOTE: The database name needs to match the MYSQL_DATABASE variable value within docker-compose.yml
-- NOTE: this is also referenced in the db.php to indicate which database name to connect to.
CREATE DATABASE IF NOT EXISTS sqli_database;
USE sqli_database;


-- "users" table:
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user VARCHAR(255) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);
-- users table data:
INSERT INTO users (user, pass, email) VALUES ('testuser', 'testuserpassword', 'test@example.com');
INSERT INTO users (user, pass, email) VALUES ('admin', 'adminspassword', 'admin@example.com');



-- "secrets" table:
CREATE TABLE IF NOT EXISTS secrets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  secretdata VARCHAR(255) NOT NULL
);
-- secrets table data:
INSERT INTO secrets (secretdata) VALUES ('super sneaky link');
INSERT INTO secrets (secretdata) VALUES ('moar secret data');
INSERT INTO secrets (secretdata) VALUES ('the answer is 42');
