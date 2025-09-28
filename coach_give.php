<?php
include 'Connection.php';
$coach_email = isset($_GET["coach_email"]) ? filter_var($_GET["coach_email"], FILTER_SANITIZE_EMAIL) : "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player_ids = $_POST["player_id"];
    $points = $_POST["points"];

    foreach ($points as $point) {
        if ($point === "") {
            header("Location: coach_give.php?error=Please enter points for all players");
            exit();
        }
    }

    foreach ($player_ids as $key => $player_id) {
        $update_query = "UPDATE batsman SET points = points + $points[$key] WHERE name = '$player_id'";
        $con->query($update_query);

        $update_query = "UPDATE bowler SET points = points + $points[$key] WHERE name = '$player_id'";
        $con->query($update_query);

        $update_query = "UPDATE wicket_keeper SET points = points + $points[$key] WHERE name = '$player_id'";
        $con->query($update_query);

        $update_query = "UPDATE allrounder SET points = points + $points[$key] WHERE name = '$player_id'";
        $con->query($update_query);
    }
    $tempTableQuery = "
    CREATE TEMPORARY TABLE temp_bowler AS
    SELECT name, email, points
    FROM bowler
    ORDER BY points DESC";

    $createTempTable = mysqli_query($con, $tempTableQuery);

    if ($createTempTable) {
        $deleteQuery = "DELETE FROM bowler";
        $deleteData = mysqli_query($con, $deleteQuery);

        if ($deleteData) {
            $insertQuery = "INSERT INTO bowler (name, email, points) SELECT name, email, points FROM temp_bowler";
            $insertData = mysqli_query($con, $insertQuery);

            if ($insertData) {
                echo '<p>Update successful.bowler</p>';
            } else {
                echo "Error inserting data into original table: " . mysqli_error($con);
            }
        } else {
            echo "Error deleting data from original table: " . mysqli_error($con);
        }
        mysqli_query($con, "DROP TEMPORARY TABLE IF EXISTS temp_bowler");
    } else {
        echo "Error creating temporary table: " . mysqli_error($con);
    }
    ?>



    <?php
    $tempTableQuery = "
        CREATE TEMPORARY TABLE temp_batsman AS
        SELECT name, email, points
        FROM batsman
        ORDER BY points DESC";

    $createTempTable = mysqli_query($con, $tempTableQuery);

    if ($createTempTable) {
        $deleteQuery = "DELETE FROM batsman";
        $deleteData = mysqli_query($con, $deleteQuery);

        if ($deleteData) {
            $insertQuery = "INSERT INTO batsman (name, email, points) SELECT name, email, points FROM temp_batsman";
            $insertData = mysqli_query($con, $insertQuery);

            if ($insertData) {
                echo '<p>Update successful.batsman.</p>';
            } else {
                echo "Error inserting data into original table: " . mysqli_error($con);
            }
        } else {
            echo "Error deleting data from original table: " . mysqli_error($con);
        }
        mysqli_query($con, "DROP TEMPORARY TABLE IF EXISTS temp_batsman");
    } else {
        echo "Error creating temporary table: " . mysqli_error($con);
    }
?>




<?php
$tempTableQuery = "
    CREATE TEMPORARY TABLE temp_allrounder AS
    SELECT name, email, points
    FROM allrounder
    ORDER BY points DESC";

$createTempTable = mysqli_query($con, $tempTableQuery);

if ($createTempTable) {
    $deleteQuery = "DELETE FROM allrounder";
    $deleteData = mysqli_query($con, $deleteQuery);

    if ($deleteData) {
        $insertQuery = "INSERT INTO allrounder (name, email, points) SELECT name, email, points FROM temp_allrounder";
        $insertData = mysqli_query($con, $insertQuery);

        if ($insertData) {
            echo '<p>Update successful.allrounder</p>';
        } else {
            echo "Error inserting data into original table: " . mysqli_error($con);
        }
    } else {
        echo "Error deleting data from original table: " . mysqli_error($con);
    }
    mysqli_query($con, "DROP TEMPORARY TABLE IF EXISTS temp_allrounder");
} else {
    echo "Error creating temporary table: " . mysqli_error($con);
}
?>



<?php
$tempTableQuery = "
    CREATE TEMPORARY TABLE temp_keeper AS
    SELECT name, email, points
    FROM wicket_keeper
    ORDER BY points DESC";

$createTempTable = mysqli_query($con, $tempTableQuery);

if ($createTempTable) {
    $deleteQuery = "DELETE FROM wicket_keeper";
    $deleteData = mysqli_query($con, $deleteQuery);

    if ($deleteData) {
        $insertQuery = "INSERT INTO wicket_keeper (name, email, points) SELECT name, email, points FROM temp_keeper";
        $insertData = mysqli_query($con, $insertQuery);

        if ($insertData) {
            echo '<p>Update successful.wicket</p>';
        } else {
            echo "Error inserting data into original table: " . mysqli_error($con);
        }
    } else {
        echo "Error deleting data from original table: " . mysqli_error($con);
    }

    mysqli_query($con, "DROP TEMPORARY TABLE IF EXISTS temp_keeper");
} else {
    echo "Error creating temporary table: " . mysqli_error($con);
}
    header("Location: login.php");
    exit();
}
    ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Player</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tbody tr:nth-child(even) {
            background-color: #fff;
        }
        input[type="number"] {
            width: 60px;
            box-sizing: border-box;
            padding: 8px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div>
        <form method="post" action="coach_give.php">

            <?php
            $playerStats_query = "SELECT name FROM batsman";
            $playerStats_result = $con->query($playerStats_query);
            displayPlayerTable($playerStats_result);

            $playerStats_query = "SELECT name FROM bowler";
            $playerStats_result = $con->query($playerStats_query);
            displayPlayerTable($playerStats_result);

            $playerStats_query = "SELECT name FROM wicket_keeper";
            $playerStats_result = $con->query($playerStats_query);
            displayPlayerTable($playerStats_result);

            $playerStats_query = "SELECT name FROM allrounder";
            $playerStats_result = $con->query($playerStats_query);
            displayPlayerTable($playerStats_result);
            ?>
            
            <input type="submit" value="Submit">

        </form>
    </div>

    <?php
    function displayPlayerTable($playerStats_result)
    {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Points</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $playerStats_result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>';
            echo '<input type="hidden" name="player_id[]" value="' . $row["name"] . '">';
            echo '<input type="number" name="points[]" placeholder="Add Points" min="0" max="10">';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    ?>


</body>
 
</html>
