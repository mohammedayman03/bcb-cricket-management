<?php
include 'Connection.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_GET['email'])) {
    $player_email = $_GET['email'];
}

$sql = "SELECT training_id, name, training_date, type FROM training WHERE player_email = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $player_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $completedTrainingId = $_POST["completed_training_id"];
    $deleteSql = "DELETE FROM training WHERE training_id = ?";
    $deleteStmt = mysqli_prepare($con, $deleteSql);
    mysqli_stmt_bind_param($deleteStmt, "i", $completedTrainingId);
    mysqli_stmt_execute($deleteStmt);
    header("Location: player_home.php?email=$player_email");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Details</title>
    <style>
        body {
            background: url('') center center fixed;
            background-size: cover;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px; 
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: rgba(0, 0, 0, 0.65); 
            border-radius: 10px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: transparent; 
            color: black;
            margin-top: 20px;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color:white;
            
            
        }

        th {
            border: 1px solid #ddd;
            padding: 8px;
            background-color: #f2f2f2;
            text-align: left;
            
        }

        .action-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Training Details</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Training Date</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['training_date'] ?></td>
                        <td><?= $row['type'] ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="completed_training_id" value="<?= $row['training_id'] ?>">
                                <button class="action-btn" type="submit">Completed</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <br>

        <a href="player_home.php?email=<?= $player_email ?>">Go Back to Home</a>
    </div>
</body>
</html>
