<?php
session_start();

$colors = ["Red", "Green", "Blue", "Yellow", "Orange", "Purple"];

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['round'] = 0;
}

if (isset($_POST['prediction'])) {
    $_SESSION['round']++;
    $prediction = $_POST['prediction'];
    $computerChoice = $colors[array_rand($colors)];

    if ($prediction === $computerChoice) {
        $_SESSION['score'] += 10;
        $message = "<span style='color:green;'>✅ Correct! You earned 10 points.</span>";
    } else {
        $message = "<span style='color:red;'>❌ Wrong! Computer chose <b>$computerChoice</b>.</span>";
    }

    echo json_encode([
        "round" => $_SESSION['round'],
        "score" => $_SESSION['score'],
        "message" => $message
    ]);
}