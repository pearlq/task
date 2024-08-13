CREATE TABLE IF NOT EXISTS users
(
    id         SERIAL PRIMARY KEY,
    login      VARCHAR(255) NOT NULL UNIQUE,
    full_name  VARCHAR(255) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    role_id    INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles (id)
);