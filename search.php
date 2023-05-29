<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
	<title>Search</title>
</head>
<body>
<div class="center">
<h2>Shot-Happy Search</h2>
<?php include('navbar.php'); ?>

<h3>Search Players and Teams</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label for="search"></label>
	<input type="text" id="search" name="search">
	<input type="submit" name="submit" value="Search">
</form>
<br>
<?php
// Add DBConnection Class for Database
require 'DBConnect.php';
// Create an instance of the Database class and use its methods
$db = new DBConnect();
$conn = $db->connect();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get search term from form
	$search_term = $_POST["search"];

	// Prepare SQL statement with parameterized query for player search
	$stmt_player = $conn->prepare("SELECT name, team, position, gp, `shot attempts`, `shots on goal`, `missed net`, `got blocked attempts`, goals FROM player WHERE name LIKE ?");
	$stmt_player->bind_param("s", $search_term_like);
	
	// Append wildcard characters to search term
	$search_term_like = '%' . $search_term . '%';
	
	// Execute player search query
	$stmt_player->execute();

	// Bind results to variables
	$stmt_player->bind_result($name, $team, $position, $gp, $attempts, $shots, $misses, $blocked, $goals);

	// Display results in player table
	if ($stmt_player->fetch()) {
		echo "<h2>Players</h2>";
		echo "<table class='centered'>";
		echo "<tr><th>Name</th><th>Team</th><th>Position</th><th>Games Played</th><th><i><b>Shot Attempts</b></i></th><th>Shots on Goal</th><th>Missed Net</th><th>Got Blocked Shot Attempts</th><th>Goals</th></tr>";
		do {
			echo "<tr><td><b>$name<b></td><td>$team</td><td>$position</td><td>$gp</td><td><b>$attempts</b></td><td>$shots</td><td>$misses</td><td>$blocked</td><td>$goals</td></tr>";
		} while ($stmt_player->fetch());
		echo "</table>";
	} else {
		echo "<br> No player results found.";
	}

	// Close player statement
	$stmt_player->close();

	// Prepare SQL statement with parameterized query for team search
	$stmt_team = $conn->prepare("SELECT team, gp, w, `shot attempts`, `shots on goal`, `missed net`, `got blocked attempts`, gf, `shot attempts against`, `shots on goal against`, `missed net against`, `got blocked attempts against`, ga FROM team WHERE team LIKE ?");
	$stmt_team->bind_param("s", $search_term_like);

	// Execute team search query
	$stmt_team->execute();

	// Bind results to variables
	$stmt_team->bind_result($team_name, $gp, $w, $attempts, $shots, $misses, $blocked, $gf, $attempts_against, $shots_against, $misses_against, $blocked_against, $ga);

	// Display results in team table
	if ($stmt_team->fetch()) {
		echo "<h2>Teams</h2>";
		echo "<table class='centered'>";
		echo "<tr><th>Team</th><th>Games Played</th><th>Wins</th><th><i><b>Shot Attempts</b></i></th><th>Shots on Goal</th><th>Missed Net</th><th>Got Blocked Shot Attempts</th><th>Goals For</th><th><i><b>Shot Attempts Against</b></i></th><th>Shots on Goal Against</th><th>Missed Net Against</th><th>Got Blocked Shot Attempts Against</th><th>Goals Against</th></tr>";
        do {
        echo "<tr><td><b>$team_name</b></td><td>$gp</td><td>$w</td><td><b>$attempts</b></td><td>$shots</td><td>$misses</td><td>$blocked</td><td>$gf</td><td>$attempts_against</td><td>$shots_against</td><td>$misses_against</td><td>$blocked_against</td><td>$ga</td></tr>";
        } while ($stmt_team->fetch());
        echo "</table>";
        } else {
        echo "<br> No team results found.";
        }
        // Close team statement
    $stmt_team->close();
}

    // Close database connection
    $conn->close();
?>

</div>
</body>
</html>