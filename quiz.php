<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['session_id'])) {
    header("Location: index.php");
    exit();
}

$question_id = isset($_GET['q']) ? (int)$_GET['q'] : 1;
$stmt = $pdo->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->execute([$question_id]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$question) {
    header("Location: results.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_option = $_POST['answer'];
    $score = $question["score_$selected_option"];
    
    $stmt = $pdo->prepare("INSERT INTO user_responses (session_id, question_id, selected_option, score) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['session_id'], $question_id, $selected_option, $score]);
    
    echo "<script>window.location.href='quiz.php?q=" . ($question_id + 1) . "';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Question <?php echo $question_id; ?></title>
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
        .quiz-container {
            max-width: 700px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #1f2937;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #1e3a8a;
        }
        .question {
            font-size: 1.3em;
            margin-bottom: 20px;
        }
        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .option {
            padding: 15px;
            background: #f3f4f6;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .option:hover {
            background: #e5e7eb;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        .submit-btn {
            background: #1e3a8a;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.2em;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.3s, background 0.3s;
        }
        .submit-btn:hover {
            background: #2563eb;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .quiz-container {
                margin: 20px;
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
            .question {
                font-size: 1.1em;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h2>Question <?php echo $question_id; ?></h2>
        <form method="POST">
            <div class="question"><?php echo htmlspecialchars($question['question_text']); ?></div>
            <div class="options">
                <label class="option"><input type="radio" name="answer" value="a" required> <?php echo htmlspecialchars($question['option_a']); ?></label>
                <label class="option"><input type="radio" name="answer" value="b" required> <?php echo htmlspecialchars($question['option_b']); ?></label>
                <label class="option"><input type="radio" name="answer" value="c" required> <?php echo htmlspecialchars($question['option_c']); ?></label>
                <label class="option"><input type="radio" name="answer" value="d" required> <?php echo htmlspecialchars($question['option_d']); ?></label>
            </div>
            <button type="submit" class="submit-btn">Next</button>
        </form>
    </div>
</body>
</html>
