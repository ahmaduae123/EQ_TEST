<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['session_id'])) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT SUM(score) as total_score FROM user_responses WHERE session_id = ?");
$stmt->execute([$_SESSION['session_id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_score = $result['total_score'] ?? 0;

$max_score = 20; // 5 questions, max 4 points each
$percentage = ($total_score / $max_score) * 100;

if ($percentage >= 80) {
    $feedback = "Excellent! You have a high level of emotional intelligence, with strong self-awareness, empathy, and emotional regulation.";
} elseif ($percentage >= 60) {
    $feedback = "Good job! You show solid emotional intelligence but could improve in some areas like empathy or stress management.";
} else {
    $feedback = "You may benefit from working on your emotional intelligence. Focus on self-awareness and understanding others' emotions.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test Results</title>
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
        .results-container {
            max-width: 700px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #1f2937;
        }
        h2 {
            font-size: 2em;
            color: #1e3a8a;
            margin-bottom: 20px;
        }
        .score {
            font-size: 3em;
            color: #2563eb;
            margin: 20px 0;
        }
        .feedback {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            background: #1e3a8a;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.2em;
            cursor: pointer;
            margin: 10px;
            transition: transform 0.3s, background 0.3s;
        }
        .btn:hover {
            background: #2563eb;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .results-container {
                margin: 20px;
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
            .score {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h2>Your EQ Test Results</h2>
        <div class="score"><?php echo round($percentage); ?>%</div>
        <div class="feedback"><?php echo htmlspecialchars($feedback); ?></div>
        <button class="btn" onclick="window.location.href='index.php'">Retake Test</button>
        <button class="btn" onclick="alert('Share your score: <?php echo round($percentage); ?>%')">Share Results</button>
    </div>
</body>
</html>
