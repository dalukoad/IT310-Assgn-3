<?php
@include 'database.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['adminUsername'])) {
    header('Location: AdminPanel.php'); // Redirect to admin login page if not logged in
    exit();
}

// Fetch tours from the database
$sql = "SELECT * FROM tours";
$result = mysqli_query($conn, $sql);

$tours = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tours[] = $row;
    }
}

// Handle tour deletion
if (isset($_POST['delete_tour'])) {
    $tour_id = mysqli_real_escape_string($conn, $_POST['tour_id']);
    $delete_sql = "DELETE FROM tours WHERE TourID = '$tour_id'";
    mysqli_query($conn, $delete_sql);
    header('Location: AdminDashboard.php'); // Redirect to refresh the page after deletion
    exit();
}

// Handle tour modification - For demonstration purposes, update tour capacity
if (isset($_POST['modify_tour'])) {
    $tour_id = mysqli_real_escape_string($conn, $_POST['tour_id']);
    $new_capacity = mysqli_real_escape_string($conn, $_POST['new_capacity']);
    $update_sql = "UPDATE tours SET Capacity = '$new_capacity' WHERE TourID = '$tour_id'";
    mysqli_query($conn, $update_sql);
    header('Location: AdminDashboard.php'); // Redirect to refresh the page after modification
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['adminUsername']; ?>!</h1>
    <h2>Tours:</h2>
    <table>
        <tr>
            <th>Tour ID</th>
            <th>Location</th>
            <th>Date</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tours as $tour) : ?>
            <tr>
                <td><?php echo $tour['TourID']; ?></td>
                <td><?php echo $tour['Location']; ?></td>
                <td><?php echo $tour['Date']; ?></td>
                <td><?php echo $tour['Capacity']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="tour_id" value="<?php echo $tour['TourID']; ?>">
                        <input type="number" name="new_capacity" placeholder="New Capacity">
                        <button type="submit" name="modify_tour">Modify</button>
                        <button type="submit" name="delete_tour">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="home.php">Logout</a>
</body>

</html>
