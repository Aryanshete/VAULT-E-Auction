<?php
session_start();
include_once "config/database.php";

if ($_POST) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: index.php");
    } else {
        $error_message = "Invalid Login";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VAULT – Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; }

body {
  margin: 0;
  min-height: 100vh;
  font-family: 'Inter', sans-serif;
  background: linear-gradient(120deg, #2b1d0f, #7a5524, #3a2a15);
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

/* Background text */
.bg-text {
  position: absolute;
  font-family: 'Playfair Display', serif;
  font-size: clamp(120px, 26vw, 360px);
  color: rgba(255,255,255,0.05);
  letter-spacing: 40px;
  animation: float 10s ease-in-out infinite;
  user-select: none;
}

@keyframes float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

/* Login card */
.login-container {
  width: 400px;
  padding: 42px;
  border-radius: 20px;
  background: rgba(255,255,255,0.18);
  backdrop-filter: blur(18px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.45);
  z-index: 1;
  transition: box-shadow 0.3s ease;
}

.login-container.success {
  box-shadow: 0 0 40px rgba(212,175,55,0.8);
}

.login-container h2 {
  font-family: 'Playfair Display', serif;
  color: #fff;
  text-align: center;
  margin-bottom: 28px;
}

/* Floating inputs */
.field {
  position: relative;
  margin-bottom: 22px;
}

.field input {
  width: 100%;
  padding: 14px 14px;
  border-radius: 10px;
  border: none;
  outline: none;
  background: rgba(255,255,255,0.9);
  font-size: 15px;
}

.field label {
  position: absolute;
  top: 50%;
  left: 14px;
  transform: translateY(-50%);
  color: #777;
  font-size: 14px;
  pointer-events: none;
  transition: 0.25s;
}

.field input:focus + label,
.field input:not(:placeholder-shown) + label {
  top: -8px;
  background: #fff;
  padding: 0 6px;
  font-size: 12px;
  border-radius: 6px;
}

/* Password toggle */
.toggle {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 14px;
  color: #555;
}

/* Button */
button {
  width: 100%;
  padding: 14px;
  border-radius: 10px;
  border: none;
  background: linear-gradient(135deg, #d4af37, #9f7a1f);
  color: #2b1d0f;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

button.loading {
  pointer-events: none;
  opacity: 0.8;
}

button:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.35);
}

/* Loader */
.spinner {
  display: none;
  margin: 10px auto 0;
  width: 22px;
  height: 22px;
  border: 3px solid rgba(255,255,255,0.4);
  border-top: 3px solid #fff;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Error */
.error {
  background: rgba(255,0,0,0.25);
  color: #fff;
  padding: 8px;
  border-radius: 8px;
  margin-bottom: 15px;
  text-align: center;
}

/* Footer */
.footer {
  position: absolute;
  bottom: 16px;
  color: rgba(255,255,255,0.75);
  font-size: 13px;
}

.footer a {
  color: #d4af37;
  text-decoration: none;
}
</style>
</head>

<body>

<div class="bg-text">VAULT</div>

<div class="login-container" id="loginBox">
  <h2>VAULT LOGIN</h2>

  <?php if (!empty($error_message)) : ?>
    <div class="error"><?= $error_message ?></div>
  <?php endif; ?>

  <form action="login.php" method="post" id="loginForm">
    <div class="field">
      <input type="text" name="username" required placeholder=" ">
      <label>Username</label>
    </div>

    <div class="field">
      <input type="password" name="password" id="password" required placeholder=" ">
      <label>Password</label>
      <span class="toggle" onclick="togglePassword()">👁️</span>
    </div>

    <button type="submit" id="loginBtn">Login</button>
    <div class="spinner" id="spinner"></div>
  </form>
</div>

<div class="footer">
  To get access contact:
  <a href="mailto:vault49812@gmail.com">vault49812@gmail.com</a>
</div>

<script>
function togglePassword() {
  const pwd = document.getElementById("password");
  pwd.type = pwd.type === "password" ? "text" : "password";
}

const form = document.getElementById("loginForm");
const btn = document.getElementById("loginBtn");
const spinner = document.getElementById("spinner");
const box = document.getElementById("loginBox");

form.addEventListener("submit", function (e) {
  e.preventDefault(); // ⛔ stop instant submit

  btn.classList.add("loading");
  spinner.style.display = "block";
  box.classList.add("success");

  
  setTimeout(() => {
    form.submit(); // 
  }, 600);
});
</script>


</body>
</html>


