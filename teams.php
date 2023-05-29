<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
	<title>Teams</title>
</head>
<body>
<div class="center">
<h2>Shot-Happy Teams</h2>
<?php include('navbar.php'); ?>

<h4>All Teams 2022-23</h4>

<?php

// Add DBConnection Class for Database
require 'DBConnect.php';
// Create an instance of the Database class and use its methods
$db = new DBConnect();
$conn = $db->connect();

// Query to retrieve data from database
$sql = "SELECT team, gp, w, `shot attempts`, `shots on goal`, `missed net`, `got blocked attempts`, gf, `shot attempts against`, `shots on goal against`, `missed net against`, `got blocked attempts against`, ga FROM team order by `shot attempts` desc";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result === false) {
    error_log("Query failed: " . mysqli_error($conn));
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    // Output data in a table
    echo "<table class='centered'>"; // Add the ID attribute
    // teams table
    echo "<tr><th class='sortable'>Team</th><th class='sortable'>Game Played</th>
    <th class='sortable'>Wins</th><th class='sortable'>Shot Attempts</th><th class='sortable'>Shots on Goal</th><th class='sortable'>Missed Net</th><th class='sortable'>Got Blocked Shot Attempts</th><th class='sortable'>Goals</th><th class='sortable'>Shot Attempts Against</th><th class='sortable'>Shots on Goal Against</th><th class='sortable'>Missed Net Against</th><th class='sortable'>Got Blocked Shot Attempts Against</th><th class='sortable'>Goals Against</th></tr>";

    // alternate colours, display table data
    $row_num = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $row_num++;
        $class = ($row_num % 2 == 0) ? "table-row-alt" : "";
        echo "<tr class='$class'><td><b>" . $row["team"] . "</b></td><td>" . $row["gp"] . "</td><td>" . $row["w"] . "</td><td>" . $row["shot attempts"] . "</td><td>" . $row["shots on goal"] . "</td><td>" . $row["missed net"] . "</td><td>" . $row["got blocked attempts"] . "</td><td>" . $row["gf"] . "</td><td>" . $row["shot attempts against"] . "</td><td>" . $row["shots on goal against"] . "</td><td>" . $row["missed net against"] . "</td><td>" . $row["got blocked attempts against"] . "</td><td>" . $row["ga"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}

// Close Database Connection
$db->close();
?>

<h6>Complete 2022-23 Season. Updated 2023-04-17.</h6>


</div>

<!-- <script>
  script("myTable");
</script> -->
</body>
</html>