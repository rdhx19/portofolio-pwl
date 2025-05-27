<?php
require_once 'config.php';
requireLogin();

$pdo = getDBConnection();

// Get all users
$stmt = $pdo->query("SELECT id, full_name, username FROM users ORDER BY full_name");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get selected user or default to current user
$selected_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$selected_user_id]);
$current_user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo htmlspecialchars($current_user['full_name']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2><?php echo htmlspecialchars($current_user['full_name']); ?></h2>
            </div>
            <div class="nav-menu" id="nav-menu">
                <div class="user-select">
                    <select onchange="window.location.href='?user_id='+this.value">
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>" <?php echo $user['id'] == $selected_user_id ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($user['full_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <a href="#home" class="nav-link">Home</a>
                <a href="#about" class="nav-link">About</a>
                <a href="logout.php" class="nav-link logout">Logout</a>
            </div>
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="home-section">
        <div class="home-container">
            <div class="home-content">
                <div class="home-text">
                    <h1>Hi, I'm <span class="highlight"><?php echo htmlspecialchars($current_user['full_name']); ?></span></h1>
                    <p class="home-description"><?php echo htmlspecialchars($current_user['bio']); ?></p>
                    <div class="home-buttons">
                        <a href="#about" class="btn btn-secondary">About Me</a>
                    </div>
                </div>
                <div class="home-image">
                    <?php
                    $img_path = "img/" . htmlspecialchars($current_user['photo']);
                    echo "<!-- Path gambar: $img_path -->";
                    ?>
                    <img src="<?php echo $img_path; ?>" alt="<?php echo htmlspecialchars($current_user['full_name']); ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="about-content">
                <div class="about-text">
                    <?php if ($current_user['username'] === 'Arto_Ragil'): ?>
                        <p>Aku seorang seniman—bukan karena gelar, bukan pula karena pameran megah. Aku seniman karena aku hidup lewat warna, bentuk, dan imajinasi yang tak pernah diam di kepalaku. Setiap hari, dunia seperti menggoda untuk dituangkan ke atas kanvas, ke dalam sketsa, atau bahkan sekadar dalam catatan harian yang penuh coretan tinta.</p>
                        <p>Sejak kecil, aku merasa berbeda. Saat anak-anak lain bermain bola, aku sibuk menggambar bentuk wajah di tanah berdebu. Saat remaja lain sibuk menghafal rumus, aku justru tertarik pada bayangan cahaya di dinding kamar. Ibuku dulu sering berkata, "Arto, kamu memang aneh, tapi dunia butuh keanehan itu." Kata-kata itu, anehnya, menjadi semacam bekal hidupku.</p>
                        <p>Karya seni bagiku adalah cara bercerita. Aku tak pandai bicara panjang lebar, tapi beri aku kuas dan warna, dan aku akan bicara lewat garis, tekstur, dan detail yang tak semua mata bisa mengerti. Setiap lukisanku menyimpan perasaan—ada yang lahir dari luka, ada pula yang muncul dari harapan kecil yang kutemukan di sudut kota.</p>
                    <?php elseif ($current_user['username'] === 'samudr44'): ?>
                        <p>Aku pemuda dari tanah Riau, yang menjejakkan kaki di Jakarta sejak usia belia, meninggalkan kampung halaman demi ilmu dan cita, bernaung di pesantren, lalu melanjutkan langkah ke bangku kuliah, tinggal di asrama—tempat rindu, harap, dan perjuangan bertemu.</p>
                        <p>Merantau mengajariku arti menjadi lelaki sejati: mandiri dalam langkah, tangguh dalam badai, menyulam harapan di antara sunyi dan hiruk-pikuk ibu kota. Kuliah kujalani, tapi hidup tak berhenti di ruang kelas semata.</p>
                        <p>Di sela-sela waktu, kutarik gas motor sebagai ojek online, bukan sekadar mencari nafkah, tapi belajar menjadi dewasa dari jalanan, melatih sabar dalam kemacetan, mengasah komunikasi dalam keberagaman, dan menanam tekun di tengah kerasnya realita.</p>
                        <p>Aku percaya, hidup ini seperti memancing: butuh kesabaran menunggu, butuh strategi menempatkan umpan, dan keyakinan bahwa hasil terbaik akan datang… di waktu yang paling tepat.</p>
                    <?php elseif ($current_user['username'] === 'dio'): ?>
                        <p>Namaku Azriel. Aku lahir dan besar di Jakarta Selatan, tempat di mana gedung-gedung menjulang dan suara kendaraan tak pernah berhenti. Sehari-hari aku adalah ojek online—menyusuri jalanan kota, mengantar penumpang, dan mengejar bonus demi sesuap nasi. Tapi saat waktu luang datang, dan dompet mengizinkan, aku mengejar sesuatu yang lebih tinggi: puncak-puncak gunung di pulau Jawa.</p>
                        <p>Bagi sebagian orang, mungkin itu pelarian. Tapi bagiku, mendaki adalah cara untuk kembali mengenal diri. Di balik asap kendaraan dan panas kota, aku menemukan kesejukan dan keheningan di atas awan. Semeru, Sumbing, Lawu, Sindoro, Merbabu—mereka bukan hanya nama gunung, tapi guru kehidupan.</p>
                        <p>Saat mendaki, aku belajar tentang ketangguhan, perencanaan, bertahan dalam dingin, hingga memimpin tim kecil menuju puncak. Skill yang kupelajari di jalanan—seperti membaca situasi cepat, bersabar menghadapi karakter orang yang berbeda—ternyata juga berguna di alam liar. Aku tak punya gelar tinggi, tapi setiap pendakian dan perjalanan jadi bagian dari pendidikanku sendiri.</p>
                        <p>Di kota, aku Azriel si tukang ojek. Di gunung, aku adalah penjelajah. Di antara keduanya, aku adalah manusia yang terus belajar, bertahan, dan berjuang.</p>
                        <p>Ini bukan sekadar portofolio. Ini adalah kisah hidupku. Dan aku masih terus menulisnya, satu langkah demi satu puncak.</p>
                    <?php elseif ($current_user['username'] === 'Saddam_Davi'): ?>
                        <p>Hai saya Saddam, sejak kecil sangat suka dengan olahraga khususnya sepak bola. Seperti mimpi anak kecil yang lainnya, cita-cita saya saat itu ingin menjadi pemain bola. Seiring berjalannya waktu hingga umur sudah menginjak remaja, saya sadar bahwa cita-cita saya itu tidak akan terwujud. Mimpi yang baru kini muncul untuk menjadi Jurnalis Olahraga, saya mempelajari teknik mendetail tentang apa itu sepakbola, sejarah, dan aturan dasar olahraga lainnya untuk mewujudkan mimpi itu.</p>
                        <p>Sebagai jurnalis tentu saja hal yang paling penting adalah memiliki kemampuan menulis yang sangat baik, untuk itu saya berlatih membuat konten sederhana berupa video pendek pada platform youtube. Meskipun saat ini jurusan kuliah saya sangat bertentangan dengan hal-hal yang berkaitan dengan jurnalistik, namun saya yakin suatu saat nanti mimpi baru saya tersebut akan segera tercapai.</p>
                    <?php elseif ($current_user['username'] === 'Faiz'): ?>
                        <p>Hai namaku Faiz, sejak kecil sangat suka bermain game online, sehingga saya berbeda hobi dengan anak lainnnya. Sejak itu saya bermain main warnet untuk main game online pertama kali itu point blank dan lost saga. Seiring berjalannya waktu hingga umur menginjak remaja, saya masuk pesantren dari kelas 1 SMP sampe 2 SMP hingga karena saya tidak betah dengan pergaulan di sana, Saya pindah ke swasta di dekat rumah saya, namun pas saya pindah saya fokus dengan tujuan saya yaitu bermain game online.</p>
                        <p>Sejak itu saya berpikir untuk mendapatkan uang. Sejak saat itu saya fokus untuk mencapai cita cita saya menjadi konten kreator game, sehingga saya melanjutkan cita cita saya, itu membeli sebuah handphone game ya bernama mobile legend.</p>
                        <p>Hingga saya mencapai tujuan yaitu menjadi konten kreator gaming, Saya mulai konten itu sejak tahun 2021, Hingga saya mencoba berbagai cara untuk menambah followers dari konten saya. Akhirnya saya pindah ke sebuah game bernama mobille legends dan saya sangat kanget dengan followers yang sangat banyak dalam waktu bulan mencapai 50k followers. Di situlah saya mulai buat konten tentang mobile legends, Saya yakin suatu saat nanti mimpi saya terwujud menjadi konten kreator gaming yg bisa menghibur followers.</p>
                    <?php elseif (strtolower($current_user['username']) === 'amud'): ?>
                        <p>Di sudut kota yang tak pernah benar-benar tidur, Saya menjalani hari-hari sebagai mahasiswa di salah satu universitas yang ada di jakarta. Pagi hari, saya mengenakan kemeja rapi dan sepatu, menyimak dosen dengan mata yang setengah terjaga, menyusuri lorong kampus sambil menenteng tas berisi buku dan pena. Di dalam tas itu juga terselip jaket driver, yang akan saya kenakan begitu jam kuliah terakhir usai, sorenya saya duduk di tempat duduk motor dan menyalakan motor lalu menyusuri jalanan sebagai driver transportasi online, terkadang saya sering kali harus memilih antara tugas kuliah atau tambahan orderan.</p>
                        <p>Tapi saya belajar mengelola waktu, meski itu berarti saya tidur hanya tiga jam semalam. Saya tak pernah merasa rendah bekerja sebagai driver. Bagi saya, setiap kilometer adalah langkah menuju mimpi, saya percaya ilmu tak hanya didapat di ruang kuliah. Jalanan pun bisa menjadi guru, selama kita masih mau belajar.</p>
                        <p>Saya menjadi seorang driver bukan sekedar pengisi waktu atau pelarian dari kesulitan ekonomi. Bagi saya, hidup adalah kombinasi antara teori dan kenyataan. Di ruang kelas, saya mempelajari algoritma pelajaran. Di jalan, saya mempelajari algoritma kehidupan. Bagi saya, menjadi driver adalah jendela lain menuju dunia nyata, saya mendengar berbagai cerita dari beberapa customer, pegawai kantor yang lelah karena pekerjaan, ibu rumah tangga yang cemas menjemput anak, bahkan mahasiswa lain yang sedang patah hati.</p>
                        <p>Dari tempat duduk motor, saya belajar empati, komunikasi, pengendalian diri saat tertahan macet atau mendapat customer rewel dan cara bertahan di tengah arus keras kehidupan. Pernah di siang hari, saat gerimis tipis membasahi aspal, saya mendapat orderan dari ibu hamil yang hendak kontrol ke bidan, saya membawa motor dengan hati-hati, tidak peduli jika rating saya turun karena berkendara dengan lambat. Diakhir perjalanan, ibu itu hanya berkata pelan, "Terimakasih Mas". Kata sederhana yang menghangatkan hati lebih dari uang tip.</p>
                        <p>Dan pada malam itu, di tengah lampu kota yang samar, saya menyalakan mesin motor lagi melanjutkan perjalanan, setiap kilometer yang saya tempuh bukan sekedar angka. Tapi langkah-langkah Menuju impian. Saya percaya, gelar sarjana bisa diraih oleh siapa saja, tapi yang menjadi seseorang tangguh, adalah perjalanan yang ia lalui sendiri. Dan di tengah perjalanan saat notifikasi orderan kembali berbunyi, saya menarik nafas panjang, lalu gas pelan-pelan. Mendapat Satu penumpang lagi dan satu pelajaran lagi.</p>
                    <?php elseif ($current_user['username'] === 'ipan'): ?>
                        <p>Nama saya Irvan. Sejak kecil, saya selalu tertarik pada suara—dari dentingan sendok di gelas hingga bunyi hujan di atap seng. Tapi baru saat saya mengenal alat musik, semuanya terasa seperti pulang ke rumah.</p>
                        <p>Saya mulai belajar musik secara otodidak saat duduk di bangku SMP. Tidak ada guru, tidak ada les, hanya saya, keyboard bekas, dan koneksi internet seadanya. Saya belajar dari video tutorial, mendengarkan lagu, dan mencoba memainkannya kembali, nada demi nada. Awalnya banyak salah, tapi saya tidak berhenti. Setiap kesalahan adalah bagian dari proses.</p>
                        <p>Musik bukan sekadar hobi. Bagi saya, ia adalah cara untuk memahami diri sendiri dan dunia. Ketika saya sedih, saya menulis melodi. Ketika saya gembira, saya menciptakan irama. Musik menjadi bahasa kedua saya—bahasa yang jujur dan penuh perasaan.</p>
                        <p>Kini, saya mulai mencoba membuat komposisi sendiri.</p>
                    <?php elseif ($current_user['username'] === 'rdhohkim_'): ?>
                        <p>Di pagi yang mendung, saya melangkah masuk ke kantor cabang baru PT Sumber Teknologi. Tas hitam di punggung saya berisi kabel, tang crimping, tester, dan sedikit kesabaran yang sudah mulai menipis sejak proyek ini dimulai.</p>
                        <p>"Mas Ridho! Maaf banget ya, ini masih berantakan. Internet belum nyambung, kerjaan numpuk, semua orang stres," sapa Bu Dini, supervisor HR dengan wajah lelah. Saya tersenyum tipis. "Tenang, Bu. Yang penting kabelnya belum dimakan tikus."</p>
                        <p>Tanpa basa-basi, saya langsung menuruni ruang server kecil di pojok ruangan. Meja penuh debu, colokan listrik berantakan, dan kabel UTP melilit seperti mi goreng yang belum diaduk. Saya menghela napas panjang. "Switch-nya belum hidup, router cuma kelap-kelip merah, dan kabel ini…" —saya menarik satu kabel— "...kayaknya nyambung ke AC, bukan ke modem."</p>
                        <p>Saya mulai bekerja: menyusun ulang jalur kabel, mencetak RJ45 baru, dan menyalakan switch 24-port yang dari tadi hanya menjadi pajangan. Satu per satu, titik akses mulai terdeteksi. Tapi ketika saya pikir semuanya lancar, satu komputer tetap tidak bisa terhubung.</p>
                        <p>"Ini kayaknya komputer akuntansi, ya?" tanya saya. "Iya," jawab Dimas, staf keuangan. "Yang penting itu. Semua data keuangan di situ." Saya langsung cek port. Ternyata soketnya longgar, dan konektor sebelumnya dikerjakan asal-asalan. Saya mencopot, memotong ulang, dan membuat crimping ulang. Kali ini, sinyal langsung naik.</p>
                        <p>Menjelang sore, seluruh ruangan sudah bisa mengakses internet. Printer terdeteksi, sistem kasir online menyala, dan grup WhatsApp kantor mulai ramai dengan ucapan syukur. Sebelum pulang, saya mencatat semua IP statis dan memberi daftar troubleshooting sederhana ke staf.</p>
                        <p>Hari itu, saya bukan hanya menghubungkan jaringan. Saya menyambungkan produktivitas, semangat kerja, dan secuil harapan bagi kantor yang sempat lumpuh digital. Di balik layar, saya adalah sang penjaga sinyal: Ridho Hakim, si IT Support andalan.</p>
                    <?php else: ?>
                        <p><?php echo htmlspecialchars($current_user['bio']); ?></p>
                    <?php endif; ?>
                    
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($current_user['email']); ?></span>
                        </div>
                        <?php if (!empty($current_user['phone'])): ?>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($current_user['phone']); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($current_user['location'])): ?>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($current_user['location']); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="skills-section">
                    <h3>Skills</h3>
                    <div class="skills-list">
                        <?php 
                        if (!empty($current_user['skills'])) {
                            $skills = explode(', ', $current_user['skills']);
                            foreach ($skills as $skill): 
                        ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php 
                            endforeach;
                        } else {
                            echo '<p>No skills listed yet.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 <?php echo htmlspecialchars($current_user['full_name']); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>