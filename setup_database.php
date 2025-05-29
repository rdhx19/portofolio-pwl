<?php
echo "<h2>🚀 Portfolio Database Setup</h2>";

// Database configuration
$host = 'db.ycikzujwkgrwaajhgeqq.supabase.co';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '4cgk6xRmQ5H9YLfJ';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Connected to Supabase PostgreSQL<br>";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
    echo "✅ Portfolio items table created<br>";
    
    // Insert users
    $users = [
        ['rdhohkim_', 'Muhammad Ridho Hakim', 'mridhohakim66@gmail.com', 'idoy.jpg', 'IT support membantu instalasi jaringan', 'Ubuntu NodeJS Python'],
        ['samudr44', 'Achmad Samudra Alfatihah', 'alfasamudra7494@gmail.com', 'alfa.jpg', 'Kenek kuli yang Mengoperasikan molen/mesin adukan semen', 'Ngecor, Ngecat, mlaster'],
        ['Arto_Ragil', 'Arto Ragil', 'arto14@gmail.com', 'arts.jpg', 'seorang seniman dan pencinta keindahan yang hidup bebas dan mandiri, tak dikendalikan oleh siapa pun.', 'Menggambar (manual atau digital)', 'Melukis (cat minyak, akrilik, cat air, dll.)'],
        ['Saddam_Davi', 'Saddam Davi', 'madas54@gmail.com', 'sddm.jpg', 'translator yang suka belajar bahasa asing.', 'bahasa arab, latin, mandarin'],
        ['Faiz', 'Faiz_Arko', 'faizarkogaming@gmail.com', 'Faiz.jpg','Konten kreator gaming dengan keahlian dalam editing video, serta mahir menggunakan Microsoft Word dan Excel untuk kebutuhan dokumen dan analisis data.', 'Konten kreator gaming, microsoft word, Microsoft excel'],
        ['dio', 'Azriel Widioko Deswanto', 'Widiokodio04@gmail.com','dio.jpg','Seorang traveler dengan kemampuan manajemen keuangan yang baik, menjunjung tinggi etika profesional, serta memiliki keterampilan negosiasi yang efektif dalam berbagai situasi.', 'Traveler, Manage Keuangan, Beretika, Bernegosiasi'],
        ['ipan', 'Irvan Firmansyah', 'irvanfirmansyah335@gmail.com', 'ipan.jpg', 'orang yang senang belajar musik (musisi pemula) ', 'gitar, drum, nyanyi'],
        ['Amud','Mahmud','mahmudg561@gmail.com','amud.jpg','Setiap hari dimulai dengan niat bangun produktif… tapi begitu buka mata, cuma bisa bilang: "Hadehhh… apa-apaan ini?" Akhirnya, pilihan paling logis: tidur lagi. Hidup kadang keras, jadi kasur adalah solusi.','bangun tidur, Hadehhhh apa-apaan ini, tidur lagi']
    ];
    
    $password_hash = password_hash('password123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, full_name, email, photo, bio, skills) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($users as $user) {
        $stmt->execute([$user[0], $password_hash, $user[1], $user[2], $user[3], $user[4], $user[5]]);
        echo "✅ User '{$user[1]}' created<br>";
    }
    
    // Insert portfolio items
    $portfolio_items = [
        [1, 'E-Commerce Website', 'Website toko online dengan fitur pembayaran lengkap', 'project1.jpg', 'https://github.com/johndoe/ecommerce'],
        [1, 'Task Management App', 'Aplikasi manajemen tugas berbasis web', 'project2.jpg', 'https://github.com/johndoe/taskapp'],
        [2, 'Mobile Banking UI', 'Desain interface untuk aplikasi mobile banking', 'design1.jpg', 'https://dribbble.com/janesmith'],
        [2, 'Restaurant Website Design', 'Desain website untuk restaurant chain', 'design2.jpg', 'https://behance.net/janesmith'],
        [3, 'API Gateway System', 'Sistem gateway untuk microservices architecture', 'backend1.jpg', 'https://github.com/mikewilson/api-gateway'],
        [4, 'Portfolio Website', 'Website portfolio responsive dengan animasi modern', 'frontend1.jpg', 'https://github.com/sarahjohnson/portfolio'],
        [5, 'Fitness Tracking App', 'Aplikasi mobile untuk tracking aktivitas fitness', 'mobile1.jpg', 'https://github.com/davidbrown/fitness-app'],
        [6, 'Sales Prediction Model', 'Model machine learning untuk prediksi penjualan', 'data1.jpg', 'https://github.com/lisagarcia/sales-prediction'],
        [7, 'CI/CD Pipeline Setup', 'Setup automated deployment pipeline', 'devops1.jpg', 'https://github.com/alexmartinez/cicd-pipeline']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO portfolio_items (user_id, title, description, image, project_url) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($portfolio_items as $item) {
        $stmt->execute($item);
        echo "✅ Portfolio item '{$item[1]}' created<br>";
    }
    
    // Verify data
    $user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $portfolio_count = $pdo->query("SELECT COUNT(*) FROM portfolio_items")->fetchColumn();
    
    echo "<br><h3>🎉 Setup Complete!</h3>";
    echo "👥 Total users: $user_count<br>";
    echo "📁 Total portfolio items: $portfolio_count<br>";
    
    echo "<br><h3>🔐 Login Information:</h3>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Username</th><th>Password</th><th>Full Name</th></tr>";
    
    $users_data = $pdo->query("SELECT username, full_name FROM users")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users_data as $user) {
        echo "<tr><td><strong>{$user['username']}</strong></td><td>password123</td><td>{$user['full_name']}</td></tr>";
    }
    echo "</table>";
    
    echo "<br><p><a href='login.php' style='background:#007bff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Go to Login Page</a></p>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
    echo "<br><h3>�� Troubleshooting:</h3>";
    echo "1. Pastikan XAMPP/WAMP sudah berjalan<br>";
    echo "2. Pastikan MySQL service aktif<br>";
    echo "3. Cek username/password MySQL di script ini<br>";
    echo "4. Pastikan tidak ada database 'portfolio_db' yang sedang digunakan<br>";
}
?>
