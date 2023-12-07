<?php
@include 'database.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $select);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $password = $row['password'];

        echo "<h1>Password:$pass</h1>";

        if ($password === $pass){
          $_SESSION['user_name'] = $row['name'];
          header('location: bookTours.php');
          exit();
        } else {
          echo "<h1>Error does not match,password:$password</h1>";
  
        };

        }}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="style.css" rel="stylesheet">
    <title>FastTravel</title>
</head>

<body>
  <header>
  <nav>
    <a href="home.php">Home</a>
    <a href="login.php">Login</a>
    <a href="registration.php">Register</a>
    <a href="AdminPanel.php">Admin Login</a>
    </nav>
    </header>
    <div>
        <form action="" method="post">
            <h1>Log In</h1>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="email" placeholder="Enter your Email" name="email" class="emailInput" />
            <input type="password" placeholder="Enter your Password" name="password" class="emailInput" />
            <input type="submit" name="submit" value="Login Now" class="continue">

            <p>or <a href="registration.php">create a new account</a></p>
        </form>
    </div>
</body>

</html>
