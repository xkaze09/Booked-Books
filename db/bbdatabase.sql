-------database for bookedbooks

-------table structure for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

------table structure for admins
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;
