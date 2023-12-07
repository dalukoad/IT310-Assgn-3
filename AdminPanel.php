<?php
@include 'database.php';
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['adminUsername']);
    $password = $_POST['adminPassword'];

    $select = "SELECT * FROM admin_credentials WHERE username = '$username'"; 
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $dbPassword = $row['password'];

        if ($password === $dbPassword) {
            $_SESSION['username'] = $row['username'];
            header('location:AdminPanel.php');
            exit();
        } else {
            echo "<h1>Error: Password does not match</h1>";
        }
    } else {
        echo "<h1>Error: Username not found</h1>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>FastTravel Admin</title>
</head>

<body>
    <header>
        <nav>
            <a href="home.html">Home</a>
            <a href="login.php">Login</a>
            <a href="registration.php">Register</a>
            <a href="AdminPanel.php">Admin Login</a>
        </nav>
    </header>

    <h1>Welcome to the Admin Panel!</h1>

    <div id="adminLogin" style="display: block;">
        <h2>Admin Login</h2>
        <form action="" method="post"> 
            <label for="adminUsername">Username:</label>
            <input type="text" id="adminUsername" name="adminUsername" required>
            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="adminPassword" required>
            <button type="submit" name="submit">Login</button> 
    </div>
</body>

</html>
