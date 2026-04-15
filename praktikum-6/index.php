<?php
session_start();
if (isset($_SESSION['role'])) { header("Location: page_c.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Studio Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card">
            <h2 style="color: var(--primary); margin-bottom: 5px;">👋 Halo!</h2>
            <p style="margin-bottom: 30px; color: #6b7280; font-size: 14px;">Pilih akses untuk melanjutkan</p>
            
            <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin-bottom: 25px;">
                <button class="btn" onclick="setRole('admin')">Admin</button>
                <button class="btn" onclick="setRole('member')">Member</button>
                <button class="btn" onclick="setRole('public')">Public</button>
                <button class="btn btn-danger" onclick="window.location.href='page_c.php'">Guest</button>
            </div>

            <div id="loginFormArea" style="display:none; margin-top: 20px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 30px; animation: fadeIn 0.4s ease-out;">
                <h4 id="displayRole" style="margin-bottom: 20px; color: var(--primary); font-weight: 600;">🔑 LOGIN</h4>
                
                <form id="mainLoginForm" action="login_process.php" method="POST">
                    <input type="hidden" name="role" id="inputRole">
                    
                    <div class="input-group">
                        <div class="error-tooltip" id="err-username">Isi Username!</div>
                        <input type="text" name="username" id="username" placeholder="Masukkan Username Anda">
                    </div>
                    
                    <div class="input-group">
                        <div class="error-tooltip" id="err-password">Isi Password!</div>
                        <input type="password" name="password" id="password" placeholder="Masukkan Password Anda">
                    </div>
                    
                    <button type="submit" class="btn" style="width: 100%; padding: 16px; font-size: 15px; margin-top: 10px;">Masuk Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setRole(role) {
            document.getElementById('loginFormArea').style.display = 'block';
            document.getElementById('displayRole').innerText = '🔑 LOGIN SEBAGAI ' + role.toUpperCase();
            document.getElementById('inputRole').value = role;
        }

        document.getElementById('mainLoginForm').onsubmit = function(e) {
            let fields = ['username', 'password'];
            let valid = true;
            fields.forEach(f => {
                let el = document.getElementById(f);
                let err = document.getElementById('err-' + f);
                if (!el.value) {
                    err.style.display = 'block';
                    el.style.borderColor = 'var(--danger)'; // Tetap pakai warna pastel danger
                    valid = false;
                } else {
                    err.style.display = 'none';
                    el.style.borderColor = 'rgba(139, 92, 246, 0.1)';
                }
            });
            if (!valid) e.preventDefault();
        };
    </script>
</body>
</html>
