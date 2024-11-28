<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Execution</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 0;
            padding: 50px;
        }
        .output {
            margin-top: 20px;
            white-space: pre-wrap;
            background-color: #333;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Execute Command</h1>
    <form method="POST">
        <label for="command">Enter your command:</label>
        <input type="text" name="command" id="command" required>
        <button type="submit">Execute</button>
    </form>
    <div class="output">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['command'])) {
            $command = $_POST['command'];
            $forbidden_commands = ['>', '<', 'php', 'cat ', 'cat$', 'strings', 'top', 'head', 'less', 'tail', 'rev', 'dmesg', '/'];

            // Vérifier si la commande contient une commande interdite
            $is_forbidden = false;
            foreach ($forbidden_commands as $forbidden) {
                if (preg_match('/\b' . preg_quote($forbidden, '/') . '\b/', $command)) {
                    $is_forbidden = true;
                    break;
                }
            }

            if ($is_forbidden) {
                echo 'Error: Forbidden command detected.';
            } else {
                // Exécuter la commande (ATTENTION : Risque de sécurité ici)
                $output = shell_exec("echo $command 2>&1");
                echo htmlspecialchars($output) ?: 'No output or error.';
            }
        }
        //I love python3 maybe you can try it 
        ?>
    </div>
</body>
</html>