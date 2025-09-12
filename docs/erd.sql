-- Buat database
CREATE DATABASE rs_bedah;
USE rs_bedah;

-- Roles
CREATE TABLE roles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE
);

-- Users (dokter, admin, perawat, kasir, farmasi, pasien-login)
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role_id BIGINT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Patients
CREATE TABLE patients (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) UNIQUE,
    nik VARCHAR(20),
    name VARCHAR(100),
    gender ENUM('L','P'),
    birth_date DATE,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Polies (poli/spesialisasi)
CREATE TABLE polies (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

-- Appointments (janji temu)
CREATE TABLE appointments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    patient_id BIGINT,
    poli_id BIGINT,
    doctor_id BIGINT,
    schedule DATETIME,
    status ENUM('waiting','in_progress','done'),
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (poli_id) REFERENCES polies(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id)
);

-- Queues (antrian)
CREATE TABLE queues (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    appointment_id BIGINT,
    nomor INT,
    status ENUM('waiting','called','done'),
    FOREIGN KEY (appointment_id) REFERENCES appointments(id)
);

-- Prescriptions (resep)
CREATE TABLE prescriptions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    appointment_id BIGINT,
    drug_name VARCHAR(100),
    dosage VARCHAR(100),
    FOREIGN KEY (appointment_id) REFERENCES appointments(id)
);

-- Invoices (tagihan)
CREATE TABLE invoices (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    patient_id BIGINT,
    total DECIMAL(12,2),
    method ENUM('BPJS','ASURANSI','MANDIRI'),
    created_at TIMESTAMP NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id)
);

-- Rooms (kamar rawat inap)
CREATE TABLE rooms (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    class ENUM('VIP','1','2','3')
);

-- Admissions (rawat inap)
CREATE TABLE admissions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    patient_id BIGINT,
    room_id BIGINT,
    admission_date DATETIME,
    discharge_date DATETIME,
    status ENUM('active','discharged'),
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);
