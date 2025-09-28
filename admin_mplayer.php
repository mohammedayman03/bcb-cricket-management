<?php
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player_name = $_POST['player_name'];
    $delete_query = "DELETE FROM player WHERE name = '$player_name'";
    $con->query($delete_query);
    header("Location: admin_mplayer.php?success=Player deleted successfully");
    exit();
}
$playerNames_query = "SELECT * FROM player";
$playerNames_result = $con->query($playerNames_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Player</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            background: url('LORD.webp') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 0;
            padding-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        p {
            color: #4caf50;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        echo '<p style="color: green;">' . $_GET['success'] . '</p>';
    }
    ?>

    <form method="post" action="admin_mplayer.php">
        <label for="player_name">Select Player:</label>
        <select name="player_name">
            <?php
            while ($row = $playerNames_result->fetch_assoc()) {
                echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
            }
            ?>
        </select>

        <input type="submit" value="Delete">
        <a href="javascript:history.back()">Go Back</a>
    </form>
</body>

</html>

