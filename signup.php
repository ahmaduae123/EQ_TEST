<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo "<script>alert('Signup successful! Please login.'); window.location.href='login.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Username or email already exists. Try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6b7280, #1e3a8a);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 400px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #1f2937;
            position: relative;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #1e3a8a;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            background: #1e3a8a;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #2563eb;
            transform: scale(1.05);
        }
        .signature {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 150px;
            height: auto;
            opacity: 0.7;
        }
        .login-link {
            margin-top: 15px;
            color: #1e3a8a;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
            .signature {
                width: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://i.imgur.com/9J8lQ8D.jpeg" alt="M Ahmad Signature" class="signature">
        <h2>Sign Up</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php" class="login-link">Already have an account? Login</a>
    </div>
</body>
</html>
