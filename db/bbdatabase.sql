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

------table structure for books
CREATE TABLE books (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  cover_image VARCHAR(255),
  description TEXT,
  genre VARCHAR(50),
  availability BOOLEAN DEFAULT true
);
