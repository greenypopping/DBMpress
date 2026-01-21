<?php
session_start();
require 'passtore.php'; // Imports $stored_user and $stored_hash

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_user = $_POST['username'];
    $input_pass = $_POST['password'];

    // Verify username and use the secure built-in verification function
    if ($input_user === $usr && password_verify($input_pass, $psd)) {
        $_SESSION['loggedin'] = true;
        header("Location: editor.php"); // Redirect to your custom editor
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<form method="POST">
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Log In</button>
</form>
