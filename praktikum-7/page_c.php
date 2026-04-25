<?php
include 'auth.php';
$role = $_SESSION['role'] ?? 'guest';
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Studio Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <span>Halo, <strong><?php echo htmlspecialchars($username); ?></strong> (<?php echo strtoupper($role); ?>)</span>
        <div style="display: flex; gap: 10px;">
            <a href="page_c.php" class="btn">Home</a>
            <a href="javascript:void(0)" onclick="checkMembership()" class="btn">Exclusive Area</a>
            <a href="profile.php" class="btn" style="background: #6366f1;">Edit Profil</a>
            <?php if($role == 'admin'): ?>
                <a href="page_a.php" class="btn">Admin Panel</a>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="centered-wrapper">
        <div class="glass-card" style="max-width: 700px;">
            <h1 style="color: var(--primary);">📰 Kabar Terbaru Studio</h1>
            <div style="background: rgba(255,255,255,0.4); padding: 25px; border-radius: 20px; margin-top: 20px; text-align: left;">
                <h3 style="color: var(--primary);">Project X Segera Rilis!</h3>
                <p>Selamat datang di dashboard interaktif kami. Sekarang data Anda tersimpan aman di database.</p>
            </div>
        </div>
    </div>

    <div id="modalOverlay" class="modal-overlay"></div>
    <div id="customModal" class="custom-modal">
        <h3 id="mTitle"></h3>
        <p id="mBody"></p>
        <button class="btn" onclick="closeModal()">Tutup</button>
    </div>

    <script>
        function showModal(title, body) {
            document.getElementById('mTitle').innerText = title;
            document.getElementById('mBody').innerText = body;
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('customModal').classList.add('active');
        }
        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('customModal').classList.remove('active');
        }
        function checkMembership() {
            let role = "<?php echo $role; ?>";
            if (role === 'guest') showModal("Akses Ditolak", "Silakan login dulu.");
            else if (role === 'public') showModal("Oopss", "Hanya Member yang boleh masuk sini!");
            else window.location.href = 'page_b.php';
        }
    </script>
</body>
</html>
