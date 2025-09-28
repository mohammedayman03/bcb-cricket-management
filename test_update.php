<?php
include 'Connection.php';

if (isset($_GET["player"])) {
    $player_email = $_GET["player"];
    $player_query = "SELECT name FROM player WHERE email = '$player_email'";
    $player_result = $con->query($player_query);

    if ($player_result->num_rows > 0) {
        $player_row = $player_result->fetch_assoc();
        $name = $player_row["name"];
    } else {
        echo "Player not found.";
        exit();
    }
} else {
    echo "No player selected.";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $series_name = strtolower(preg_replace('/[^a-z0-9]/', '', str_replace(' ', '', $_POST["series_name"])));
    $wickets_taken = $_POST["wickets_taken"];
    $runs_scored = $_POST["runs_scored"];
    $check_series_query = "SELECT * FROM test WHERE series_name = '$series_name' and email ='$player_email' ";
    $series_result = $con->query($check_series_query);

    if ($series_result->num_rows > 0) {
        $update_query = "UPDATE test SET wickets_taken = wickets_taken + $wickets_taken, runs_scored = runs_scored + $runs_scored
                         WHERE series_name = '$series_name' AND email = '$player_email'";
    } else {
        $update_query = "INSERT INTO test (email, name, series_name, wickets_taken, runs_scored)
                         VALUES ('$player_email', '$name', '$series_name', $wickets_taken, $runs_scored)";
    }

    if ($con->query($update_query) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selected Player</title>
</head>
<body>
    <h1>Selected Player: <?php echo $name; ?></h1>
    <form method="POST" action="">
        <label for="series_name">Series Name (all lowercase, no spaces/hyphens/special characters):</label>
        <input type="text" name="series_name" pattern="[a-z0-9]+" title="Series name must be in lowercase and contain only letters and numbers" required><br>

        <label for="wickets_taken">Wickets Taken:</label>
        <input type="number" name="wickets_taken" required><br>

        <label for="runs_scored">Runs Scored:</label>
        <input type="number" name="runs_scored" required><br>

        <input type="submit" value="Submit">
    </form>
    <a href="admin_home.php?email=<?= $player_email ?>">Back to Admin Home</a>
</body>
</html>
