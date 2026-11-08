<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fehler</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f8fafc;
        }

        .error-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #e2e8f0; /* Tailwind bg-slate-200 */
            margin: 80px; /* Tailwind m-20 */
            border-radius: 4px; /* Tailwind rounded */
            padding: 8px; /* Tailwind p-2 */
        }

        .error-title {
            font-weight: bold;
            font-size: 1.875rem; /* Tailwind text-3xl */
        }

        .error-message {
            color: #dc2626; /* Tailwind text-red-600 */
            font-size: 1.25rem; /* Tailwind text-xl */
        }

        .error-subtext {
            color: #9b9b9b; /* Tailwind text-grey-200 */
            font-size: 0.75rem; /* Tailwind text-xs */
        }

        .reason-box {
            margin: 12px; /* Tailwind m-3 */
            background-color: #ffffff; /* Tailwind bg-white */
            padding: 16px; /* Tailwind p-4 */
            border-radius: 4px; /* Tailwind rounded */
            display: flex;
            flex-direction: row;
        }

        .reason-label {
            margin-right: 16px; /* Tailwind mr-4 */
        }

        .btn-back {
            background-color: #cbd5e1; /* Tailwind bg-slate-300 */
            padding: 8px; /* Tailwind p-2 */
            border-radius: 4px; /* Tailwind rounded */
            margin: 8px; /* Tailwind m-2 */
            color: #000000;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .btn-back:hover {
            background-color: #94a3b8;
        }
    </style>
</head>
<body>
    <section class="error-card">
        <h2 class="error-title">Es ist ein Fehler aufgetreten!</h2>
        <p class="error-message">Dein Account wurde Gesperrt!</p>
        <p class="error-subtext">Bitte wende dich an Simon oder Luka!</p>
        <div class="reason-box">
            <b class="reason-label">Grund: </b><p><?php echo $_SESSION['grund'];?></p>
        </div>
        <a href="loggingIn.html" class="btn-back">Zurück zum Login</a>
    </section>
</body>
</html>