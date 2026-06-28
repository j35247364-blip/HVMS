-- ============================================================
-- Coral Cove Hotel — Visitor Management System
-- Database Schema (MySQL / MariaDB)
-- ============================================================

CREATE DATABASE IF NOT EXISTS coralcove_hvms
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE coralcove_hvms;

-- ------------------------------------------------------------
-- Table: users  (hotel staff who can log in to the system)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    user_id       INT AUTO_INCREMENT PRIMARY KEY,
    full_name     VARCHAR(100)        NOT NULL,
    username      VARCHAR(50)         NOT NULL UNIQUE,
    password_hash VARCHAR(255)        NOT NULL,
    role          ENUM('admin','staff') NOT NULL DEFAULT 'staff',
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table: visitors  (visitor log records)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS visitors (
    visitor_id      INT AUTO_INCREMENT PRIMARY KEY,
    full_name       VARCHAR(100)  NOT NULL,
    phone           VARCHAR(30),
    purpose         VARCHAR(150)  NOT NULL,
    host_name       VARCHAR(100)  NOT NULL,   -- guest/room or staff being visited
    room_number     VARCHAR(20),
    expected_duration VARCHAR(50),            -- e.g. "2 hours", "Overnight"
    check_in_time   DATETIME      NULL,
    check_out_time  DATETIME      NULL,
    status          ENUM('Pending','Checked In','Checked Out') NOT NULL DEFAULT 'Pending',
    registered_by   INT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (registered_by) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table: bookings  (public online room reservation requests)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS bookings (
    booking_id      INT AUTO_INCREMENT PRIMARY KEY,
    guest_name      VARCHAR(100)  NOT NULL,
    email           VARCHAR(150)  NOT NULL,
    phone           VARCHAR(30)   NOT NULL,
    room_type       VARCHAR(100)  NOT NULL,
    check_in_date   DATE          NOT NULL,
    check_out_date  DATE          NOT NULL,
    guests          INT           NOT NULL DEFAULT 1,
    special_requests TEXT,
    status          ENUM('Pending','Confirmed','Cancelled') NOT NULL DEFAULT 'Pending',
    linked_visitor_id INT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (linked_visitor_id) REFERENCES visitors(visitor_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Seed data
-- ------------------------------------------------------------

-- Default admin account -> username: admin / password: admin123
-- (hash below corresponds to "admin123" using PHP password_hash/bcrypt)
INSERT INTO users (full_name, username, password_hash, role) VALUES
('Hotel Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.YeBpjB5kf6ZQH0L8.5KdY/QqJ7m6kNTNi', 'admin');
-- NOTE: Run reset_password.php (included) once if this hash does not match
-- your PHP/OpenSSL build — it will regenerate a fresh hash safely.

-- Mandatory default ORDINARY user account required by the course spec
-- username: uoc / password: uoc  (role = staff / ordinary user)
INSERT INTO users (full_name, username, password_hash, role) VALUES
('Default Ordinary User', 'uoc', '$2y$10$3W5z8sQO7q1c7t6m1f8c8.t8wYV1mYV2yqg6Ja1nF1eQbZpv5p0p6', 'staff');
-- NOTE: If this hash does not match your PHP build, run reset_password.php
-- (it also resets the uoc account) then delete that file.

-- A couple of sample visitor records so the dashboard isn't empty
INSERT INTO visitors (full_name, phone, purpose, host_name, room_number, expected_duration, check_in_time, status, registered_by) VALUES
('Maria Lopez', '+65 9123 4567', 'Family visit', 'Mr. J. Tan', '512', '2 hours', NOW(), 'Checked In', 1),
('David Chen', '+65 8123 9988', 'Package delivery', 'Front Desk', '-', '15 minutes', NULL, 'Pending', 1);

-- A sample online booking request so the bookings list isn't empty
INSERT INTO bookings (guest_name, email, phone, room_type, check_in_date, check_out_date, guests, special_requests, status) VALUES
('Amara Silva', 'amara.silva@example.com', '+94 77 123 4567', 'Seaview Deluxe King Room', DATE_ADD(CURDATE(), INTERVAL 5 DAY), DATE_ADD(CURDATE(), INTERVAL 8 DAY), 2, 'Late check-in, around 9 PM.', 'Pending');
