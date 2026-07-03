CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','member','trainer') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE subscriptions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_name VARCHAR(50) NOT NULL,
    duration_months INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE  trainers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (100) NOT NULL,
    specialization VARCHAR(100) ,
    phone VARCHAR(20),
    email VARCHAR(100),
    salary DECIMAL(10,2),
    hire_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
ALTER TABLE trainers
ADD user_id INT;

ALTER TABLE trainers
ADD FOREIGN KEY (user_id) REFERENCES users(id)
ON DELETE CASCADE;

CREATE TABLE members(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subscription_id INT,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    gender ENUM('Male','Female'),
    date_of_birth DATE,
    address TEXT,
    image VARCHAR(255) DEFAULT 'default.png',
    join_date DATE DEFAULT (CURRENT_DATE),
    subscription_end_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
     FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON DELETE SET NULL
);


CREATE TABLE payments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATE DEFAULT (CURRENT_DATE),
    payment_method ENUM('Cash','Visa','MasterCard') DEFAULT 'Cash',
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE
);
CREATE TABLE member_trainer(
    member_id INT,
    trainer_id INT,
    assigned_date DATE DEFAULT (CURRENT_DATE),
    PRIMARY KEY (member_id,trainer_id),
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id) ON DELETE CASCADE
);

