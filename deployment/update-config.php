<?php
/**
 * Update WordPress configuration for live deployment
 * Save this file as update-config.php in your deployment folder
 */

// Get the new domain
$new_domain = isset($_POST['domain']) ? $_POST['domain'] : '';
$db_name = isset($_POST['db_name']) ? $_POST['db_name'] : '';
$db_user = isset($_POST['db_user']) ? $_POST['db_user'] : '';
$db_password = isset($_POST['db_password']) ? $_POST['db_password'] : '';
$db_host = isset($_POST['db_host']) ? $_POST['db_host'] : 'localhost';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $new_domain) {
    // Update wp-config.php
    $config_file = 'wp-config.php';
    $config_content = file_get_contents($config_file);
    
    // Update database details
    $config_content = preg_replace(
        "/define\('DB_NAME',\s*'.*?'\);/",
        "define('DB_NAME', '$db_name');",
        $config_content
    );
    $config_content = preg_replace(
        "/define\('DB_USER',\s*'.*?'\);/",
        "define('DB_USER', '$db_user');",
        $config_content
    );
    $config_content = preg_replace(
        "/define\('DB_PASSWORD',\s*'.*?'\);/",
        "define('DB_PASSWORD', '$db_password');",
        $config_content
    );
    $config_content = preg_replace(
        "/define\('DB_HOST',\s*'.*?'\);/",
        "define('DB_HOST', '$db_host');",
        $config_content
    );
    
    file_put_contents($config_file, $config_content);
    
    // Update URLs in the SQL file
    $sql_file = 'littlemiami.sql';
    if (file_exists($sql_file)) {
        $sql_content = file_get_contents($sql_file);
        $sql_content = str_replace('http://localhost/little-miami-brewing-company', 'https://' . $new_domain, $sql_content);
        file_put_contents($sql_file, $sql_content);
    }
    
    echo "Configuration updated successfully!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update WordPress Configuration</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 8px; }
        button { padding: 10px 20px; background: #0073aa; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Update WordPress Configuration</h1>
    <form method="post">
        <div class="form-group">
            <label>New Domain (without http/https):</label>
            <input type="text" name="domain" placeholder="example.com" required>
        </div>
        <div class="form-group">
            <label>Database Name:</label>
            <input type="text" name="db_name" required>
        </div>
        <div class="form-group">
            <label>Database User:</label>
            <input type="text" name="db_user" required>
        </div>
        <div class="form-group">
            <label>Database Password:</label>
            <input type="text" name="db_password" required>
        </div>
        <div class="form-group">
            <label>Database Host:</label>
            <input type="text" name="db_host" value="localhost" required>
        </div>
        <button type="submit">Update Configuration</button>
    </form>
</body>
</html>
