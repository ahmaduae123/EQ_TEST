<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$_SESSION['session_id'] = uniqid();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emotional Intelligence Test</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6b7280, #1e3a8a);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #1f2937;
            position: relative;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #1e3a8a;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .start-btn {
            background: #1e3a8a;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.2em;
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }
        .start-btn:hover {
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
        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
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
        <h1>Emotional Intelligence (EQ) Test</h1>
        <p>
            Discover your Emotional Intelligence with our interactive EQ Test! Emotional Intelligence is the ability to understand and manage your emotions, as well as empathize with others. This test assesses your self-awareness, empathy, and emotional regulation skills to provide personalized feedback.
        </p>
        <button class="start-btn" onclick="window.location.href='quiz.php'">Start Test</button>
    </div>
</body>
</html>
