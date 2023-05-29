<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
	<title>Players</title>
</head>
<body>
<div class="center">
<h2>Shot-Happy Players</h2>
<?php include('navbar.php'); ?>

<h4>All Players with at least 200min in 2022-23</h4>


<?php
// still want to change this so organizing by a different header will reset to the top players of that category being on page 1

require 'DBConnect.php';

// Set the number of results to display per page
$results_per_page = 100;

// Create an instance of the Database class and use its methods
$db = new DBConnect();
$conn = $db->connect();

// Retrieve the total number of rows
$sql_count = "SELECT COUNT(*) FROM player";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_row($result_count);
$total_results = $row_count[0];

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);

// Check if a page number is specified in the URL, otherwise set it to 1
if (!isset($_GET['page'])) {
    $current_page = 1;
} else {
    $current_page = $_GET['page'];
}

// Calculate the starting and ending positions of the results to display
$start_index = ($current_page - 1) * $results_per_page;
$end_index = $start_index + $results_per_page;

// Query to retrieve data from database
$sql = "SELECT name, team, position, gp, `shot attempts`, `shots on goal`, `missed net`, `got blocked attempts`, goals FROM player ORDER BY `shot attempts` DESC LIMIT $start_index, $results_per_page";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result === false) {
    error_log("Query failed: " . mysqli_error($conn));
    die("Query failed: " . mysqli_error($conn));
}

// Check if any data was returned
if (mysqli_num_rows($result) > 0) {
    // Output data in a table
    echo "<table class='centered'>";
    // players table
    echo "<tr><th class='sortable'>Name</th><th class='sortable'>Team</th><th>Position</th><th class='sortable'>Games Played</th><th class='sortable'>Shot Attempts</th><th class='sortable'>Shots on Goal</th><th class='sortable'>Missed Net</th><th class='sortable'>Got Blocked Shot Attempts</th><th class='sortable'>Goals</th></tr>";

    //alternate colors, display table data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td><b>" . $row["name"] . "</b></td><td>" . $row["team"] . "</td><td>" . $row["position"] . "</td><td>" . $row["gp"] . "</td><td>" . $row["shot attempts"] . "</td><td>" . $row["shots on goal"] . "</td><td>" . $row["missed net"] . "</td><td>" . $row["got blocked attempts"] . "</td><td>" . $row["goals"] . "</td></tr>";
    }
    echo "</table><br><br>";

    // Output pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<span class='active' style='background-color: white; color: black; font-weight: bold; text-decoration: none; padding: 8px; border-radius: 5px;'>$i</span>";
        } else {
            echo "<a href='?page=$i' style='background-color: black; color: white; font-weight: bold; text-decoration: none; padding: 8px; border-radius: 5px;'>$i</a>";
        }
    }
    echo "</div>";



} else {
    echo "No results found.";
}
?>

<h6>Complete 2022-23 Season. Updated 2023-04-17.</h6>


</div>
</body>
</html>