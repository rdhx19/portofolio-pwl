-- Hapus database jika ada
DROP DATABASE IF EXISTS portfolio_db;

-- Buat database baru
CREATE DATABASE portfolio_db;
USE portfolio_db;

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    photo VARCHAR(255) DEFAULT 'default.jpg',
    bio TEXT,
    skills TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel portfolio items
CREATE TABLE portfolio_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    project_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert users satu per satu untuk menghindari error
INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('john_doe', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'John Doe', 'john@example.com', 'img/john.jpg', 'Full Stack Developer dengan pengalaman 5 tahun', 'PHP, JavaScript, React, Node.js');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('Arto_Ragil', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Arto Putra', 'artoagil14@gmail.com', 'arto.jpg', 'Full Stack Developer dengan pengalaman 5 tahun', 'Desain, UI/UX, Frontend, Backend');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('jane_smith', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Jane Smith', 'jane@example.com', 'jane.jpg', 'UI/UX Designer yang passionate tentang user experience', 'Figma, Adobe XD, Photoshop, Sketch');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('mike_wilson', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Mike Wilson', 'mike@example.com', 'mike.jpg', 'Backend Developer specializing in database optimization', 'Python, Django, PostgreSQL, MongoDB');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('sarah_johnson', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Sarah Johnson', 'sarah@example.com', 'sarah.jpg', 'Frontend Developer dengan fokus pada responsive design', 'HTML, CSS, JavaScript, Vue.js');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('david_brown', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'David Brown', 'david@example.com', 'david.jpg', 'Mobile App Developer untuk iOS dan Android', 'Swift, Kotlin, React Native, Flutter');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('lisa_garcia', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Lisa Garcia', 'lisa@example.com', 'lisa.jpg', 'Data Scientist dengan background machine learning', 'Python, R, TensorFlow, Pandas');

INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES
('alex_martinez', '$2y$10$K8J5/6rKjW0XNrwzAEUeseOJ5KQxB7zTWCHr8XzqyeDbRKM5kGOxi', 'Alex Martinez', 'alex@example.com', 'alex.jpg', 'DevOps Engineer dengan expertise di cloud computing', 'AWS, Docker, Kubernetes, Jenkins');

-- Insert portfolio items satu per satu
INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(1, 'E-Commerce Website', 'Website toko online dengan fitur pembayaran lengkap', 'project1.jpg', 'https://github.com/johndoe/ecommerce');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(1, 'Task Management App', 'Aplikasi manajemen tugas berbasis web', 'project2.jpg', 'https://github.com/johndoe/taskapp');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(2, 'Mobile Banking UI', 'Desain interface untuk aplikasi mobile banking', 'design1.jpg', 'https://dribbble.com/janesmith');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(2, 'Restaurant Website Design', 'Desain website untuk restaurant chain', 'design2.jpg', 'https://behance.net/janesmith');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(3, 'API Gateway System', 'Sistem gateway untuk microservices architecture', 'backend1.jpg', 'https://github.com/mikewilson/api-gateway');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(4, 'Portfolio Website', 'Website portfolio responsive dengan animasi modern', 'frontend1.jpg', 'https://github.com/sarahjohnson/portfolio');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(5, 'Fitness Tracking App', 'Aplikasi mobile untuk tracking aktivitas fitness', 'mobile1.jpg', 'https://github.com/davidbrown/fitness-app');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(6, 'Sales Prediction Model', 'Model machine learning untuk prediksi penjualan', 'data1.jpg', 'https://github.com/lisagarcia/sales-prediction');

INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES
(7, 'CI/CD Pipeline Setup', 'Setup automated deployment pipeline', 'devops1.jpg', 'https://github.com/alexmartinez/cicd-pipeline');

-- Verifikasi data
SELECT 'Users created:' as Info, COUNT(*) as Count FROM users;
SELECT 'Portfolio items created:' as Info, COUNT(*) as Count FROM portfolio_items;

-- Password untuk semua user: password123

UPDATE users SET photo = 'img/john.jpg' WHERE username = 'john_doe';