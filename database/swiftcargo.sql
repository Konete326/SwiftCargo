-- ============================================================
-- SwiftCargo - Courier Management System
-- Complete Database Schema + Seed Data
-- Import this file once in phpMyAdmin to set up everything
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- Create & Use Database
-- ------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `swiftcargo`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `swiftcargo`;

-- ------------------------------------------------------------
-- Table: cities
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id`        INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `name`      VARCHAR(100)    NOT NULL,
  `is_active` TINYINT(1)      NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: users  (admin + registered users)
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id`         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100)    NOT NULL,
  `email`      VARCHAR(150)    NOT NULL UNIQUE,
  `password`   VARCHAR(255)    NOT NULL,
  `phone`      VARCHAR(20)     NOT NULL DEFAULT '',
  `role`       ENUM('admin','user') NOT NULL DEFAULT 'user',
  `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: agents
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `agents`;
CREATE TABLE `agents` (
  `id`         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100)    NOT NULL,
  `email`      VARCHAR(150)    NOT NULL UNIQUE,
  `password`   VARCHAR(255)    NOT NULL,
  `phone`      VARCHAR(20)     NOT NULL DEFAULT '',
  `city_id`    INT UNSIGNED    NOT NULL,
  `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_agents_city` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: shipments
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE `shipments` (
  `id`               INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `tracking_number`  VARCHAR(30)      NOT NULL UNIQUE,
  `sender_name`      VARCHAR(100)     NOT NULL,
  `sender_phone`     VARCHAR(20)      NOT NULL,
  `sender_city_id`   INT UNSIGNED     NOT NULL,
  `receiver_name`    VARCHAR(100)     NOT NULL,
  `receiver_phone`   VARCHAR(20)      NOT NULL,
  `receiver_city_id` INT UNSIGNED     NOT NULL,
  `weight`           DECIMAL(8,2)     NOT NULL DEFAULT 0.00,
  `courier_type`     ENUM('standard','express','overnight','fragile') NOT NULL DEFAULT 'standard',
  `delivery_date`    DATE             NOT NULL,
  `amount`           DECIMAL(10,2)    NOT NULL DEFAULT 0.00,
  `status`           ENUM('booked','in_transit','out_for_delivery','delivered','cancelled') NOT NULL DEFAULT 'booked',
  `agent_id`         INT UNSIGNED     NOT NULL,
  `created_at`       DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_tracking`         (`tracking_number`),
  INDEX `idx_status`           (`status`),
  INDEX `idx_sender_city`      (`sender_city_id`),
  INDEX `idx_receiver_city`    (`receiver_city_id`),
  CONSTRAINT `fk_shipments_sender_city`   FOREIGN KEY (`sender_city_id`)   REFERENCES `cities` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_shipments_receiver_city` FOREIGN KEY (`receiver_city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_shipments_agent`         FOREIGN KEY (`agent_id`)         REFERENCES `users`  (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- SEED DATA
-- ============================================================

-- ------------------------------------------------------------
-- Cities (Pakistan major cities)
-- ------------------------------------------------------------

INSERT INTO `cities` (`name`, `is_active`) VALUES
  ('Karachi',     1),
  ('Lahore',      1),
  ('Islamabad',   1),
  ('Rawalpindi',  1),
  ('Peshawar',    1),
  ('Quetta',      1),
  ('Multan',      1),
  ('Faisalabad',  1),
  ('Hyderabad',   1),
  ('Sialkot',     1);

-- ------------------------------------------------------------
-- Admin User
-- Credentials: admin@gmail.com / admin123
-- ------------------------------------------------------------

INSERT INTO `users` (`name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
  ('Super Admin', 'admin@gmail.com', '$2y$10$pueqNR7e5YDlk4gLYqcVBe/vphlS6v/kBz4Axz0fK2pwsprIBdk.W', '03001234567', 'admin', NOW());

-- ------------------------------------------------------------
-- Sample Users
-- Password: user123
-- ------------------------------------------------------------

