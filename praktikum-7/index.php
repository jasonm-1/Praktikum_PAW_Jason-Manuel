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
    <style>
        .toast {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 15px 30px;
            border-radius: 15px;
            color: #ef4444; 
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .toast.show { top: 30px; }
    </style>
</head>
<body>
    <div id="errorToast" class="toast">
        <span>⚠️</span> <span id="toastMsg">Username atau Password Salah!</span>
    </div>

    <div class="centered-wrapper">
        <div class="glass-card">
            <h2 style="color: var(--primary); margin-bottom: 5px;">👋 Halo!</h2>
            <p style="margin-bottom: 30px; color: #6b7280; font-size: 14px;">Masuk ke akun Anda</p>
            
            <form id="mainLoginForm" action="login_process.php" method="POST">
                <div class="input-group">
                    <div class="error-tooltip" id="err-username">Isi Username!</div>
                    <input type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="input-group">
                    <div class="error-tooltip" id="err-password">Isi Password!</div>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn" style="width: 100%; padding: 16px; font-size: 15px;">Masuk Sekarang</button>
            </form>

            <p style="margin-top: 25px; font-size: 13px; color: #6b7280;">
                Belum punya akun? <a href="register.php" style="color: var(--primary); font-weight: 600; text-decoration: none;">Daftar di sini</a>
            </p>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const toast = document.getElementById('errorToast');
            toast.classList.add('show');
            setTimeout(() => { toast.classList.remove('show'); }, 3000);
        }

        document.getElementById('mainLoginForm').onsubmit = function(e) {
            let fields = ['username', 'password'];
            let valid = true;
            fields.forEach(f => {
                let el = document.getElementById(f);
                if (!el.value) {
                    document.getElementById('err-' + f).style.display = 'block';
                    el.style.borderColor = 'var(--danger)';
                    valid = false;
                } else {
                    document.getElementById('err-' + f).style.display = 'none';
                    el.style.borderColor = 'rgba(139, 92, 246, 0.1)';
                }
            });
            if (!valid) e.preventDefault();
        };
    </script>
</body>
</html>
