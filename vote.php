<?php
// Include the database connection
require_once('db.php');

// Get the selected option from the AJAX request
$option = $_POST['option'];

// Insert the vote into the database
$stmt = $pdo->prepare('INSERT INTO votes (option) VALUES (?)');
$stmt->execute([$option]);

// Get the current vote count for the option
$stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM votes WHERE option = ?');
$stmt->execute([$option]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the updated vote count to the poll page
echo $result['count'];
?>