INSERT INTO `users` (`name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
  ('Ali Hassan',   'ali@gmail.com',   '$2y$10$Gj2PxH9IJg4cW4JCYH.3i.sdr7DqGUtkg7lYM/4Vv2lG2yxKAr0SK', '03111234567', 'user', NOW()),
  ('Sara Khan',    'sara@gmail.com',  '$2y$10$Gj2PxH9IJg4cW4JCYH.3i.sdr7DqGUtkg7lYM/4Vv2lG2yxKAr0SK', '03211234567', 'user', NOW()),
  ('Usman Tariq',  'usman@gmail.com', '$2y$10$Gj2PxH9IJg4cW4JCYH.3i.sdr7DqGUtkg7lYM/4Vv2lG2yxKAr0SK', '03311234567', 'user', NOW());

-- ------------------------------------------------------------
-- Sample Agents
-- Password: agent123
-- ------------------------------------------------------------

INSERT INTO `agents` (`name`, `email`, `password`, `phone`, `city_id`, `created_at`) VALUES
  ('Karachi Agent',   'agent.karachi@swiftcargo.com',   '$2y$10$I.8uSNxyrcCvbVDf6FsAYu.QwNQwapLftz/uwVi6hGWf6EJ.KjvIC', '03001112233', 1, NOW()),
  ('Lahore Agent',    'agent.lahore@swiftcargo.com',    '$2y$10$I.8uSNxyrcCvbVDf6FsAYu.QwNQwapLftz/uwVi6hGWf6EJ.KjvIC', '03001113344', 2, NOW()),
  ('Islamabad Agent', 'agent.islamabad@swiftcargo.com', '$2y$10$I.8uSNxyrcCvbVDf6FsAYu.QwNQwapLftz/uwVi6hGWf6EJ.KjvIC', '03001114455', 3, NOW());

-- ------------------------------------------------------------
-- Sample Shipments (agent_id = 1 = Super Admin)
-- ------------------------------------------------------------

INSERT INTO `shipments`
  (`tracking_number`, `sender_name`, `sender_phone`, `sender_city_id`,
   `receiver_name`,   `receiver_phone`, `receiver_city_id`,
   `weight`, `courier_type`, `delivery_date`, `amount`, `status`, `agent_id`, `created_at`)
VALUES
  ('SC001KHI2024', 'Ahmed Raza',   '03001231001', 1, 'Bilal Shah',    '03001232001', 2, 2.50, 'standard',  '2026-07-05', 450.00,  'delivered',        1, '2026-06-20 10:00:00'),
  ('SC002LHR2024', 'Nadia Malik',  '03001231002', 2, 'Fatima Zahra',  '03001232002', 3, 1.00, 'express',   '2026-07-03', 650.00,  'in_transit',       1, '2026-06-22 11:30:00'),
  ('SC003ISB2024', 'Tariq Mehmood','03001231003', 3, 'Zara Qureshi',  '03001232003', 1, 5.00, 'overnight', '2026-07-02', 1200.00, 'out_for_delivery', 1, '2026-06-25 09:15:00'),
  ('SC004MUL2024', 'Hassan Ali',   '03001231004', 7, 'Imran Khan',    '03001232004', 4, 3.20, 'standard',  '2026-07-08', 550.00,  'booked',           1, '2026-06-27 14:00:00'),
  ('SC005PEW2024', 'Aisha Noor',   '03001231005', 5, 'Danish Rauf',   '03001232005', 6, 0.80, 'fragile',   '2026-07-04', 800.00,  'booked',           1, '2026-06-28 16:45:00'),
  ('SC006FSD2024', 'Kamran Baig',  '03001231006', 8, 'Sana Mirza',    '03001232006', 2, 4.50, 'standard',  '2026-07-06', 500.00,  'delivered',        1, '2026-06-15 08:00:00'),
  ('SC007HYD2024', 'Rehan Siddiq', '03001231007', 9, 'Mariam Arif',   '03001232007', 1, 2.00, 'express',   '2026-07-07', 700.00,  'in_transit',       1, '2026-06-29 12:00:00'),
  ('SC008SLK2024', 'Shahid Iqbal', '03001231008', 10,'Salman Butt',   '03001232008', 3, 1.50, 'standard',  '2026-07-09', 420.00,  'cancelled',        1, '2026-06-30 10:30:00'),
  ('SC009QTA2024', 'Layla Ahmed',  '03001231009', 6, 'Junaid Jamshed', '03001232009', 7, 6.00, 'overnight', '2026-07-03', 1500.00, 'delivered',       1, '2026-06-18 09:00:00'),
  ('SC010RWP2024', 'Omar Farooq',  '03001231010', 4, 'Hina Baig',     '03001232010', 8, 3.00, 'express',   '2026-07-10', 900.00,  'booked',           1, '2026-07-01 08:00:00');

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- Quick Login Reference:
-- Admin  : admin@gmail.com        / admin123
-- Agent  : agent.karachi@swiftcargo.com  / agent123
-- Agent  : agent.lahore@swiftcargo.com   / agent123
-- Agent  : agent.islamabad@swiftcargo.com/ agent123
-- User   : ali@gmail.com          / user123
-- ============================================================
