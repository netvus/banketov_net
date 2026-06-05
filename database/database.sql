CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fio VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user'
);

CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    hall_type VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    status ENUM('new','assigned','finished') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_applications_user_id (user_id),
    INDEX idx_applications_status (status),
    INDEX idx_applications_event_date (event_date),
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    application_id INT NOT NULL,
    review_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_reviews_user_id (user_id),
    INDEX idx_reviews_application_id (application_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,
    FOREIGN KEY (application_id) REFERENCES applications(id)
    ON DELETE CASCADE
);

INSERT INTO users
(login,password,fio,phone,email,role)
VALUES
(
'Admin26',
'$2y$10$5xa6QwLImVkR3TPbXWOvcOexulT7NfFKfFND/Ju.cONJm.rVUmKiO',
'Администратор',
'+79999999999',
'admin@test.ru',
'admin'
);
