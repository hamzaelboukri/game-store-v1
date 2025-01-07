

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') NOT NULL,
    deleted_at DATETIME DEFAULT NULL
);


ALTER TABLE users
ADD COLUMN STATUSE ENUM('ACTIVE', 'desective') NOT NULL,

ALTER TABLE users
MODIFY COLUMN STATUSE ENUM('ACTIVE', 'desective') NOT NULL DEFAULT 'ACTIVE' ;


ALTER TABLE users
ADD COLUMN reset_token VARCHAR(255) UNIQUE DEFAULT NULL,
ADD COLUMN reset_token_expiry DATETIME DEFAULT NULL;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    price FLOAT NOT NULL,
    stock INT NOT NULL,
    deleted_at DATETIME DEFAULT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total FLOAT NOT NULL,
    status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE product_manager (
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price FLOAT NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
