CREATE TABLE IF NOT EXISTS roles
(
    id         SERIAL PRIMARY KEY,
    role       VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roles (role) VALUES
                             ('admin'),
                             ('manager');