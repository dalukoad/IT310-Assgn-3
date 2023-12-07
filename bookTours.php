<?php

@include 'database.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['password_confirmation']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};


?>


<!DOCTYPE html>
<html lang="en">

<!--Aluko Adeolu Divine IT310 Assignment 2 -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>FastTravel Page</title>
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

<h1>Book Tour Dates</h1>
    <form action="" method="post">
      <p>Choose Tour and Date</p>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
       <label for="selectedTour">Select Tour:</label>
        <select id="selectedTour" name="selectedTour">
            <option value="Tour 1">Bahamas</option>
            <option value="Tour 2">Dubai</option>
            <option value="Tour 3">Japan</option>
            <option value="Tour 4">Europe</option>
            <option value="Tour 5">Dominican Republic</option>
            <option value="Tour 6">Mexico</option>
        </select><br><br>
        
        <label for="numTravelers">Number of Travelers:</label><br>
        <input type="number" id="numTravelers" name="numTravelers" min="1" value="1"><br>

        <label for="departureDate">Departure Date:</label><br>
        <input type="date" id="departureDate" name="departureDate"><br>

        <label for="returnDate">Return Date:</label><br>
        <input type="date" id="returnDate" name="returnDate"><br>


        <button type="submit" name="addToCart">Add to Cart</button> 

        <form action="cart.php" method="get">
            <input type="submit" value="Go to Cart" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
        </form>

    </form>
</body>    
</html>