-- Fix subscription status column to include 'pending'
-- Run this SQL in phpMyAdmin or cPanel MySQL

ALTER TABLE subscriptions 
MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'pending') 
DEFAULT 'pending';

-- Verify the change
SHOW COLUMNS FROM subscriptions LIKE 'status';
