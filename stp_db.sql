CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Active'
);

INSERT INTO admin_users (username, nama_lengkap, password, role, status) VALUES
('admin', 'Admin Utama', MD5('admin123'), 'Super Admin', 'Active'),
('nurhidayah', 'Nurhidayah Sulaeman', MD5('admin123'), 'Manager', 'Active');