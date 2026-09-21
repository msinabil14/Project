-- Run this in phpMyAdmin (SQL tab) if the student_db / students table doesn't exist yet.

CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS students (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    registration VARCHAR(50) NOT NULL,
    roll VARCHAR(30) NOT NULL,
    session VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
