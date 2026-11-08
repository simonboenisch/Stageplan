<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: loggingIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strom Umrechner</title>
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
}

body {
    background-color: #ffffff;
    color: #333333;
}

/* Custom Shadow aus dem Style-Block */
.shaddowOwn {
    box-shadow: 4px 4px 16px 0px rgba(0, 0, 0, 0.53);
}

/* Header */
.header {
    background-color: #cbd5e1; /* slate-300 */
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-left: 20px;
    padding-right: 20px;
}

.title {
    font-size: 1.875rem; /* text-3xl */
    font-weight: bold;
}

.subtitle {
    font-size: 1rem;
}

.btn-back {
    background-color: #94a3b8; /* slate-400 */
    padding: 8px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: #000000;
}

/* Rechner Container */
.converter-card {
    background-color: #f1f5f9; /* slate-100 */
    padding: 20px;
    margin: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.input-group {
    display: flex;
    align-items: center;
    justify-content: center;
}

.input-wrapper {
    display: flex;
    align-items: center;
}

.num-input {
    width: 80px; /* w-20 */
    padding: 4px;
}

.unit-select {
    padding: 4px;
}

.arrow {
    margin-left: 16px;
    margin-right: 16px;
    font-size: 1.5rem; /* text-2xl */
}

.target-select {
    margin: 8px;
    background-color: #e2e8f0; /* slate-200 */
    border-radius: 4px;
    height: 40px;
    border: 1px solid #ccc;
}

.btn-calc {
    margin: 8px;
    background-color: #e2e8f0; /* slate-200 */
    border-radius: 4px;
    height: 40px;
    border: none;
    cursor: pointer;
}

.btn-calc:hover {
    background-color: #cbd5e1;
}

.output-wrapper {
    display: flex;
    justify-content: center;
}

.calc-output {
    font-size: 1.5rem; /* text-2xl */
    margin-top: 40px;
}
    </style>
</head>

<body>
    <header class="header">
        <div>
            <p class="title">Stageplan</p>
            <p class="subtitle">Strom Umrechner</p>
        </div>
        <a class="btn-back" href="navigation.php">Zurück</a>
    </header>
    <main>
        <div class="converter-card">
            <div class="input-group">
                <div class="input-wrapper">
                    <input type="number" id="in1" class="num-input">
                    <select id="sel1" class="unit-select">
                        <option value="Volt">Volt</option>
                        <option value="Ampere">Ampere</option>
                        <option value="Watt">Watt</option>
                    </select>
                </div>
                <p class="arrow">→</p>
                <div class="input-wrapper">
                    <input type="number" id="in2" class="num-input">
                    <select id="sel2" class="unit-select">
                        <option value="Volt">Volt</option>
                        <option value="Ampere">Ampere</option>
                        <option value="Watt">Watt</option>
                    </select>
                </div>
            </div>
            
            <select id="sel3" class="target-select shaddowOwn">
                <option value="Volt">Volt</option>
                <option value="Ampere">Ampere</option>
                <option value="Watt">Watt</option>
            </select>
            
            <button class="btn-calc" onclick="calc()">Calculate</button>
            
            <div class="output-wrapper">
                <p id="calcOut" class="calc-output"></p>
            </div>
        </div>
    </main>

    <script>
        function calc() {
            const number1 = Number(document.getElementById("in1").value);
            const number2 = Number(document.getElementById("in2").value);

            const from = document.getElementById("sel1").value;
            const from2 = document.getElementById("sel2").value;
            const to = document.getElementById("sel3").value;

            const calcOut = document.getElementById("calcOut");

            // Watt
            if (to == "Watt") {
                if ((from == "Volt" && from2 == "Ampere") || (from2 == "Volt" && from == "Ampere")) {
                    calcOut.innerHTML = number1 * number2 + " Watt";
                }
            }

            // Volt
            if (to == "Volt") {
                if (from == "Watt" && from2 == "Ampere") {
                    calcOut.innerHTML = number1 / number2 + " Volt";
                }
                if (from2 == "Watt" && from == "Ampere") {
                    calcOut.innerHTML = number2 / number1 + " Volt";
                }
            }

            // Ampere
            if (to == "Ampere") {
                if (from == "Watt" && from2 == "Volt") {
                    calcOut.innerHTML = (number1 / number2) + " Ampere";
                } else if (from2 == "Watt" && from == "Volt") {
                    calcOut.innerHTML = (number2 / number1) + " Ampere";
                }
            }
        }
    </script>
</body>

</html>