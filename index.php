<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Color Prediction Game (AJAX)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align:center;
            background-color:#f8f8f8;
            padding:20px;
        }
        .color-btn {
            padding:15px 25px;
            margin:10px;
            font-size:18px;
            border:none;
            cursor:pointer;
            color:white;
            border-radius:5px;
        }
        .Red { background:red; }
        .Green { background:green; }
        .Blue { background:blue; }
        .Yellow { background:gold; color:black; }
        .Orange { background:orange; }
        .Purple { background:purple; }
        .score-box {
            background:white;
            padding:15px;
            margin:15px auto;
            border-radius:5px;
            max-width:400px;
            box-shadow:0 2px 6px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<h1>🎯 Color Prediction Game</h1>

<div class="score-box">
    <p><b>Round:</b> <span id="round">0</span></p>
    <p><b>Score:</b> <span id="score">0</span></p>
    <p id="message">Make your prediction!</p>
</div>

<div id="buttons"></div>

<button onclick="resetGame()">🔄 Reset Game</button>

<script>
const colors = ["Red", "Green", "Blue", "Yellow", "Orange", "Purple"];

// Create color buttons
const btnContainer = document.getElementById('buttons');
colors.forEach(color => {
    const btn = document.createElement('button');
    btn.textContent = color;
    btn.className = `color-btn ${color}`;
    btn.onclick = () => makePrediction(color);
    btnContainer.appendChild(btn);
});

function makePrediction(color) {
    fetch("game.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "prediction=" + encodeURIComponent(color)
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('round').textContent = data.round;
        document.getElementById('score').textContent = data.score;
        document.getElementById('message').innerHTML = data.message;
    });
}

function resetGame() {
    fetch("reset.php")
    .then(() => {
        document.getElementById('round').textContent = 0;
        document.getElementById('score').textContent = 0;
        document.getElementById('message').textContent = "Make your prediction!";
    });
}
</script>

</body>
</html>