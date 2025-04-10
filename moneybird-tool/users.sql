-- Tabel voor User
CREATE TABLE User (
    user_id INT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isVerified BOOLEAN NOT NULL
);

-- Tabel voor Admin
CREATE TABLE Admin (
    user_id INT PRIMARY KEY,
    admin_id INT NOT NULL,
    admin_level INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);