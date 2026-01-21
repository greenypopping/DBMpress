<?php
session_start();
//if (!isset($_SESSION['loggedin'])) { die("Unauthorized."); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_user = $_POST['new_username'];
    // Hash the password using bcrypt (default in 2026)
    $new_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT); 

    // Generate the content for config.php
    $config_content = "<?php\n";
    $config_content .= "\$usr = '" . addslashes($new_user) . "';\n";
    $config_content .= "\$psd = '" . $new_hash . "';\n";
    $config_content .= "?>";

    // Securely write to the config file
    if (file_put_contents('passtore.php', $config_content)) {
        echo "Credentials updated successfully!";
    }
}
?>

<form method="POST">
    Update Username: <input type="text" name="new_username" required><br>
    Update Password: <input type="password" name="new_password" required><br>
    <button type="submit">Save Changes</button>
</form>
