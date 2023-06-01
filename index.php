<?php
require 'inc/bootstrap.php';

// Check if the board is set and valid
if (!isset($_GET['board']) || !preg_match("/{$config['board_regex']}/u", $_GET['board'])) {
    http_response_code(400);
    error('Bad board.');
}

// Open the board
if (!openBoard($_GET['board'])) {
    http_response_code(404);
    error('No board.');
}

// Check if public logs are enabled for the board
if ($config['public_logs'] == 0) {
    error('This board has public logs disabled. Ask the board owner to enable it.');
}

// Determine whether to hide names based on the configuration
$hide_names = ($config['public_logs'] == 2);

// Fetch the board log entries for the main page
$board_logs = mod_board_log($board['uri'], 1, $hide_names, false);

// Include the header section
require 'inc/header.php';
?>

<body>
    <header>
        <h1>Welcome to Vichan Imageboard</h1>
        <!-- Add your logo or banner here -->
    </header>

    <nav>
        <!-- Add your board categories or links to various boards here -->
        <ul>
            <li><a href="board1.php">Board 1</a></li>
            <li><a href="board2.php">Board 2</a></li>
            <li><a href="board3.php">Board 3</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Board Log</h2>
            <ul>
                <?php foreach ($board_logs as $log_entry): ?>
                    <li><?php echo $log_entry['message']; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <!-- Add your footer content here -->
        <p>&copy; <?php echo date('Y'); ?> Vichan Imageboard</p>
    </footer>

    <!-- Add your JavaScript files here if needed -->

</body>
</html>
