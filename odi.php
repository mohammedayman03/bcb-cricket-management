<?php include 'Connection.php'; ?>

<?php
$player_query = "SELECT email, name FROM player";
$result = $con->query($player_query);
?>

<!DOCTYPE html>
<html style="height: 100%;">
<head>
    <title>Select Player</title>
    <style>
        body {
            background: url('cricket-stadium-56820.jpg') fixed;
            background-size: cover;
            color: black;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: left;
            justify-content: center;
            height: 100%;
            margin: 0;
        }

        form {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h1>Select Player</h1>
        <form action="odi_update.php" method="GET">
            <label for="player">Select a player:</label>
            <select name="player" required>
                <option value="">Select a player</option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["email"] . '">' . $row["name"] . '</option>';
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Submit">
        </form>

        <?php
        $playerStats_query = "SELECT series_name, name, runs_scored, wickets_taken FROM odi";
        $playerStats_result = $con->query($playerStats_query);
        ?>

        <h1>ODI Player Stats</h1>

        <table>
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Runs Scored</th>
                    <th>Wickets Taken</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $playerStats_result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["series_name"] . '</td>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . $row["runs_scored"] . '</td>';
                    echo '<td>' . $row["wickets_taken"] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

