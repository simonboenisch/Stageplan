<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../loggingIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Stageplan</title>
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

        /* Header Styles */
        .app-header {
            background-color: #d1d9e6;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: normal;
            color: #000000;
            line-height: 1.25;
        }

        .header-subtitle {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .btn-back {
            background-color: #8ba4bc;
            color: #000000;
            padding: 4px 24px;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s ease;
        }

        .btn-back:hover {
            background-color: #7a93ab;
        }

        /* Main Container & Form Styles */
        .login-card {
            background-color: #e2e8f0; /* Tailwind bg-slate-200 */
            height: 160px; /* Tailwind h-40 */
            margin: 80px; /* Tailwind m-20 */
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .form-input {
            padding: 12px;
            background-color: #d1d5db; /* Tailwind bg-gray-300 */
            border-radius: 6px;
            outline: none;
            border: none;
            margin: 12px;
            font-size: 1rem;
        }

        .btn-submit {
            padding: 12px;
            background-color: #d1d5db; /* Tailwind bg-gray-300 */
            border-radius: 6px;
            outline: none;
            border: none;
            margin: 12px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background-color: #9ca3af;
        }
    </style>
</head>
<body>
    <header class="app-header">
        <div>
            <h1 class="header-title">Stageplan</h1>
            <p class="header-subtitle">Admin pannel</p>
        </div>
        <a class="btn-back" href="../navigation.php">Zurück</a>
    </header>
    <main>
        <div class="login-card">
            <form action="admin.php" method="post" class="login-form">
                <input type="password" class="form-input" placeholder="Password" name="passwordInput" required>
                <input type="submit" class="btn-submit" value="Anmelden">
            </form>
        </div>
    </main>
</body>
</html>