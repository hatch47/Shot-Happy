<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<script src="script.js"></script>
	<title>Shot-Happy</title>
</head>
<body>

<div class="center">

<h2>Shot-Happy</h2>


<?php include('navbar.php'); ?>

	
	<div class="container">
	<div class="section">
		<h2><u>Top 3 Shot-Happy Players</u></h2>
		<?php
		// Add DBConnection Class for Database
		require 'DBConnect.php';
		// Create an instance of the Database class and use its methods
		$db = new DBConnect();
		$conn = $db->connect();
		// Query to retrieve data from database
		$sqlPlayer = "SELECT name, team, `shot attempts` FROM player order by `shot attempts` desc limit 3";
		$result = mysqli_query($conn, $sqlPlayer);

		// Check if player query was successful
		if ($result === false) {
			error_log("Query failed: " . mysqli_error($conn));
			die("Query failed: " . mysqli_error($conn));
		}

				// Check if any data was returned
		if (mysqli_num_rows($result) > 0) {
			// Output data in a table
			echo "<table class='centered'>";
			// players table
			echo "<tr><th>Name</th><th>Team</th><th>Shot Attempts</th>";

			//alternate colours, display table data
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td><b>" . $row["name"] . "</b></td><td>" . $row["team"] . "</td><td>" . $row["shot attempts"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "No results found.";
		}
		?>
	</div>
	<div class="section">
		<h2><u>Top 3 Shot-Happy Teams</u></h2>
		<?php
		// Add code to display the top 3 teams with the most shot attempts
		$sql = "SELECT team, gp, `shot attempts` FROM team ORDER BY `shot attempts` DESC LIMIT 3";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Output data in a table
			echo "<table class='centered'>"; // Add the ID attribute
			// teams table
			echo "<tr><th>Team</th><th>Game Played</th>
			<th>Shot Attempts</th>";
		
			// alternate colours, display table data
			$row_num = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$row_num++;
				$class = ($row_num % 2 == 0) ? "table-row-alt" : "";
				echo "<tr class='$class'><td><b>" . $row["team"] . "</b></td><td>" . $row["gp"] . "</td><td>" . $row["shot attempts"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "No results found.";
		}
		// $db->close();
		?>
	</div>
</div>

<?php
	// Check if the form is submitted
	if(isset($_POST["submit"])){

		// Get user input data
		$email = $_POST["email"];
		
		// Prepare SQL statement to insert data into email table 
		$sql = "INSERT INTO email (email) VALUES ('$email')";

		
		// Execute SQL statement
		if (mysqli_query($conn, $sql)) {
			echo "<p>Email added successfully.</p>";
		} else {
			echo "<p>Incorrect format, try again</p>";
		}

		// Close Database Connection
		$db->close();
	}
	?>


<h4>Get Added to the Email List</h4>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label for="email">Email:</label>
	<input type="text" id="email" name="email" class="textbox" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br><br>

	<input type="submit" name="submit" value="Submit">
	</form>

	</div>
</body>

<style>
	.textbox {
		display: inline-block;
		margin-right: 10px; /* adjust the margin as needed */
	}
</style>
</html>

