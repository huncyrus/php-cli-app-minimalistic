

CREATE DATABASE my_database;

# check your users
SELECT User, Host FROM mysql.user;


GRANT ALL PRIVILEGES ON my_test_database.* TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON my_test_database.* TO 'user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE api_calls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(255),
    data TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE DATABASE my_test_database;

USE my_test_database;

CREATE TABLE api_calls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(255),
    data TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

